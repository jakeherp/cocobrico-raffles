<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Confirmation;
use App\Email;
use App\File;
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
    	return view('admin.codes', compact('user','raffles'));
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
}
