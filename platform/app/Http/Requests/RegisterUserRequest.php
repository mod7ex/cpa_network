<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
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
            'country_id' => 'required|string|max:12|min:12|exists:countries,_id',
            'street_address' => 'required|max:200',
            'city' => 'required|max:100',
            'region' => 'required|max:100',
            'zip_code' => 'required|max:10',
            'phone_number' => 'required|max:20',
            'skype' => 'sometimes|required|string',
            'telegram' => 'sometimes|required|string',

            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }
}