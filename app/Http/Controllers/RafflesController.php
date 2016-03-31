<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateRaffleRequest;

use App\Code;
use App\Email;
use App\File;
use App\Raffle;
use App\User;

use Auth;
use DB;
use Mail;
use QrCode;
use PDF;

class RafflesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['participate']]);
    }
    
    /**
	 * Creates a new raffle.
	 *
	 * @param  CreateRaffleRequest $request
	 * @return Response
	 */
    public function create(CreateRaffleRequest $request){
    	$raffle = new Raffle();
    	$raffle->title = $request->title;
    	$raffle->body = $request->body;
    	$raffle->start = strtotime($request->start);
      $raffle->endState = $request->endState;
      $raffle->maxpState = $request->maxpState;
      $raffle->hasEventDate = $request->hasEventDate;
      if($raffle->maxpState == 0)      { $raffle->maxp = 0; }         else { $raffle->maxp = $request->maxp; }
      if($raffle->endState == 0)       { $raffle->end = 0; }          else { $raffle->end = strtotime($request->end); }
      if($raffle->hasEventDate == 0)   { $raffle->eventDate = 0; }    else { $raffle->eventDate = strtotime($request->eventDate); }
      if($request->imageReq == null)   { $raffle->imageReq = 0; }     else { $raffle->imageReq = 1; }
      if($request->legalAgeReq == null){ $raffle->legalAgeReq = 0; }  else { $raffle->legalAgeReq = 1; }
      if($request->sendPdf == null)    { $raffle->sendPdf = 0; }      else { $raffle->sendPdf = 1; }
      if($request->instWin == null)    { $raffle->instWin = 0; }      else { $raffle->instWin = 1; }

      if($raffle->endState == 1 && $raffle->hasEventDate == 1 && $raffle->eventDate < $raffle->end){
        return redirect()->back()->withInput()->withErrors(['Das Event-Datum kann nicht vor dem End-Datum liegen.']);
      }

      if($raffle->maxpState == 1 && count($raffle->users) >= $raffle->maxp){
        $raffle->maxpReached = 1;
      }
      else{
        $raffle->maxpReached = 0;
      }

    	$raffle->save();

        if ($request->hasFile('rafflePicture')) {  
          if ($request->file('rafflePicture')->isValid()) {
            $file = $request->file('rafflePicture');
            $destinationPath = '/files/raffle_' . $raffle->id;
            $upload = new File();
            $filename = $upload->uploadFile($file, $destinationPath);
            if(!$filename){
              return redirect()->back()->withInput()->withErrors(['Fileupload went wrong!']);
            }
            else{
              $upload->slug = 'raffle_img';
              $upload->name = 'Aktionsgrafik';
              $upload->path = 'files/raffle_' . $raffle->id . '/' . $filename;
              $raffle->files()->save($upload);
            }
          }
        }

    	return redirect('admin/raffles');
    }

    /**
     * Deletes an existing raffle.
     *
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request){
        $raffle = Raffle::find($request->raffleId);
        $raffle->delete();

        return redirect('admin/raffles');
    }

    /**
     * Edits a existing raffle.
     *
     * @param  CreateRaffleRequest $request
     * @return Response
     */
    public function edit(CreateRaffleRequest $request){
        $raffle = Raffle::find($request->id);
        $raffle->title = $request->title;
        $raffle->body = $request->body;
        $raffle->start = strtotime($request->start);
        $raffle->endState = $request->endState;
        $raffle->maxpState = $request->maxpState;
        $raffle->hasEventDate = $request->hasEventDate;
        if($raffle->maxpState == 0)      { $raffle->maxp = 0; }         else { $raffle->maxp = $request->maxp; }
        if($raffle->endState == 0)       { $raffle->end = 0; }          else { $raffle->end = strtotime($request->end); }
        if($raffle->hasEventDate == 0)   { $raffle->eventDate = 0; }    else { $raffle->eventDate = strtotime($request->eventDate); }
        if($request->imageReq == null)   { $raffle->imageReq = 0; }     else { $raffle->imageReq = 1; }
        if($request->legalAgeReq == null){ $raffle->legalAgeReq = 0; }  else { $raffle->legalAgeReq = 1; }
        if($request->sendPdf == null)    { $raffle->sendPdf = 0; }      else { $raffle->sendPdf = 1; }
        if($request->instWin == null)    { $raffle->instWin = 0; }      else { $raffle->instWin = 1; }

        if($raffle->endState == 1 && $raffle->hasEventDate == 1 && $raffle->eventDate < $raffle->end){
          return redirect()->back()->withInput()->withErrors(['Das Event-Datum kann nicht vor dem End-Datum liegen.']);
        }

        if($raffle->maxpState == 1 && count($raffle->users) >= $raffle->maxp){
          $raffle->maxpReached = 1;
        }
        else{
          $raffle->maxpReached = 0;
        }

        $raffle->save(); 

        if ($request->hasFile('rafflePicture')) { 
          if ($request->file('rafflePicture')->isValid()) {
            $file = $request->file('rafflePicture');
            $destinationPath = '/files/raffle_' . $raffle->id;
            if(($upload = $raffle->files()->where('slug','raffle_img')->first()) == null){
              $upload = new File();
            }
            else{
              unlink(public_path($upload->path));
            }
            $filename = $upload->uploadFile($file, $destinationPath);
            if(!$filename){
              return redirect()->back()->withInput()->withErrors(['Fileupload went wrong!']);
            }
            else{
              $upload->slug = 'raffle_img';
              $upload->name = 'Aktionsgrafik';
              $upload->path = 'files/raffle_' . $raffle->id . '/' . $filename;
              $raffle->files()->save($upload);
            }
          }
        }

        return redirect('admin/raffles/'.$raffle->id);
    }

    /**
     * Edits the emails of the raffle.
     *
     * @param  Request $request
     * @return Response
     */
    public function emails(Request $request){
      $raffle = Raffle::find($request->id);
      $raffle->emails()->detach();
      $raffle->emails()->attach([$request->confirmRaffle, $request->confirmRaffleNoPdf, $request->confirmCode, $request->confirmManual]);
      return redirect('admin/raffles')->with('msg', 'Die Emails wurden erfolgreich zugeordnet.')->with('msgState', 'success');
    }

    /**
     * Participates in a raffle.
     *
     * @param Request $request
     * @return Response
     */
    public function participate(Request $request)
    {
      $user = Auth::user();

      $raffle = Raffle::find($request->id);
      if(($raffle->legalAgeReq == 1) && (time() - $user->birthday) < 567648000){
        return redirect('dashboard')->with('msg', 'Die Teilnahme an der Aktion ist ab 18 Jahren freigegeben.')->with('msgState', 'alert');
      }
      elseif($raffle->expired()){
        return redirect('dashboard')->with('msg', 'Die Aktion ist bereits beendet.')->with('msgState', 'alert');
      }
      elseif( $user->hasRaffle($raffle->id) ){
        return redirect('dashboard')->with('msg', 'Du nimmst bereits an dieser Aktion teil.')->with('msgState', 'alert');
      }
      else{
        do{
          $pCode = strtoupper(str_random(6));
          $check = DB::table('raffle_user')->where('code', '=', $pCode)->get();
        } while($check != null);

        // Error, if Profile Picture is required and User has none
        if($raffle->imageReq == 1){
          if($user->files()->where('slug','profile_img')->first() == null){
            return redirect()->back()->withErrors(['Du benötigst ein Profilbild um an dieser Aktion teilzunehmen.']);
          }
        }

        if(isset($request->code) && $request->code != ''){
          $code = Code::where('code',$request->code)->where('raffle_id',$raffle->id)->first();
          if($code == null){
            return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist ungültig.')->with('msgState', 'alert');
          }
          elseif($code->active != 1 || $code->expired()){
            return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist nicht mehr aktiv.')->with('msgState', 'alert');
          }
          elseif($code->user != null){
            return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist bereits vergeben.')->with('msgState', 'alert');
          }
          else{
            $code->user_id = $user->id;
            $code->save();
            $user->raffles()->attach($raffle->id);
            $user->raffles()->updateExistingPivot($raffle->id, ['code' => $pCode, 'confirmed' => 1, 'code_id' => $code->id]);
            $confirmed = true;
          }
        }
        elseif($raffle->instWin == 1){
          $user->raffles()->attach($raffle->id);
          $user->raffles()->updateExistingPivot($raffle->id, ['code' => $pCode, 'confirmed' => 1]);
          $confirmed = true;
        }
        else{
          $user->raffles()->attach($raffle->id);
          $user->raffles()->updateExistingPivot($raffle->id, ['code' => $pCode]);
          $confirmed = false;
        }
        $this->participationSucceed($user, $raffle, $confirmed);

        return redirect('dashboard')->with('msg', 'Du hast erfolgreich an der Aktion ' . $raffle->title . ' teilgenommen. Wir haben dir eine Bestätigungsemail geschickt. Überprüfe auch dein Spampostfach.')->with('msgState', 'success');
      }
    }

    /**
     * Handles PDF Creation and Confirmation Email
     *
     * @param User $user
     * @param Raffle $raffle
     * @return true
     */
    protected function participationSucceed($user, $raffle, $confirmed = false){
        if($raffle->maxpReached()){
          $raffle->maxpReached = 1;
          $raffle->save();
        }
        if($raffle->sendPdf == 1 || $confirmed || $raffle->instWin == 1){

          $qrstring = $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code . ', ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
          QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');

          if($confirmed){
            $email = $raffle->emails()->where('slug','confirmCode')->first();
            if($email == null){
              $email = Email::where('standard',1)->where('slug','confirmCode')->first();
            }
            $email->prepare($user, $raffle);

            $send = Mail::send('emails.confirmCode', compact('user','raffle','email'), function ($m) use ($user, $email, $raffle) {
              $m->from($email->email, $email->from);
              foreach($email->confirmations as $confirmation){
                $file = new File();
                $file->slug = 'raffle_' . $raffle->id;
                $file->name = $confirmation->title . ' (Aktion ' . $raffle->title . ')';
                $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
                $user->files()->save($file);
                $confirmation->prepare($user, $raffle);
                $pdf = PDF::loadView('pdf.info', compact('user','raffle','confirmation'))->save($file->path);
                $m->attach($file->path);
              }
              $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
            });
          }
          else{
            $email = $raffle->emails()->where('slug','confirmRaffle')->first();
            if($email == null){
              $email = Email::where('standard',1)->where('slug','confirmRaffle')->first();
            }
            $email->prepare($user, $raffle);

            $send = Mail::send('emails.confirmRaffle', compact('user','raffle','email'), function ($m) use ($user, $email, $raffle) {
              $m->from($email->email, $email->from);
              foreach($email->confirmations as $confirmation){
                $file = new File();
                $file->slug = 'raffle_' . $raffle->id;
                $file->name = $confirmation->title . ' (Aktion ' . $raffle->title . ')';
                $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
                $user->files()->save($file);
                $confirmation->prepare($user, $raffle);
                $pdf = PDF::loadView('pdf.info', compact('user','raffle','confirmation'))->save($file->path);
                $m->attach($file->path);
              }
              $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
            });
          }
        }
        else {
          $email = $raffle->emails()->where('slug','confirmRaffleNoPdf')->first();
          if($email == null){
            $email = Email::where('standard',1)->where('slug','confirmRaffleNoPdf')->first();
          }
          $email->prepare($user, $raffle);
          $send = Mail::send('emails.confirmRaffleNoPdf', compact('user','raffle','email'), function ($m) use ($user, $email) {
              $m->from($email->email, $email->from);
              $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
          });
        }
        return true;
    }

    /**
     * Confirms a user code, after the user already participated in an action.
     *
     * @param Request $request
     * @return Response
     */
    public function confirmUserCode(Request $request){
      $user = Auth::user();
      $raffle = Raffle::find($request->id);
      $code = Code::where('code',$request->code)->where('raffle_id',$raffle->id)->first();
      if($code == null){
        return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist ungültig.')->with('msgState', 'alert');
      }
      elseif($code->active != 1 || $code->expired()){
        return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist nicht mehr aktiv.')->with('msgState', 'alert');
      }
      elseif($code->user != null){
        return redirect('dashboard')->with('msg', 'Der eingegebene Code '.$request->code.' ist bereits vergeben.')->with('msgState', 'alert');
      }
      else{
        $code->user_id = $user->id;
        $code->save();
        $user->raffles()->updateExistingPivot($raffle->id, ['confirmed' => 1, 'code_id' => $code->id]);

        $email = $raffle->emails()->where('slug','confirmCode')->first();
        if($email == null){
          $email = Email::where('standard',1)->where('slug','confirmCode')->first();
        }

        if(count($email->confirmations) > 0){
          $qrstring = $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code . ', ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
          QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');
        }

        $email->prepare($user, $raffle);

          $send = Mail::send('emails.confirmCode', compact('user','raffle','email'), function ($m) use ($user, $email, $raffle) {
            $m->from($email->email, $email->from);
            foreach($email->confirmations as $confirmation){
              $file = new File();
              $file->slug = 'raffle_' . $raffle->id;
              $file->name = $confirmation->title . ' (Aktion ' . $raffle->title . ')';
              $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
              $user->files()->save($file);
              $confirmation->prepare($user, $raffle);
              $pdf = PDF::loadView('pdf.info', compact('user','raffle','confirmation'))->save($file->path);
              $m->attach($file->path);
            }
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
          });

        return redirect('dashboard')->with('msg', 'Dein Code wurde für die Aktion <strong>' . $raffle->title . '</strong> bestätigt. Wir haben dir eine Bestätigungsemail gesendet.')->with('msgState', 'success');
      }
    }

    /**
     * Confirms a user for the raffle manually.
     *
     * @param Request $request
     * @return Response
     */
    public function confirmUser(Request $request){
      $raffle = Raffle::find($request->raffle_id);
      $user = $raffle->users()->find($request->user_id);
      $code = $raffle->codes()->where('remark','MMM')->where('active',1)->where('user_id',0)->where('endtime','>=',time())->first();

      if($code == null){
        return redirect()->back()->with('msg', 'Der User ' . $user->firstname . ' ' . $user->lastname . ' konnte nicht bestätigt werden, da kein verfügbarer Code mit dem Kommentar "MMM" für die Aktion <strong>' . $raffle->title . '</strong> vorhanden ist.')->with('msgState', 'alert');
      }
      else{
        $code->user_id = $user->id;
        $code->save();
        $raffle->users()->updateExistingPivot($user->id, ['confirmed' => 1, 'code_id' => $code->id]);

        $email = $raffle->emails()->where('slug','confirmManual')->first();
        if($email == null){
          $email = Email::where('standard',1)->where('slug','confirmManual')->first();
        }

        if(count($email->confirmations) > 0){
          $qrstring = $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code . ', ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
          QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');
        }

        $email->prepare($user, $raffle);
        
          $send = Mail::send('emails.confirmCode', compact('user','raffle','email'), function ($m) use ($user, $email, $raffle) {
            $m->from($email->email, $email->from);
            foreach($email->confirmations as $confirmation){
              $file = new File();
              $file->slug = 'raffle_' . $raffle->id;
              $file->name = $confirmation->title . ' (Aktion ' . $raffle->title . ')';
              $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
              $user->files()->save($file);
              $confirmation->prepare($user, $raffle);
              $pdf = PDF::loadView('pdf.info', compact('user','raffle','confirmation'))->save($file->path);
              $m->attach($file->path);
            }
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
          });

        return redirect()->back()->with('msg', 'Der User ' . $user->firstname . ' ' . $user->lastname . ' wurde für die Aktion <strong>' . $raffle->title . '</strong> bestätigt.')->with('msgState', 'success');
      }
    }

    /**
     * Resends the confirmation email.
     *
     * @param  Request $request
     * @return Response
     */
    public function resendConfirmation(Request $request){
        $user = User::find($request->user_id);
        $raffle = $user->raffles()->where('raffle_id', $request->raffle_id)->first();
        $code_id = $raffle->pivot->code_id;

        $winCode = Code::find($code_id);
        if($winCode->remark == 'MMM'){
            $emailtype = 'confirmManual';
        }
        else{
            $emailtype = 'confirmCode';
        }
        
        $email = $raffle->emails()->where('slug',$emailtype)->first();
        if($email == null){
          $email = Email::where('standard',1)->where('slug',$emailtype)->first();
        }

        if(count($email->confirmations) > 0){
          $qrstring = $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code . ', ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
          QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');
        }

        $email->prepare($user, $raffle);
        
          $send = Mail::send('emails.confirmCode', compact('user','raffle','email'), function ($m) use ($user, $email, $raffle) {
            $m->from($email->email, $email->from);
            foreach($email->confirmations as $confirmation){
              $file = new File();
              $file->slug = 'raffle_' . $raffle->id;
              $file->name = $confirmation->title . ' (Aktion ' . $raffle->title . ')';
              $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
              $user->files()->save($file);
              $confirmation->prepare($user, $raffle);
              $pdf = PDF::loadView('pdf.info', compact('user','raffle','confirmation'))->save($file->path);
              $m->attach($file->path);
            }
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject($email->subject);
          });

        return redirect()->back()->with('msg', 'Die Bestätigung für das Gewinnspiel '.$raffle->title.' wurde erneut an den Teilnehmer '.$user->firstname. ' '.$user->lastname.' verschickt.')->with('msgState', 'success');
    }
}
