<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'users_id' => 'required',
            'title'=>'required',
            'periority' => 'required',
            'message' => 'required',
        ];
    }

    public function messages(){
        return [
        'users_id.required' => 'Please Enter User Name',
        'title.required' => 'Please Enter Title',
        'periority.required' => 'Please Enter Periority',
        'message.required' => 'Please Enter Message',
        ];
    }
}
