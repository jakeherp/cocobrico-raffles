<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Get the user associated with the remark.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
