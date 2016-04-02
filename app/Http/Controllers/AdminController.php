<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\EditUserRequest;

use App\Confirmation;
use App\Country;
use App\Email;
use App\File;
use App\Message;
use App\Permission;
use App\Raffle;
use App\User;

use Auth;
use DB;
use Mail;
use QrCode;
use PDF;

class AdminController extends Controller
{
    public function __construct(){
		$this->middleware('admin');
	}

	/**
	 * Shows the admins dashboard.
	 *
	 * @return Response
	 */
    public function dashboard(){
    	$user = Auth::user();
        $members = User::all();
        $conv1 = User::whereHas('messages', function ($query) {
            $query->where('answered',0);
        })->get();
        $raffles = Raffle::orderBy('end','desc')->get();
    	return view('admin.dashboard', compact('user','members','conv1','raffles'));
	}

	/**
	 * Shows the codes.
	 *
	 * @return Response
	 */
    public function showCodesView(){
    	$user = Auth::user();
    	$raffles = Raffle::all();
    	return view('admin.codes', compact('user','raffles'));
	}

    /**
     * Shows the messages.
     *
     * @return Response
     */
    public function showMessagesView(){
        $user = Auth::user();
        $members = DB::table('users')->orderBy('lastname', 'asc')->get();
        $messages = Message::all();

        // Ungelesene Nachrichten
        $conv1 = User::whereHas('messages', function ($query) {
            $query->where('answered',0)->where('read',0);
        })->get();

        // Unbeantwortete Nachrichten
        $conv2 = User::whereHas('messages', function ($query) {
            $query->where('answered',0)->where('read',1);
        })->get();

        // Beantwortete Nachrichten
        $conv3 = User::whereDoesntHave('messages', function ($query) {
            $query->where('answered',0);
        })->whereHas('messages', function ($query) {
            $query->where('answered',1);
        })->get();
        
       return view('admin.messages', compact('user','members','conv1','conv2','conv3'));
    }

	/**
	 * Shows the emails view.
	 *
	 * @return Response
	 */
    public function showEmailsView(){
    	$user = Auth::user();
    	$emails = Email::all();
    	return view('admin.emails', compact('user','emails'));
	}

	/**
	 * Shows the confirmations view.
	 *
	 * @return Response
	 */
    public function showConfirmationsView(){
    	$user = Auth::user();
    	$confirmations = Confirmation::all();
    	return view('admin.pdf', compact('user','confirmations'));
	}

	/**
	 * Shows the create pdf view.
	 *
	 * @return Response
	 */
    public function createPdfView(){
    	$user = Auth::user();
    	return view('admin.create-pdf', compact('user'));
	}

	/**
	 * Shows the detail pdf view.
	 *
	 * @return Response
	 */
    public function pdfDetail($id){
    	$user = Auth::user();
    	$confirmation = Confirmation::find($id);
    	return view('admin.pdf-detail', compact('user','confirmation'));
	}

	/**
	 * Shows the edit pdf view.
	 *
	 * @return Response
	 */
    public function editPdfView($id){
    	$user = Auth::user();
    	$confirmation = Confirmation::find($id);
    	return view('admin.edit-pdf', compact('user','confirmation'));
	}

	/**
	 * Shows the edit pdf view.
	 *
	 * @return Response
	 */
    public function editEmailView($id){
		$user = Auth::user();
    	$email = Email::find($id);
    	return view('admin.edit-email', compact('user','email'));
	}
	/**
	 * Shows the changelog.
	 *
	 * @return Response
	 */
    public function showChangelog(){
    	$user = Auth::user();
    	return view('admin.changelog', compact('user'));
	}

	/**
	 * Shows the code creation page.
	 *
	 * @return Response
	 */
    public function createCodesView($id){
    	$user = Auth::user();
    	$raffle = Raffle::find($id);
    	if($raffle == null){
    		return redirect('admin/codes');
    	}
    	else{
    		return view('admin.create-codes', compact('user','raffle'));
    	}
	}

	/**
	 * Shows the code detail page.
	 *
	 * @return Response
	 */
    public function detailCodesView($id){
    	$user = Auth::user();
    	$raffle = Raffle::find($id);
    	if($raffle == null){
    		return redirect('admin/codes');
    	}
    	else{
    		return view('admin.codes-detail', compact('user','raffle'));
    	}
	}

