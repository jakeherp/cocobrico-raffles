<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
