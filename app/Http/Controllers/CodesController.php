<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateCodesRequest;

use App\Code;
use App\Raffle;
use App\User;

class CodesController extends Controller
{
	public function __construct(){
		$this->middleware('admin');
	}

  /**
	 * Creates new codes.
	 *
   * @param CreateCodesRequest $request
	 * @return Response
	 */
    public function create(CreateCodesRequest $request){
  		$raffle = Raffle::find($request->raffle_id);
  		if($raffle == null){
  			return redirect('admin/codes')->with('msg', 'Das Gewinnspiel, für welches Codes erzeugt werden sollten, existiert nicht.')->with('msgState', 'alert');
  		}
  		else{
  			for($i = 1; $i <= $request->amount; $i++){
  				$code = new Code();
  				do{
  					$code->code = strtoupper(str_random(10));
  					$check = Code::where('code',$code->code)->first();
  					if($check == null){ $unique = true; } else { $unique = false; }
  				} while(!$unique);
  				$code->remark = $request->remark;
  				$code->endtime = strtotime($request->endtime);
  				$raffle->codes()->save($code);
  			}
  			return redirect('admin/codes')->with('msg', 'Die Codes wurden erfolgreich erstellt.')->with('msgState', 'success');
  		}
	 }

  /**
   * Deactivates a code.
   *
   * @param Request $request
   * @return Response
   */
    public function deactivate(Request $request){
      $code = Code::find($request->code_id);
      if($code == null){
        return redirect('admin/codes')->with('msg', 'Der zu deaktivierende Code konnte nicht gefunden werden.')->with('msgState', 'alert');
      }
      elseif($code->user != null){
        return redirect('admin/codes')->with('msg', 'Der Code ' . $code->code . ' konnte nicht gelöscht werden, da er bereits einem Benutzer zugeordnet wurde.')->with('msgState', 'alert');
      }
      else{
        $code->active = 0;
        $code->save();
        return redirect('admin/codes/'.$code->raffle_id)->with('msg', 'Der Code ' . $code->code . ' wurde erfolgreich deaktiviert.')->with('msgState', 'success');
      }
   }

  /**
   * Deactivates a code.
   *
   * @param Request $request
   * @return Response
   */
    public function deactivateAction(Request $request){
      $code = Code::find($request->code_id);
      if($code != null && $code->user == null){
        $code->active = 0;
        $code->save();
      }
   }

	/**
     * Generates the code.
     *
     * @return string $code;
     */
    public function generate($raffle){
    	$step1 = hash('sha256',time());
    	$step2 = hash('sha256',$raffle->id);
    	$step3 = hash('sha256',mt_rand());
    	$step4 = hash('sha256',$step1.$step2.$step3);
    	$length = strlen($step4);
    	$code = '';
    	for($i = 1; $i <= 5; $i++){
    		$position = rand(0,$length);
    		$code .= substr($step4,$position,1);
    	}
      return strtoupper($code.str_random(5));
    }

  /**
   * Print View for a code.
   *
   * @param integer $id
   * @return Response
   */
    public function printCodes($id){
      $raffle = Raffle::find($id);
      return view('admin.codes-print',compact('raffle'));
   }
}