	/**
	 * Shows the raffles.
	 *
	 * @return Response
	 */
    public function showRafflesView(){
    	$user = Auth::user();
    	$raffles = Raffle::all();
    	return view('admin.raffles', compact('user','raffles'));
	}

	/**
	 * Shows the raffles.
	 *
	 * @return Response
	 */
    public function createRafflesView(){
    	$user = Auth::user();
    	return view('admin.create-raffle', compact('user'));
	}

	/**
	 * Shows the create emails view.
	 *
	 * @return Response
	 */
    public function createEmailView(){
    	$user = Auth::user();
    	$raffles = Raffle::all();
    	return view('admin.create-email', compact('user','raffles'));
	}

	/**
	 * Shows the emails pdf view.
	 *
	 * @param  integer $id
	 * @return Response
	 */
    public function emailPdfView($id){
    	$user = Auth::user();
    	$email = Email::find($id);
    	$confirmations = Confirmation::all();
    	return view('admin.email-pdf', compact('user','email','confirmations'));
    }

	/**
	 * Shows the edit raffle form.
	 *
	 * @param integer $id
	 * @return Response
	 */
    public function editRaffleView($id){
    	$user = Auth::user();
    	$raffle = Raffle::find($id);
    	if($raffle != null){
    		return view('admin.edit-raffle', compact('user','raffle'));
    	}
    	else{
    		return redirect('admin/raffles');
    	}
	}

	/**
	 * Shows the edit user form.
	 *
	 * @param integer $id
	 * @return Response
	 */
    public function editUserView($id){
    	$user = Auth::user();
    	$member = User::find($id);
    	$countries = Country::where('active',1)->get();
    	if($member != null){
            if($member->address == null){
                return redirect('admin/users')->with('msg', 'Der User kann nicht bearbeitet werden, da seine Registrierung nicht abgeschlossen ist.')->with('msgState', 'alert');
            }
            else{
    		  return view('admin.edit-user', compact('user','member','countries'));
            }
    	}
    	else{
    		return redirect('admin/users')->with('msg', 'Der User existiert nicht.')->with('msgState', 'alert');
    	}
    }

	/**
	 * Shows the emails view for a raffle.
	 *
	 * @param integer $id
	 * @return Response
	 */
    public function raffleEmailsView($id){
    	$user = Auth::user();
    	$raffle = Raffle::find($id);
    	$emails = Email::all();
    	if($raffle != null){
    		return view('admin.email-raffle', compact('user','raffle','emails'));
    	}
    	else{
    		return redirect('admin/raffles');
    	}
    }

	/**
	 * Shows the raffles.
	 *
	 * @return Response
	 */
    public function users(){
    	$user = Auth::user();
    	$members = User::all();
    	return view('admin.users', compact('user','members'));
	}

	/**
	 * Shows the users details.
	 *
	 * @return Response
	 */
    public function userDetail($id){
    	$user = Auth::user();
    	$member = User::find($id);
    	if($member != null){
    		return view('admin.user-detail', compact('user','member'));
    	}
    	else{
    		return redirect('admin/users');
    	}
	}

	/**
	 * Shows the raffles details.
	 *
	 * @return Response
	 */
    public function raffleDetail($id){
    	$user = Auth::user();
    	$raffle = Raffle::find($id);
    	if($raffle != null){
    		$members = $raffle->users;
    		return view('admin.raffle-detail', compact('user','raffle','members'));
    	}
    	else{
    		return redirect('admin/raffles');
    	}
	}

	/**
	 * Shows the preview PDF
	 *
	 * @param integer $id
	 * @return Response
	 */
	public function pdfPreview($id){
		$user = Auth::user();
		$raffle = Raffle::find($id);
		$preview = true;
		$qrstring = 'PREVIEW, ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
		QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');

		$confirmation = Confirmation::where('standard',1)->first();
		$confirmation->prepare($user, $raffle);

		return PDF::loadView('pdf.info', compact('user','raffle','preview', 'confirmation'))->stream();
	}

