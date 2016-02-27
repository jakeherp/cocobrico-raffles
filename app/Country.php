<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Returns an associative array with key 'id' and value 'name'.
     *
     * @return array $array
     */
    public static function getForView(){
    	$countries = Country::where('active','=',1)->get();
    	$array = [];
    	foreach($countries AS $country){
    		$array[$country->id] = trans('localization.'.$country->iso);
    	}
    	return $array;
    }
}
