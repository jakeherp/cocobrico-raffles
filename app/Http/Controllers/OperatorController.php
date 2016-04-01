<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Code;
use App\Email;
use App\File;
use App\Raffle;
use App\User;

use Auth;
use DateTime;
use DB;
use QrCode;
use PDF;
use Mail;

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
      $raffles = Raffle::where(function($q) {
                $q->where('start','<=',time())
                ->where(function ($query) {
                    $query->where('hasEventDate','=',1)
                          ->where('eventDate','>',time())
                          ->orWhere('hasEventDate','=',0);
                })
                ->where('endState','=',0)
                ->where('maxpState','=',0)
                ->orWhere(function ($query) {
                    $query->where('start','<=',time())
                          ->where('endState','=',1)
                          ->where('end','>',time());
                })
                ->orWhere(function ($query) {
                    $query->where('start','<=',time())
                      ->where('maxpState','=',1)
                      ->where('maxpReached','=',0);
                });
            })
            ->orderBy('start', 'asc')->get();
        if($user == null){
            return redirect('operator')->with('msg', 'Es konnte kein entsprechender Benutzer gefunden werden.')->with('msgState', 'alert');
        }
        else{
    	   return view('operator.user', compact('user','member','raffles'));
        }
	}

    /**
     * Confirms a user for the raffle manually.
     *
     *
     * @param Request $request
     * @return Response*/
    public function checkin(Request $request){
      $operator = Auth::user();
      $raffle = Raffle::find($request->raffle_id);
      $user = $raffle->users()->find($request->user_id);
      $code = $raffle->codes()->where('remark','MMM')->where('active',1)->where('user_id',0)->where('endtime','>=',time())->first();

      if($code == null){
        return redirect()->back()->with('msg', 'Der User ' . $user->firstname . ' ' . $user->lastname . ' konnte nicht bestätigt werden, da kein verfügbarer Code vorhanden ist.')->with('msgState', 'alert');
      }
      else{
        $code->user_id = $user->id;
        $code->save();
        $raffle->users()->updateExistingPivot($user->id, ['confirmed' => 1, 'code_id' => $code->id]);

        $email = $raffle->emails()->where('slug','confirmManual')->first();
        if($email == null){
          $email = Email::where('standard',1)->where('slug','confirmManual')->first();
        }

        if($operator->hasPermission('is_admin')){
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
        }

        return redirect()->back()->with('msg', 'Der User ' . $user->firstname . ' ' . $user->lastname . ' wurde für die Aktion <strong>' . $raffle->title . '</strong> bestätigt.')->with('msgState', 'success');
      }
    }

    /**
     * Participates in a raffle.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
      $operator = Auth::user();
      $raffle = Raffle::find($request->raffle_id);
      $user = User::find($request->user_id);

      if(($raffle->legalAgeReq == 1) && (time() - $user->birthday) < 567648000){
        return redirect()->back()->with('msg', 'Die Teilnahme an der Aktion ist ab 18 Jahren freigegeben.')->with('msgState', 'alert');
      }
      elseif($raffle->expired()){
        return redirect()->back()->with('msg', 'Die Aktion ist bereits beendet.')->with('msgState', 'alert');
      }
      elseif( $user->hasRaffle($raffle->id) ){
        return redirect()->back()->with('msg', 'Der Benutzer nimms bereits an dieser Aktion teil.')->with('msgState', 'alert');
      }
      else{
        // Error, if Profile Picture is required and User has none
        if($raffle->imageReq == 1 && (!isset($request->nopic) || $request->nopic == null)){
          if($user->files()->where('slug','profile_img')->first() == null){
            return view('operator.no-picture',compact('raffle','user'));
          }
        }

        do{
          $pCode = strtoupper(str_random(6));
          $check = DB::table('raffle_user')->where('code', '=', $pCode)->get();
        } while($check != null);

        $user->raffles()->attach($raffle->id);
        $user->raffles()->updateExistingPivot($raffle->id, ['code' => $pCode]);
        $confirmed = false;

        if($operator->hasPermission('is_admin')){
            $this->participationSucceed($user, $raffle, $confirmed);
        }

        return redirect('operator/'.$user->id)->with('msg', 'Der User wurde erfolgreich für die Aktion ' . $raffle->title . ' registriert.')->with('msgState', 'success');
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
}