  /**
   * Edits the user details.
   *
   * @param  Request $request
   * @return Response
   */
    public function updateUser(EditUserRequest $request){
      $user = User::find($request->id);
      if ($user != null) {
      	$address = $user->address;

      	$changes = [];
      	$controle = false;

      	if( $request->sendNotification == 1 ){
      		if($request->email != $user->email){ $changes['Email'] = $user->email . ' zu ' . $request->email; $controle = true; }
        	if($request->firstname != $user->firstname){ $changes['Vorname'] = $user->firstname . ' zu ' . $request->firstname; $controle = true; }
        	if($request->lastname != $user->lastname){ $changes['Nachname'] = $user->lastname . ' zu ' . $request->lastname; $controle = true; }
        	if($request->gender != $user->gender){ $changes['Geschlecht'] = trans('auth.gender_'.$user->gender) . ' zu ' . trans('auth.gender_'.$request->gender); $controle = true; }
        	if(strtotime($request->birthday) != $user->birthday){ $changes['Geburtstag'] = date(trans('global.dateformat'),$user->birthday) . ' zu ' . date(trans('global.dateformat'),strtotime($request->birthday)); $controle = true; }

        	if($request->address1 != $address->address1){ $changes['Addresse1'] = $address->address1 . ' zu ' . $request->address1; $controle = true; }
        	if($request->address2 != $address->address2){ $changes['Addresse2'] = $address->address2 . ' zu ' . $request->address2; $controle = true; }
        	if($request->zipcode != $address->zipcode){ $changes['Postleitzahl'] = $address->zipcode . ' zu ' . $request->zipcode; $controle = true; }
        	if($request->city != $address->city){ $changes['Stadt'] = $address->city . ' zu ' . $request->city; }
        	if($request->country != $address->country_id){ $changes['Land'] = Country::find($address->country_id)->name . ' zu ' . Country::find($request->country)->name; $controle = true; }
        	if($request->phone != $address->phone){ $changes['Telefon'] = $address->phone . ' zu ' . $request->phone; $controle = true; }
        	if($request->fax != $address->fax){ $changes['Fax'] = $address->fax . ' zu ' . $request->fax; $controle = true; }

        	if($controle){
	        	$body = '<p>Hallo '.$request->firstname.',</p><p>Wir haben Deine Profildaten angepasst. Bitte überprüfe die von uns vorgenommenen Änderungen bei Deinem nächsten Login und kontaktiere uns bei Fragen auf europe@cocobrico.com.</p>
	        		<p>Vorgenommene Änderungen:</p><ul>';
	        	foreach($changes as $key => $value){
	        		$body .= '<li>'.$key.': '. $value .'</li>';
	        	}
	        	$body .= '</ul><p>Viele Grüße,<br>Dein Cocobrico Team</p>';

	        	$send = Mail::send('emails.default', compact('body'), function ($m) use ($request) {
	              $m->from('europe@cocobrico.com', 'Cocobrico');
	              $m->to($request->email, $request->firstname . ' ' . $request->lastname)->subject('Änderung Deiner Daten');
	          	});
	        }
        }

        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->birthday = strtotime($request->birthday);
        $user->save();

        if(Auth::user()->id == $user->id && ($request->role == 'is_user' || $request->role == 'is_operator')){
            return redirect('admin/users')->with('msg', 'Du kannst deinen eigenen Benutzerrang nicht bearbeiten!')->with('msgState', 'alert');
        }
        elseif($request->role == 'is_user'){
            if($user->hasPermission('is_operator') || $user->hasPermission('is_admin')){
                $user->permissions()->delete();
            }
        }
        elseif($request->role == 'is_operator' && !$user->hasPermission('is_operator')){
            $user->permissions()->delete();
            $role = new Permission();
            $role->slug = 'is_operator';
            $user->permissions()->save($role);
        }
        elseif($request->role == 'is_admin' && !$user->hasPermission('is_admin')){
            $user->permissions()->delete();
            $role = new Permission();
            $role->slug = 'is_admin';
            $user->permissions()->save($role);
        }

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

        return redirect('admin/users')->with('msg', 'Die Benutzerdaten wurden erfolgreich aktualisiert.')->with('msgState', 'success');
      }
    }

  /**
   * Shows the messages with an User.
   *
   * @param integer $id
   * @return Response
   */
    public function messages($id){
        $user = Auth::user();
        $member = User::find($id);
        $member->messages()->where('answer',0)->update(['read'=>1]);
        return view('admin.chat', compact('user','member'));
    }

}
