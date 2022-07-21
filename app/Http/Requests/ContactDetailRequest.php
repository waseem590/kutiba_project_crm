<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactDetailRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->address_details == 'offshore') {
            return [
                'email'        => ['required', 'email'],
                // 'phone_number[]'     => 'required',
                // 'number2'     => 'numeric',
                // 'street_address'        => 'required',
                // 'suburb'        => 'required',
                // 'state'        => 'required',
                // 'country'        => 'required',
            ];
        } else {
            return [
                'email'        => ['required', 'email'],
                // 'phone_number[]'     => 'required',
                // 'number2'     => 'numeric',
                'street_address'        => 'required',
                'suburb'        => 'required',
                'state'        => 'required',
                'country'        => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'email.required' => 'Please Enter email',
            // 'phone_number[].required' => 'Please Enter Number',
            // 'number.numeric' => 'Please Enter Number',
            // 'number2.numeric' => 'Please Enter Number',
            'street_address.required' => 'Please enter street address',
            'suburb.required' => 'Please enter suburb',
            'state.required' => 'Please enter state',
            'country.required' => 'Please select country',

        ];
    }
}
