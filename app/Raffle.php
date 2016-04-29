<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raffles';

    /**
     * Returns the raffles associated with the user.
     *
     * @return array( Raffle )
     */
    public function users(){
        return $this->belongsToMany('App\User','raffle_user')->withPivot('code','created_at','confirmed','checkin','code_id','updated_at','participated_at','confirmed_at','checkin_at');
    }

    /**
     * Get the codes associated with the raffle.
     */
    public function codes()
    {
        return $this->hasMany('App\Code');
    }

    /**
     * Get the files the raffle has uploaded.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }

   /**
     * Returns the emails associated with the raffle.
     *
     * @return array( Email )
     */
    public function emails(){
        return $this->belongsToMany('App\Email','email_raffle');
    }

    /**
     * Checks if the raffle is expired.
     *
     * @return boolean
     */
    public function expired(){
        if(($this->maxpState == 1 && count($this->users) >= $this->maxp) || ($this->endState == 1 && $this->end <= time()) || ($this->hasEventDate == 1 && $this->eventDate <= time())){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Checks if the maximum number of users is reached.
     *
     * @return boolean
     */
    public function maxpReached(){
        if($this->maxpState == 1 && count($this->users) >= $this->maxp){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Gives back, if the user is already participating in the raffle.
     *
     * @param  integer  $id
     * @return boolean
     */
    public function hasUser($id)
    {
        $check = $this->users()->find($id);
        if(count($check) === 1){
            return true;
        }
        else{
            return false;
        }
    }

}
