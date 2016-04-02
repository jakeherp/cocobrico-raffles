<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'broadcasts';

    /**
     * Get the users who deactivated the broadcast.
     */
    public function users()
    {
        return $this->belongsToMany('App\User','broadcast_user');
    }
}
