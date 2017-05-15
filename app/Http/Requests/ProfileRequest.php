<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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

            'name' => 'required',
            'postname' => 'required',
            'prename' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
//    public function messages()
//    {
//        return [
//            'photo_profil_user.image' => 'La photo du profil doit être une image',
//            'photo_mur_user.image' => 'La photo de couverture doit être une image',
//        ];
//    }
}
