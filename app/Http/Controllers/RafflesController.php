<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateRaffleRequest;

use App\File;
use App\Raffle;

use Auth;
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
        if($request->imageReq == null){
            $raffle->imageReq = 0;
        }
        else{
            $raffle->imageReq = 1;
        }
    	$raffle->save();

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
        $raffle->save();

        return redirect()->back();
    }

    /**
     * Participates in a raffle.
     *
     * @return Response
     */
    public function participate(Request $request)
    {
        $user = Auth::user();

        $raffleId = $request->id;
        $raffle = Raffle::find($raffleId);

        if($raffle->imageReq == 1){
            if($user->files()->where('slug','profile_img')->first() != null){
                $user->raffles()->attach($raffleId);
                
                // Generate Confirmation PDF
                $file = new File();
                $file->slug = 'raffle_'.$raffle->id;
                $file->name = 'Teilnahmezertifikat für Gewinnspiel '.$raffle->title;
                $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
                $user->files()->save($file);
                $pdf = PDF::loadView('pdf.info', compact('user','raffle'))->save('files/user_'.$user->id.'/'.md5($file->slug . microtime()).'.pdf');
            }
            else{
                return redirect()->back()->withErrors(['Sie benötigen ein Profilbild um an diesem Gewinnspiel teilzunehmen.']);
            }
        }
        else{
            $user->raffles()->attach($raffleId);

            // Generate Confirmation PDF
            $file = new File();
            $file->slug = 'raffle_'.$raffle->id;
            $file->name = 'Teilnahmezertifikat für Gewinnspiel '.$raffle->title;
            $file->path = 'files/user_' . $user->id . '/' . md5($file->slug . microtime()) . '.pdf';
            $user->files()->save($file);
            $pdf = PDF::loadView('pdf.info', compact('user','raffle'))->save('files/user_'.$user->id.'/'.md5($file->slug . microtime()).'.pdf');
        }

        return redirect()->back();
    }
}
