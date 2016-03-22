<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateRemarkRequest;

use App\Remark;
use App\User;

use Auth;

class RemarksController extends Controller
{
    public function __construct(){
		$this->middleware('admin');
	}

	/**
	 * Shows the remarks view.
	 *
     * @param  integer $id
	 * @return Response
	 */
    public function remarksView($id){
    	$user = Auth::user();
    	$member = User::find($id);
    	if($member != null){
    		return view('admin.remarks', compact('user','member'));
    	}
    	else{
    		return redirect('admin/users')->with('msg', 'Der gesuchte User existiert nicht.')->with('msgState', 'alert');
    	}
	}

    /**
     * Shows the edit remarks view.
     *
     * @param  integer $id
     * @return Response
     */
    public function edit($id){
        $user = Auth::user();
        $remark = Remark::find($id);
        if($remark != null){
            return view('admin.edit-remark', compact('user','remark'));
        }
        else{
            return redirect('admin/users')->with('msg', 'Der gesuchte Kommentar existiert nicht.')->with('msgState', 'alert');
        }
    }

	/**
	 * Creates a new remark.
	 *
	 * @param  CreateRemarkRequest $request
	 * @return Response
	 */
    public function create(CreateRemarkRequest $request){
    	$member = User::find($request->user_id);
    	if($member != null){
    		$remark = new Remark();
    		$remark->title = $request->title;
    		$remark->body = $request->body;
    		if($request->visible == 0){ $remark->visible = 0; } else { $remark->visible = $request->visible; }
    		$member->remarks()->save($remark);
    		return redirect()->back()->with('msg', 'Der Kommentar wurde erfolgreich erstellt.')->with('msgState', 'success');
    	}
    	else{
    		return redirect('admin/users')->with('msg', 'Der gesuchte User existiert nicht.')->with('msgState', 'alert');
    	}
	}

    /**
     * Updates an existing remark.
     *
     * @param  CreateRemarkRequest $request
     * @return Response
     */
    public function update(CreateRemarkRequest $request){
        $remark = Remark::find($request->id);
        if($remark != null){
            $remark->title = $request->title;
            $remark->body = $request->body;
            if($request->visible == 0){ $remark->visible = 0; } else { $remark->visible = $request->visible; }
            $remark->save();
            return redirect('admin/users/'.$remark->user_id.'/remarks')->with('msg', 'Der Kommentar wurde erfolgreich bearbeitet.')->with('msgState', 'success');
        }
        else{
            return redirect('admin/users')->with('msg', 'Der gesuchte Kommentar existiert nicht.')->with('msgState', 'alert');
        }
    }

	/**
	 * Deletes an existing remark.
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function delete(Request $request){
    	$remark = Remark::find($request->remark_id);
    	if($remark != null){
    		$remark->delete();
    		return redirect()->back()->with('msg', 'Der Kommentar wurde erfolgreich gelöscht.')->with('msgState', 'success');
    	}
    	else{
    		return redirect('admin/users')->with('msg', 'Der gesuchte Kommentar existiert nicht.')->with('msgState', 'alert');
    	}
	}
}
