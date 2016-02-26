<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Raffle;

use Auth;

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
    	return view('admin.dashboard', compact('user'));
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
	 * Shows the raffles.
	 *
	 * @return Response
	 */
    public function users(){
    	$user = Auth::user();
    	return view('admin.users', compact('user'));
	}
}
