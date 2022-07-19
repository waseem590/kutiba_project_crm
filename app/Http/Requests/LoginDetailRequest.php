<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginDetailRequest extends FormRequest
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
            'portal_name'=>'required',
            'password'=>'required',
            'show_password'=>'required',
            'user_id'=>'required'

        ];
    }
}
