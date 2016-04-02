<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateBroadcastRequest;

use App\Broadcast;

use Auth;

class BroadcastsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['deactivate']]);
    }

    /**
     * Shows the admins broadcast view.
     *
     * @return Response
     */
    public function broadcastsView(){
      $user = Auth::user();
      $broadcasts = Broadcast::all();
      return view('admin.broadcasts',compact('user','broadcasts'));
    }

    /**
     * Shows the create broadcast view.
     *
     * @return Response
     */
    public function createView(){
      $user = Auth::user();
      return view('admin.create-broadcast',compact('user'));
    }

    /**
     * Shows the edit broadcast view.
     * 
     * @param  integer $id
     * @return Response
     */
    public function edit($id){
      $user = Auth::user();
      $broadcast = Broadcast::find($id);
      if($broadcast != null){
        return view('admin.edit-broadcast',compact('user','broadcast'));
      }
      else{
        return redirect('admin/broadcasts')->with('msg', 'Der Broadcast konnte nicht gefunden werden.')->with('msgState', 'alert');
      }
    }

    /**
     * Deletes an existing broadcast.
     *
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request){
        $broadcast = Broadcast::find($request->broadcast_id);
        if($broadcast == null){
          return redirect('admin/broadcasts')->with('msg', 'Der Broadcast konnte nicht gefunden werden.')->with('msgState', 'alert');
        }
        else{
          $broadcast->delete();
          return redirect('admin/broadcasts')->with('msg', 'Der Broadcast wurde erfolgreich gelöscht.')->with('msgState', 'success');
        }
    }

    /**
   	 * Deactivates a broadcast.
   	 *
   	 * @param Request $request
   	 * @return Response
   	 */
    public function deactivate(Request $request){
    	$user = Auth::user();
      	$broadcast = Broadcast::find($request->broadcast_id);
        if($broadcast == null){
        	return redirect('dashboard')->with('msg', 'Der Broadcast konnte nicht gefunden werden.')->with('msgState', 'alert');
        }
      	else{
        	$user->broadcasts()->attach($broadcast->id);
        	return redirect('dashboard');
      	}
    }

    /**
    * Creates a new broadcast.
    *
    * @param  CreateBroadcastRequest $request
    * @return Response
    */
    public function create(CreateBroadcastRequest $request){
      $broadcast = new Broadcast();
      $broadcast->headline = $request->headline;
      $broadcast->text = $request->text;
      $broadcast->expiryDate = strtotime($request->expiryDate);
      $broadcast->slug = $request->slug;

      $broadcast->save();

      return redirect('admin/broadcasts')->with('msg', 'Der Broadcast wurde erfgolgreich erstellt.')->with('msgState', 'success');
    }

    /**
    * Edits a broadcast.
    *
    * @param  CreateBroadcastRequest $request
    * @return Response
    */
    public function update(CreateBroadcastRequest $request){
      $broadcast = Broadcast::find($request->id);
      $broadcast->headline = $request->headline;
      $broadcast->text = $request->text;
      $broadcast->expiryDate = strtotime($request->expiryDate);
      $broadcast->slug = $request->slug;

      $broadcast->save();

      return redirect('admin/broadcasts')->with('msg', 'Der Broadcast wurde erfgolgreich editiert.')->with('msgState', 'success');
    }
}
