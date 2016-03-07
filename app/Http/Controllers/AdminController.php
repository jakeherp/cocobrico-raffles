<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Raffle;
use App\User;

use Auth;
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
    	return view('admin.dashboard', compact('user'));
	}

	/**
	 * Shows the codes.
	 *
	 * @return Response
	 */
    public function showCodesView(){
    	$user = Auth::user();
    	$raffles = Raffle::all();
    	return view('admin.codes', compact('user'));
	}

	/**
	 * Shows the codes.
	 *
	 * @return Response
	 */
    public function createCodesView(){
    	$user = Auth::user();
    	return view('admin.create-codes', compact('user'));
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
		return PDF::loadView('pdf.info', compact('user','raffle','preview'))->stream();
	}
}
