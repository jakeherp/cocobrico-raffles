<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateRaffleRequest;

use App\File;
use App\Raffle;

use Auth;

class RafflesController extends Controller
{
    public function __construct(){
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
        $user->raffles()->attach($raffleId);

        $raffle = Raffle::find($raffleId);

        if($raffle->imageReq == 1){
            if ($request->hasFile('file')) {
                if ($request->file('file')->isValid()) {
                    $file = $request->file('file');
                    $destinationPath = '/files/user_' . $user->id;
                    $upload = new File();
                    $filename = $upload->uploadFile($file, $destinationPath);
                    if(!$filename){
                        return redirect()->back()->withInput()->withErrors(['Fileupload went wrong!']);
                    }
                    else{
                        $upload->name = 'Datei für Gewinnspiel ' . $raffle->title;
                        $upload->path = '/files/user_' . $user->id . '/' . $filename;
                        $user->files()->save($upload);
                        $raffles->files()->attach($upload->id);
                    }
                }
            }
        }

        return redirect()->back();
    }
}
