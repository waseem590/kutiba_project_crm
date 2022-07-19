<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisaCommentRequest extends FormRequest
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
            'visa_comment'=>'required'
        ];
    }
    public function messages(){
        return [
            'visa_comment.required'=>'Write a comment'
        ];
    }
}
