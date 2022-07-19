<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnivesityRequest extends FormRequest
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
            'en_title'=>'required',
            'ar_title'=>'required',
            // 'uni_file'=>'required|mimes:jpeg,png,jpg',
            'doc_file'=>'mimes:doc,docx',
            'ppt_file'=>'mimes:ppt',
            'exl_file'=>'mimes:csv,xlsx,xls',
            'english_summernote'=>'required',
            'arabic_summernote'=>'required',
        ];
    }
    public function messages(){
        return [
            'en_title.required'=>'English title is required',
            'ar_title.required'=>'Arabic title is required',
            // 'uni_file.required'=>'University image is required',
            'doc_file.mimes'=>'File type must be in word',
            'ppt_file.mimes'=>'File type must be in powerpoint',
            'exl_file.mimes'=>'File type must be in excel',
            'english_summernote.required'=>'English title is required',
            'arabic_summernote.required'=>'English title is required',
        ];
    }
}
