<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use App\Raffle;

use Auth;

class PagesController extends Controller
{
    public function __construct(){
		$this->middleware('auth', ['except' => ['index','impressum']]);
	}

	/**
	 * Shows the index page.
	 *
	 * @return Response
	 */
    public function index(){
    	if (Auth::check() && Auth::user()->hasPermission('is_admin')) {
	    	return redirect('admin');
		}
    	elseif (Auth::check() && Auth::user()->hasPermission('is_operator')) {
	    	return redirect('operator');
		}
  		// User is logged in
    	elseif (Auth::check()) {
	    	return redirect('dashboard');
		}
		// User is not logged in
		else{
			return view('auth.email');
		}
	}

	/**
	 * Shows the users dashboard.
	 *
	 * @return Response
	 */
    public function dashboard(){
    	$user = Auth::user();
    	$id = $user->id;

    	// ACTIVE RAFFLE THE USER IS PARTICIPATING IN
    	$raffles_1 = $user->raffles()
    		->where('start','<=',time())
    		->where(function($q) {
	    		$q->where('endState','=',0)
	    		->where('maxpState','=',0)
	    		->orWhere(function ($query) {
		            $query->where('endState','=',1)
		                  ->where('end','>',time());
		        })
		        ->orWhere(function ($query) {
		            $query->where('maxpState','=',1)
		                  ->where('maxpReached','=',0);
		        });
		       })
    		->orderBy('start', 'asc')->get();

    	// ACTIVE RAFFLES
    	$raffles_2 = Raffle::whereDoesntHave('users', function($q) use ($id){
		    	$q->where('user_id', $id);
			})
    		->where(function($q) {
    			$q->where('start','<=',time())
    			->where(function ($query) {
    				$query->where('hasEventDate','=',1)
    					  ->where('eventDate','>',time())
    					  ->orWhere('hasEventDate','=',0);
    			})
				->where('endState','=',0)
				->where('maxpState','=',0)
				->orWhere(function ($query) {
		            $query->where('start','<=',time())
		                  ->where('endState','=',1)
		                  ->where('end','>',time());
	        	})
	        	->orWhere(function ($query) {
	            	$query->where('start','<=',time())
	                  ->where('maxpState','=',1)
	                  ->where('maxpReached','=',0);
	        	});
    		})
			->orderBy('start', 'asc')->get();

		// OLD RAFFLES THE USER WAS PARTICIPATING
    	$raffles_3 = $user->raffles()
	        ->where('endState','=',1)
	        ->where('end','<=',time())
	        ->orWhere(function ($query) {
	            $query->where('maxpState','=',1)
	                  ->where('maxpReached','=',1);
	        })
    		->orderBy('start', 'asc')->get();
    	
    	return view('pages.dashboard', compact('user','raffles_1','raffles_2','raffles_3'));
	}

	/**
	 * Shows the users settings page.
	 *
	 * @return Response
	 */
    public function settings(){
    	$user = Auth::user();
    	$countries = Country::where('active',1)->get();
    	return view('pages.settings', compact('user','countries'));
	}

	/**
	 * Shows the impressum.
	 *
	 * @return Response
	 */
    public function impressum(){
    	$user = Auth::user();
    	return view('pages.impressum', compact('user'));
	}

    public function messages(){
    	$user = Auth::user();
    	$user->messages()->update(['read'=>1]);
    	return view('pages.messages', compact('user'));
	}
}
