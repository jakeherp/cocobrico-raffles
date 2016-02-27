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
        return $this->belongsToMany('App\User','raffle_user');
    }

    /**
     * Get the files which were uploaded for the raffle.
     */
    public function files()
    {
        return $this->hasMany('App\File','file_user');
    }

}
