<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StudentInformationRequest extends FormRequest
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
        return [
            'surname'        => 'required',
            // 'f_name'     => 'required',
            'l_name'     => 'required',
            'dob'        => 'before:yesterday',
            'gender'        => 'required',
            'nationality'        => 'required',
        ];
        // if ($request->has('surnameCheckbox')) {
        //     return [
        //         // 'surname'        => 'required',
        //         // 'f_name'     => 'required',
        //         'l_name'     => 'required',
        //         'dob'        => 'before:yesterday',
        //         'gender'        => 'required',
        //         'nationality'        => 'required',
        //         'surnameCheckbox' => 'nullable',
        //     ];
        // } else {
        //     return [
        //         'surname'        => 'required',
        //         // 'f_name'     => 'required',
        //         'l_name'     => 'required',
        //         'dob'        => 'before:yesterday',
        //         'gender'        => 'required',
        //         'nationality'        => 'required',
        //     ];
        // }
    }
    public function messages()
    {
        return [
            'surname.required' => 'Please Enter Surname',
            // 'f_name.required' => 'Please Enter First Name',
            'l_name.required' => 'Please Enter Last Name',
            // 'dob.required' => 'Please select Date of Birth',
            'dob.before' => 'Please Select Past Date',
            'gender.required' => 'Please select gender',
            'nationality.required' => 'Please select nationality',

        ];
    }
}
