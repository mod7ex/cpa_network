<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'website' => 'sometimes|required|url',
            'country_id' => 'required|string|exists:countries,_id',
            'street_address' => 'required|max:200',
            'city' => 'required|max:100',
            'region' => 'required|max:100',
            'zip_code' => 'required|max:10',
            'phone_number' => 'required|max:20',
            'skype' => 'sometimes|required|string',
            'telegram' => 'sometimes|required|string',

            'title' => 'sometimes',
            'timezone_id' => 'sometimes|exists:timezones,_id',
            'best_time_to_call' => 'sometimes|max:1|min:0',

            'password' => 'required|min:6|confirmed',

            'payment_method_id' => 'sometimes|required|exists:payment_methods,_id',
            'min_payout' => 'sometimes',
            'billing_details.email' => 'sometimes|email',
        ];
    }


    public function messages()
    {
        return [
            'country_id.required' => 'country field is required',
        ];
    }
}