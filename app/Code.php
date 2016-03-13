<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';

    /**
     * Get the user associated with the code.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the raffle associated with the code.
     */
    public function raffle()
    {
        return $this->belongsTo('App\Raffle');
    }

    /**
     * Checks if the code is expired.
     *
     * @return boolean
     */
    public function expired(){
        if($this->endtime <= time()){
            return true;
        }
        else{
            return false;
        }
    }
}
