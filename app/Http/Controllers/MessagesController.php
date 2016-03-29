<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

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
    	$message->sent_at = time();
    	$message->save();
    	return 1;
    }

    /**
     * Get all messages.
     *
     * @return Response
     */
    public function get(){
    	$user = Auth::user();
    	$user->messages()->update(['read'=>1]);
    	return $user->messages()->orderBy('sent_at', 'desc')->get();
    }
}
