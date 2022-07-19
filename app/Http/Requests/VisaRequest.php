<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class VisaRequest extends FormRequest
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
        if($request->student_name){
            return [
                'student_name'=>'required',
                'case_officer'=>'required',
                // 'date_visa'=>'required',
                'visa_type'=>'required',
                'num_applicants'=>'required|numeric',
                'visa_status'=>'required',
                'immigration_fees'=>'required|numeric',
                'immigration_pay_method'=>'required',
                'immigration_dop'=>'required',
                // 'immigration_dop'=>'required|date|after:start_date',
                'service_fee'=>'required|numeric',
                'service_pay_method'=>'required',
                'service_dop'=>'required',
                'visa_expire_date'=>'required',
            ];
        }
        else
        {
            return [
                'case_officer'=>'required',
                'name'=>'required',
                'phone_number'=>'required|numeric',
                'email'=>'required',
                // 'date_visa'=>'required',
                'visa_type'=>'required',
                'num_applicants'=>'required|numeric',
                'visa_status'=>'required',
                'immigration_fees'=>'required|numeric',
                'immigration_pay_method.required'=>'required',
                'immigration_dop'=>'required',
                'service_fee'=>'required|numeric',
                'service_pay_method'=>'required',
                'service_dop'=>'required',
                'visa_expire_date'=>'required',
                'nationality'=>'required',
            ];
        }
    }
}
