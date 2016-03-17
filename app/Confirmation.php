<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use URL;

class Confirmation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'confirmations';

    /**
     * Returns the emails associated with the confirmation (pdf).
     *
     * @return array( Email )
     */
    public function emails(){
        return $this->belongsToMany('App\Email','confirmation_email');
    }

    /**
     * Fills all variables in the body with the values.
     *
     * @param  User $user
     * @param  Raffle $raffle
     * @return string $body
     */
    public function prepare($user, $raffle){
        $replace = [
            '[date]'            =>  date('d.m.Y'),

            '[firstname]'       =>  $user->firstname,
            '[lastname]'        =>  $user->lastname,
            '[email]'           =>  $user->email,
            '[birthday]'        =>  date(trans('global.dateformat'), $user->birthday),
            '[created_at]'      =>  date(trans('global.dateformat'), strtotime($user->created_at)),

            '[actionTitle]'     =>  $raffle->title,
            '[actionBody]'      =>  $raffle->body,

            '[logo]'            =>  '<img src="'. URL::asset('img/logo.png') .'" class="logo">',
            '[qrCode]'          =>  '<img src="'. URL::asset('files/user_'.$user->id.'/qrcode.png') .'" class="qr-code">',
        ];
        $this->body = strtr( $this->body , $replace );

        if(($file = $user->files()->where('slug','profile_img')->first()) != null){
            $this->body = str_replace ( '[profilePicture]' , '<img src="'. URL::asset($file->path) .'" class="photo">' , $this->body);
        }
        else{
            $this->body = str_replace ( '[profilePicture]' , ' ' , $this->body);
        }
        if(($code = $user->raffles()->where('raffle_id', $raffle->id)->first()) != null){
            $this->body = str_replace ( '[pCode]' , $code->pivot->code , $this->body);
        }
        else{
            $this->body = str_replace ( '[pCode]' , 'PREVIEW' , $this->body);
        }
        if(($file = $raffle->files()->where('slug','raffle_img')->first()) != null){
            $this->body = str_replace ( '[actionPicture]' , '<img src="'. URL::asset($file->path) .'" class="post-photo">' , $this->body);
        }
        else{
            $this->body = str_replace ( '[actionPicture]' , ' ' , $this->body);
        }
        return true;
    }
}
