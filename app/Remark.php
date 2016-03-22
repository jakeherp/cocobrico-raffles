<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'remarks';

    /**
     * Get the user associated with the remark.
     */
    public function user()
    {
        return $this->belongsToOne('App\User');
    }
}
