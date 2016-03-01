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

    /**
     * Get the country associated with the address.
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
