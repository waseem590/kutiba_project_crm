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
            'name'        => 'required',
            'email'     => ['required','email'],
            // 'current_password'     => 'required',
            // 'password'     => 'required',
            // 'confirmpassword'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'email.required' => 'Please Enter First Eame',
            // 'current_password.required' => 'Please Enter Current Password',
            // 'password.required' => 'Please Enter New Password',
            // 'confirmpassword.required' => 'Please Enter Confirm Password',

        ];
    }
}
