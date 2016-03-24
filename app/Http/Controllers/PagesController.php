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
  		// User is logged in
    	if (Auth::check()) {
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

    	$raffles_2 = Raffle::whereDoesntHave('users', function($q) use ($id){
		    	$q->where('user_id', $id);
			})
    		->where(function($q) {
    			$q->where('start','<=',time())
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

    public function nachrichten(){
    	$user = Auth::user();
    	return view('pages.nachrichten', compact('user'));
	}
}
