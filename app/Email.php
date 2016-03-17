<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use URL;

class Email extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emails';

    /**
     * Get the raffle associated with the email.
     */
    public function raffle()
    {
        return $this->belongsTo('App\Raffle');
    }

    /**
     * Returns the confirmations (pdf) associated with the email.
     *
     * @return array( Confirmation )
     */
    public function confirmations(){
        return $this->belongsToMany('App\Confirmation','confirmation_email');
    }

    /**
     * Returns the raffles associated with the email.
     *
     * @return array( Raffle )
     */
    public function raffles(){
        return $this->belongsToMany('App\Raffle','email_raffle');
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
        ];
        $this->body = strtr( $this->body , $replace );

        return true;
    }
}
