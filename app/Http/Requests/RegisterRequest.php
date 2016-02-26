<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'          =>  ['required','same:password_2','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'password_2'        =>  ['required'],
            'firstname'         =>  ['required'],
            'lastname'          =>  ['required'],
            'phone'             =>  ['required'],
            'register_token'    =>  ['required','exists:users,register_token'],
            'email'             =>  ['required','email','exists:users,email'], 
        ];
    }
}
