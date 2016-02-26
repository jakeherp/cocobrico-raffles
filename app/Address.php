<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Get the user associated with the address.
     */
    public function user()
    {
        return $this->belongsToOne('App\User');
    }
}
