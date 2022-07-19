<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolContactRequest extends FormRequest
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
            'staf_name'        => 'required',
            'job_title'     => 'required',
            'email'     => ['required','email'],
            // 'email'=>'required|unique:school_contacts,email',
            'phone_number[]'        => 'required',
            'dob'        => 'before:yesterday',
            'notes'        => 'required',
        ];
    }
    public function messages()
    {
        return [
            'staf_name.required' => 'Please Enter Staff Name',
            'job_title.required' => 'Please Enter Job Tittle',
            'email.required' => 'Please Enter Email',
            'email.email' => 'Please Enter Valid Email',
            // 'email.unique' => 'Email already exist',
            'phone_number[].required' => 'Please Enter Number',
            'notes.required' => 'Please Write Some Notes',
            'dob.before' => 'Please Select Past Date',

        ];
    }
}
