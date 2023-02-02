<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'full_name'=>'required|max:100',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:6',
            'user_name'=>'required|unique:users,user_name'
        ];
    }

    public function messages()
    {
return[
    'full_name.required'  =>__('messages.full_name_req'),
    'email.required'      =>__('messages.Email_Is_Req'),
    'email.unique'        =>__('messages.Email_Is_unique'),
    "user_name.required"  =>__('messages.user_name_req'),
    "user_name.unique"    =>__('messages.user_name_unique'),
    "password.required"   =>__('messages.Pass_req'),
    "password.min"        =>__('messages.Pass_Min'),

];


    }
}
