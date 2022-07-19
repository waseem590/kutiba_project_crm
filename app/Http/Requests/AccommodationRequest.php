<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
            'accommodation_type'=>'required',
            'placement_fee'=>'required|numeric',
            'accommodation_fee'=>'required|numeric',
            'arrival_date'=>'required',
            'airport_pickup'=>'accepted',
            'airport_pickup_fee'=>'required|numeric',
            'status'=>'required',
        ];
    }
    public function messages()
    {
        return [

            'accommodation_type'=>'required',
            'placement_fee.required'=>'Placement Fee is required',
            'accommodation_fee.required'=>'Accommodation Fee is required',
            'arrival_date.required'=>'Arrival Date is required',
            'airport_pickup.required_without_all'=>'Airport Pickup is Required',
            'airport_pickup_fee.required'=>'Airport Kickup Fee is required',
            'status.required'=>'Status is required',
        ];
    }
}
