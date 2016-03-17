<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreatePdfRequest;

use App\Confirmation;
use App\Raffle;
use App\User;

use Auth;
use PDF;
use QrCode;

class ConfirmationsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    /**
	 * Create a new pdf.
	 *
     * @param CreatePdfRequest $request
	 * @return Response
	 */
    public function create(CreatePdfRequest $request){
    	$confirmation = new Confirmation();
    	$confirmation->title = $request->title;
    	$confirmation->description = $request->description;
    	$confirmation->body = $request->body;
    	$confirmation->save();
    	return redirect('admin/pdf')->with('msg', 'Die PDF wurde erfolgreich erstellt.')->with('msgState', 'success');
    }

    /**
     * Edits a existing pdf.
     *
     * @param CreatePdfRequest $request
     * @return Response
     */
    public function edit(CreatePdfRequest $request){
        $confirmation = Confirmation::find($request->id);
        if($confirmation != null){
            $confirmation->title = $request->title;
            $confirmation->description = $request->description;
            $confirmation->body = $request->body;
            $confirmation->save();
            return redirect('admin/pdf')->with('msg', 'Die PDF wurde erfolgreich bearbeitet.')->with('msgState', 'success');
        }
        else{
            return redirect('admin/pdf');
        }
    }

    /**
     * Deletes an existing pdf.
     *
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request){
        $confirmation = Confirmation::find($request->pdfId);
        if($confirmation != null){
            if($confirmation->standard == 1){
            	return redirect('admin/pdf')->with('msg', 'Standard-PDFs können nicht gelöscht werden.')->with('msgState', 'alert');
            }
            else{
                $confirmation->emails()->detach();
            	$confirmation->delete();
            	return redirect('admin/pdf')->with('msg', 'Die PDF wurde erfolgreich gelöscht.')->with('msgState', 'success');
            }
        }
        else{
            return redirect('admin/pdf');
        }
    }

    /**
     * Shows the preview for the pdf.
     *
     * @param  integer $id
     * @return Response
     */
    public function preview($id){
        $user = Auth::user();
        $raffle = Raffle::first();
        $confirmation = Confirmation::find($id);
        $body = $confirmation->prepare($user, $raffle);
        $preview = true;

        $qrstring = 'PREVIEW, ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
        QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');

        if($confirmation != null){
            return PDF::loadView('pdf.info', compact('user','raffle','confirmation','preview'))->stream();
        }
        else{
            return redirect('admin/pdf')->with('msg', 'Die PDF konnte nicht gefunden werden.')->with('msgState', 'alert');
        }
    }
}
