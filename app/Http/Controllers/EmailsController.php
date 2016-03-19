<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateEmailRequest;

use App\Code;
use App\Email;
use App\Raffle;
use App\User;

use Auth;

class EmailsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    /**
	 * Create a new email.
	 *
     * @param CreateEmailRequest $request
	 * @return Response
	 */
    public function create(CreateEmailRequest $request){
    	$email = new Email();
    	$email->email = $request->email;
    	$email->from = $request->from;
    	$email->subject = $request->subject;
    	$email->body = $request->body;
        $email->description = $request->description;
    	$email->slug = $request->slug;
    	$email->save();

    	return redirect('admin/emails')->with('msg', 'Die Email wurde erfolgreich erstellt.')->with('msgState', 'success');
    }

    /**
     * Edits a existing email.
     *
     * @param CreatePdfRequest $request
     * @return Response
     */
    public function edit(CreateEmailRequest $request){
        $email = Email::find($request->id);
        if($email != null){
            $email->email = $request->email;
            $email->from = $request->from;
            $email->subject = $request->subject;
            $email->body = $request->body;
            $email->description = $request->description;
            if($email->standard != 1){
                $email->slug = $request->slug;
            }
            $email->save();
            return redirect('admin/emails')->with('msg', 'Die Email wurde erfolgreich bearbeitet.')->with('msgState', 'success');
        }
        else{
            return redirect('admin/emails');
        }
    }

    /**
     * Deletes an existing email.
     *
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request){
        $email = Email::find($request->emailId);
        if($email != null){
            if($email->standard == 1){
                return redirect('admin/emails')->with('msg', 'Standard-Emails können nicht gelöscht werden.')->with('msgState', 'alert');
            }
            else{
                $email->confirmations()->detach();
                $email->delete();
                return redirect('admin/emails')->with('msg', 'Die Email wurde erfolgreich gelöscht.')->with('msgState', 'success');
            }
        }
        else{
            return redirect('admin/emails');
        }
    }

    /**
     * Shows the preview for the email.
     *
     * @param  integer $id
     * @return Response
     */
    public function preview($id){
        $user = Auth::user();
        $raffle = Raffle::first();
        $email = Email::find($id);
        $confirmations = $email->confirmations()->get();
        $body = $email->prepare($user, $raffle);

        if($email != null){
            return view('emails.confirmCode', compact('user','raffle','email'));
        }
        else{
            return redirect('admin/emails')->with('msg', 'Die Email konnte nicht gefunden werden.')->with('msgState', 'alert');
        }
    }

    /**
     * Attaches pdfs to the email.
     *
     * @param  Request $request
     * @return Response
     */
    public function pdf(Request $request){
        $controle = [];
        $email = Email::find($request->id);
        $email->confirmations()->detach();
        for($i = 1; $i <= $request->counter; $i++){
            $id = $request['attachement_'.$i];
            if($id != 0 && !in_array($id, $controle)){
                array_push($controle, $id);
                $email->confirmations()->attach($id);
            }
        }
        if(count($controle) == 0){
            return redirect('admin/emails');
        }
        else{
            return redirect('admin/emails')->with('msg', 'Die Dateien wurden erfolgreich an die Email angehängt.')->with('msgState', 'success');
        }
    }
}
