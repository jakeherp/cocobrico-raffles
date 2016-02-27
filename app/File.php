<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Get the user who uploaded the file.
     */
    public function user()
    {
        return $this->belongsTo('App\User','file_user');
    }

    /**
     * Get the raffle, the file was uploaded for.
     */
    public function raffle()
    {
        return $this->belongsTo('App\Raffle','file_user');
    }
}
