<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateRaffleRequest;

use App\File;
use App\Raffle;

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
    	$raffle->end = strtotime($request->end);
      if($request->imageReq == null){ $raffle->imageReq = 0; } else { $raffle->imageReq = 1; }
      if($request->legalAgeReq == null){ $raffle->legalAgeReq = 0; } else { $raffle->legalAgeReq = 1; }
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
        $raffle->end = strtotime($request->end);
        if($request->imageReq == null){ $raffle->imageReq = 0; } else { $raffle->imageReq = 1; }
        if($request->legalAgeReq == null){ $raffle->legalAgeReq = 0; } else { $raffle->legalAgeReq = 1; }
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
     * Participates in a raffle.
     *
     * @param Request $request
     * @return Response
     */
    public function participate(Request $request)
    {
        $user = Auth::user();

        $raffleId = $request->id;
        $raffle = Raffle::find($raffleId);
        if(($raffle->legalAgeReq == 1) && (time() - $user->birthday) < 567648000){
            return redirect('dashboard')->with('msg', 'Die Teilnahme am Gewinnspiel ist ab 18 Jahren freigegeben.')->with('msgState', 'alert');
        }
        else{
            $check = null;
            do{
                $code = strtoupper(str_random(6));
                $check = DB::table('raffle_user')->where('code', '=', $code)->get();
            } while($check != null);

            if($raffle->imageReq == 1){
                if($user->files()->where('slug','profile_img')->first() != null){
                    $user->raffles()->attach($raffleId);
                    $user->raffles()->updateExistingPivot($raffleId, ['code' => $code]);
                    $this->participationSucceed($user, $raffle);
                }
                else{
                    return redirect()->back()->withErrors(['Du benötigst ein Profilbild um an diesem Gewinnspiel teilzunehmen.']);
                }
            }
            else{
                $user->raffles()->attach($raffleId);
                $user->raffles()->updateExistingPivot($raffleId, ['code' => $code]);
                $this->participationSucceed($user, $raffle);
            }

            return redirect('dashboard')->with('msg', 'Du hast erfolgreich am Gewinnspiel ' . $raffle->title . ' teilgenommen. Wir haben dir eine Bestätigungsemail geschickt. Überprüfe auch dein Spampostfach.')->with('msgState', 'success');
        }
    }

    /**
     * Handles PDF Creation and Confirmation Email
     *
     * @param User $user
     * @param Raffle $raffle
     * @return true
     */
    protected function participationSucceed($user, $raffle){
        // Generates Confirmation PDF
        $file = new File();
        $file->slug = 'raffle_'.$raffle->id;
        $file->name = 'Teilnahmezertifikat für Gewinnspiel '.$raffle->title;
        //$file->raffle_id = $raffle->id;
        $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
        $user->files()->save($file);

        $qrstring = $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code . ', ' . $user->firstname . ' ' . $user->lastname . ', ' . date(trans('global.dateformat'),$user->birthday);
        QrCode::format('png')->margin(0)->size(200)->generate($qrstring, '../public/files/user_'.$user->id.'/qrcode.png');
        $pdf = PDF::loadView('pdf.info', compact('user','raffle'))->save($file->path);

        // Sends Confirmation Email
        $email = Mail::send('emails.confirmRaffle', compact('user','raffle'), function ($m) use ($user, $file) {
            $m->from('noreply@cb.pcserve.eu', 'Cocobrico');
            $m->attach($file->path);
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Gewinnspiel Teilnahmebestätigung');
        });
        return true;
    }
}
