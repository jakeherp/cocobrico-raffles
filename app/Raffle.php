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
        return $this->belongsToMany('App\User','raffle_user')->withPivot('code','created_at');
    }

    /**
     * Get the files the raffle has uploaded.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }

}
