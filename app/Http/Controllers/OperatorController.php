<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Code;
use App\Raffle;
use App\User;

use Auth;
use DateTime;
use DB;

class OperatorController extends Controller
{
    public function __construct(){
		$this->middleware('operator');
	}

	/**
	 * Shows the operators indexpage.
	 *
	 * @return Response
	 */
    public function index(){
    	$user = Auth::user();
    	return view('operator.index', compact('user'));
	}

	/**
	 * Searches an user by the given value.
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function search(Request $request){
    	$user = Auth::user();
    	$search = $request->search;
    	$member = User::where('firstname','like','%'.$search.'%')
    		->orWhere('lastname','like','%'.$search.'%')
            ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%".$search."%")
            ->orWhere(DB::raw("CONCAT(`lastname`, ' ', `firstname`)"), 'LIKE', "%".$search."%")
            ->get();
    	if(count($member) == 0){
    		$member = User::whereHas('raffles', function ($query) use ($search) {
			    $query->where('code', $search);
			})->get();
    	}
    	if(count($member) == 0){
    		$code = Code::where('code',$search)->first();
    		if($code != null){
    			$member = User::find($code->user_id);
    		}
    	}
        if(count($member) == 0){
            $d = DateTime::createFromFormat(trans('global.dateformat'), $search);
            if($d && $d->format(trans('global.dateformat')) == $search){
                $member = User::whereBetween('birthday', [strtotime($search)-86400, strtotime($search)+86400])->get();
            }
        }
    	if(count($member) == 1){
    		return redirect('operator/'.$member[0]->id);
    	}
    	elseif(count($member) > 1){
            $members = $member;
    		return view('operator.result', compact('user','members'));
    	}
    	else{
    		return redirect('operator')->with('msg', 'Es konnte kein entsprechender Benutzer gefunden werden.')->with('msgState', 'alert');
    	}
	}

	/**
	 * Shows the user operation page.
	 *
	 * @param  integer $id
	 * @return Response
	 */
    public function user($id){
    	$user = Auth::user();
    	$member = User::find($id);
        if($member == null){
            return redirect('operator')->with('msg', 'Es konnte kein entsprechender Benutzer gefunden werden.')->with('msgState', 'alert');
        }
        else{
    	   return view('operator.user', compact('user','member'));
        }
	}
}
