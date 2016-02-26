<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Raffle;

use Auth;

class PagesController extends Controller
{
    public function __construct(){
		$this->middleware('auth', ['except' => ['index']]);
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
    	$raffles = Raffle::where('start','<=',time())->where('end','>=',time())->get();
    	return view('pages.dashboard', compact('user','raffles'));
	}
}
