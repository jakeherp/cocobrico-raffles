<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UploadProfileImageRequest;

use App\Address;
use App\Country;
use App\File;
use App\User;

use Auth;
use Hash;
use Mail;


class UserController extends Controller
{
    /**
     * Shows the email input field to start the authentication process.
     *
     * @return Response
     */
   	public function showEmailForm(){
   		return view('auth.email');
   	}

   	/**
     * Shows the register form.
     *
     * @return Response
     */
   	public function showRegisterForm($token){
   		if($token != ''){
	    	$user = User::where('register_token', '=', $token)->first();
        $countries = Country::getForView();
	    	if ($user != null) {
			   	return view('auth.register',compact('user','countries'));
  			}
        else{
          return redirect('/');
        }
  		}
  		else{
  			return redirect('/');
  		}
   	}

   	/**
     * Checks if the email address is already registered, if the user already has a password and if the
     * email address is verified.
     *
     * @param  CheckEmailRequest $request
     * @return Response
     */
   	public function identify(CheckEmailRequest $request){
   		$email = $request->email;
   		$user = User::where('email','=',$email)->first();
   		if($user === null){
   			// User is not existing in the database
   			$user = new User();
   			$user->email = $email;
   			$user->register_token = str_random(40);
   			$user->save();

   			// Verification-Email is send to user.
			/*$sent = Mail::send('emails.verifyEmail', ['user' => $user], function ($m) use ($user) {
        		$m->from('noreply@cb.pcserve.eu', 'Cocobrico');
        		$m->to($user->email, $user->email)->subject('Verify your Email.');
        });*/

		    return view('auth.verifyEmail', compact('user'));
   		}
   		else{
   			// User is existing in the database
		    $regUser = User::where('email', '=', $request->email)->where('password', '!=', '')->first();
		    if ($regUser != null) {
		   		// User is already registered
		   		return redirect('login')->with('email', $request->email);
		    }
		    else{
		   		// User is not registered yet
		   		return view('auth.verifyEmail', compact('user'));
		    }
   		}
   	}

  /**
	 * Registers the users password.
	 *
	 * @param  RegisterRequest $request
	 * @return Response
	 */
    public function register(RegisterRequest $request){
    	$user = User::where('email', '=', $request->email)->where('register_token', '=', $request->register_token)->firstOrFail();
    	if ($user != null) {
		   	$user->password = Hash::make($request->password);
		   	$user->register_token = '';
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->birthday = strtotime($request->birthday);
			  $user->save();

        $address = new Address();
        $address->firstname = $request->firstname;
        $address->lastname = $request->lastname;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->zipcode = $request->zipcode;
        $address->city = $request->city;
        $address->country_id = $request->country;
        $address->phone = $request->phone;
        $address->fax = $request->fax;
        $user->address()->save($address);

        if ($request->hasFile('profilePicture')) {  
          if ($request->file('profilePicture')->isValid()) {
            $file = $request->file('profilePicture');
            $destinationPath = '/files/user_' . $user->id;
            $upload = new File();
            $filename = $upload->uploadFile($file, $destinationPath);
            if(!$filename){
              return redirect()->back()->withInput()->withErrors(['Fileupload went wrong!']);
            }
            else{
              $upload->slug = 'profile_img';
              $upload->name = 'Profilbild';
              $upload->path = 'files/user_' . $user->id . '/' . $filename;
              $user->files()->save($upload);
            }
          }
        }

			  // User logged in!
			  return $this->authenticate($request);
		  }
    }

  /**
   * Edits the user details.
   *
   * @param  Request $request
   * @return Response
   */
    public function edit(Request $request){
      $user = Auth::user();
      if ($user != null) {
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        $address = $user->address;
        $address->firstname = $request->firstname;
        $address->lastname = $request->lastname;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->zipcode = $request->zipcode;
        $address->city = $request->city;
        $address->country_id = $request->country;
        $address->phone = $request->phone;
        $address->fax = $request->fax;
        $address->save();

        return redirect()->back();
      }
    }

    /**
   * Edits the users profile image
   *
   * @param  Request $request
   * @return Response
   */
    public function image(UploadProfileImageRequest $request){
      $user = Auth::user();
      if ($request->hasFile('profilePicture')) { 
        if ($request->file('profilePicture')->isValid()) {
          $file = $request->file('profilePicture');
          $destinationPath = '/files/user_' . $user->id;
          if(($upload = $user->files()->where('slug','profile_img')->first()) == null){
            $upload = new File();
          }
          else{
            unlink(public_path($upload->path));
          }
          $filename = $upload->uploadFile($file, $destinationPath);
          if(!$filename){
            return redirect()->back()->withInput()->withErrors(['Fileupload went wrong!']);
          }
          else{
            $upload->slug = 'profile_img';
            $upload->name = 'Profilbild';
            $upload->path = 'files/user_' . $user->id . '/' . $filename;
            $user->files()->save($upload);
          }
        }
      }
      return redirect()->back();
    }

    /**
	 * Shows the login form.
	 *
	 * @return Response
	 */
    public function showLoginForm(){
    	if(session()->has('errors')){
    		return view('auth.login'); 
    	}
    	else{
	    	if(session()->has('email')){
	    		$email = session('email');
	    		$user = User::where('email', '=', session('email'))->first();
			   	return view('auth.login', compact('user'));
	    	}
			else{
				return redirect('/');
			}
		}
    }

    /**
	 * Logs the user in.
	 *
	 * @param  CheckPasswordRequest $request
	 * @return Response
	 */
    public function login(LoginRequest $request){
		return $this->authenticate($request);
    }

    /**
	 * Logs the user out.
	 *
	 * @return Response
	 */
    public function logout(){
		Auth::logout();
		return redirect('/');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate($request)
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
	        return redirect('dashboard');
        }
        else{
        	return redirect()->back()->withInput()->withErrors(['Something went wrong!']);
        }
    }

    /**
     * Deletes the user.
     *
     * @return Response
     */
    public function delete(Request $request)
    {
      $user = Auth::user();
      if($user->hasPermission('is_admin') && $user->id != $request->userId){
        $id = $request->userId;
        $member = User::find($id);
        $member->delete();
        return redirect()->back();
      }
      else{
        return redirect()->back();
      }
    }
}
