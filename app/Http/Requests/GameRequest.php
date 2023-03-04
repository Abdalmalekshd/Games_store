<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'game_name_ar'      => 'required|max:40|min:5',
            'game_name_en'      => 'required|max:40|min:5',
            'details_ar'        => 'required|max:1000|min:10',
            'details_en'        => 'required|max:1000|min:10',
            'photo'             => 'required|mimes:png,jpg,jpeg,gif|max:10240',
            'link'              => 'required|mimetypes:application/zip,application/x-rar-compressed',

        ];
    }

    public function messages()
    {
        return [
            'game_name_ar.required'          => __('messages.Game_Name_In_Ar_Err_Msg'),
            'game_name_en.required'          => __('messages.Game_Name_In_En_Err_Msg'),
            'details_ar.required'            => __('messages.Game_Details_In_Ar_Err_Msg'),
            'details_en.required'            => __('messages.Game_Details_In_En_Err_Msg'),
            'photo.required'                 => __('messages.Game_Photo_Err_Msg'),
            'photo.mimes'                    =>__('messages.Game_Photo_type_Err'),
            'photo.max'                    =>__('messages.Game_Photo_Max_Size'),
            'link.required'                  => __('messages.Game_Link_Err_Msg'),
            'link.mimetypes'                  => __('messages.Game_Link_Type_Err'),

            
        ];
    }
}
