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
        return $this->belongsToMany('App\User','raffle_user')->withPivot('code','created_at','confirmed','code_id');
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
     * Checks if the raffle is expired.
     *
     * @return boolean
     */
    public function expired(){
        if(($this->maxpState == 1 && count($this->users) >= $this->maxp) || ($this->endState == 1 && $this->end <= time())){
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

}
