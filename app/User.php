<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Storage;

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
     * Returns the address associated with the user.
     *
     * @return array( Address )
     */
    public function address(){
        return $this->hasOne('App\Address');
    }

    /**
     * Get the permissions associated with the user.
     */
    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    /**
     * Get the files the user has uploaded.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }

    /**
     * Returns the raffles associated with the user.
     *
     * @return array( Raffle )
     */
    public function raffles(){
        return $this->belongsToMany('App\Raffle','raffle_user')->withPivot('code');
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

    /**
     * Gives back, if the user is already participating in the raffle.
     *
     * @param  integer  $id
     * @return boolean
     */
    public function hasRaffle($id)
    {
        $check = $this->raffles()->find($id);
        if(count($check) === 1){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Gives back, if the personal file folder already exists if not it creates it.
     *
     * @return boolean
     */
    public function fileFolder()
    {
        if(file_exists (public_path('files/user_' . $this->id))){
            return true;
        }
        else{
            return mkdir(public_path('files/user_' . $this->id));
        }
    }
}
