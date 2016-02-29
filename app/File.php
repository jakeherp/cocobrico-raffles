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
     * Uploads a new file to the given path.
     *
     * @param  request $file
     * @param  string $path
     * @return boolean
     */
    public function uploadFile($file, $path){
        $destinationPath = $path;
        $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->getClientOriginalExtension();
        if(!$file->move(public_path($destinationPath), $filename)){
            return false;
        }
        else{
            return $filename;
        }
    }
}
