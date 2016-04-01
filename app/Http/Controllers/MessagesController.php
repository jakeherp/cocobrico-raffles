<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;
use App\User;

use Auth;

class MessagesController extends Controller
{
    /**
     * Sends a message.
     *
     * @param  string $message
     * @return Response
     */
    public function send(Request $request){
    	$user = Auth::user();
    	$message = new Message();
    	$message->user_id = $user->id;
    	$message->text = $request->message;
        $message->read = 0;
    	$message->sent_at = time();
    	$message->save();
    	return 1;
    }

    /**
     * Answers a message.
     *
     * @param  Request $request
     * @return Response
     */
    public function answer(Request $request){
    	$user = Auth::user();
    	$member = User::find($request->member_id);
    	if($user->hasPermission('is_admin')){
    		$member->messages()->update(['answered'=>1]);
    	}
    	$message = new Message();
    	$message->user_id = $member->id;
    	$message->text = $request->message;
    	$message->answer = 1;
    	$message->answered = 1;
        $message->read = 0;
    	$message->sent_at = time();
    	$message->save();

        if($member->aMessage == 1){
            $sent = Mail::send('emails.aMessage', ['user' => $member, 'message' => $message], function ($m) use ($member) {
              $m->from('noreply@cocobrico.com', 'Cocobrico');
              $m->to($member->email, $member->email)->subject('Neue Nachricht');
            });
        }

    	return 1;
    }

    /**
     * Get all messages.
     *
     * @return Response
     */
    public function get(){
    	$user = Auth::user();
        $messages = $user->messages()->where('answer',1)->where('read',0)->orderBy('sent_at', 'asc')->get();
    	$user->messages()->where('answer',1)->update(['read'=>1]);
    	return $messages;
    }

    /**
     * Get all messages.
     *
     * @return Response
     */
    public function adminGet($user){
        $user = User::find($user);
        $messages = $user->messages()->where('answer',0)->where('read',0)->orderBy('sent_at', 'asc')->get();
        $user->messages()->where('answer',0)->update(['read'=>1]);
        return $messages;
    }
}
