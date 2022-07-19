<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddApplicationRequest extends FormRequest
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
            'destination'        => 'required',
            'institute_name'     => 'required',
            // 'duration_start_date'        => 'before:yesterday',
            // 'certificate1'        => 'before:yesterday',
            // 'certificate2'        => 'before:yesterday',
            // 'certificate3'        => 'before:yesterday',
            // 'certificate4'        => 'before:yesterday',
            // 'foundation_date'        => 'before:yesterday',
            // 'associate_deg_date'        => 'before:yesterday',
            // 'diploma_start_date'        => 'before:yesterday',
            // 'advance_diploma_date'        => 'before:yesterday',
            // 'bechelor_deg_date'        => 'before:yesterday',
            // 'bechelor_honours_date'        => 'before:yesterday',
            // 'graduate_diploma_date'        => 'before:yesterday',
            // 'master_deg_date'        => 'before:yesterday',
            // 'doctoral_deg_date'        => 'before:yesterday',
            // 'primary_school'        => 'before:yesterday',
            // 'high_school'        => 'before:yesterday',
         ];
    }

    public function messages()
    {
        return [
            'destination.required' => 'Please Select Destination',
            'institute_name.required' => 'Please Select Institute Name',
            // 'duration_start_date.before' => 'Please Select Past Date',
            // 'certificate1.before' => 'Please Select Past Date',
            // 'certificate2.before' => 'Please Select Past Date',
            // 'certificate3.before' => 'Please Select Past Date',
            // 'certificate4.before' => 'Please Select Past Date',
            // 'foundation_date.before' => 'Please Select Past Date',
            // 'associate_deg_date.before' => 'Please Select Past Date',
            // 'diploma_start_date.before' => 'Please Select Past Date',
            // 'advance_diploma_date.before' => 'Please Select Past Date',
            // 'bechelor_deg_date.before' => 'Please Select Past Date',
            // 'graduate_diploma_date.before' => 'Please Select Past Date',
            // 'master_deg_date.before' => 'Please Select Past Date',
            // 'doctoral_deg_date.before' => 'Please Select Past Date',
            // 'primary_school.before' => 'Please Select Past Date',
            // 'high_school.before' => 'Please Select Past Date',
        ];
    }
}
