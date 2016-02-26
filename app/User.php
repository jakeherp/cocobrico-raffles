<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns the addresses associated with the user.
     *
     * @return array( Address )
     */
    public function addresses(){
        return $this->hasMany('App\Address');
    }

    /**
     * Get the permissions associated with the user.
     */
    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    /**
     * Returns the raffles associated with the user.
     *
     * @return array( Raffle )
     */
    public function raffles(){
        return $this->belongsToMany('App\Raffle');
    }

    /**
     * Gives back, if the user has a given permission.
     *
     * @param  string  $slug
     * @return boolean
     */
    public function hasPermission($slug)
    {
        $check = $this->permissions()->where('slug', $slug)->get();
        if(count($check) === 1){
            return true;
        }
        else{
            return false;
        }
    }
}
