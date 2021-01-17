<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check() &&
            (auth('admin')->user()->roles['offer']['create'] ||
                auth('admin')->user()->roles['offer']['update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /**/
            'name' => 'required|string',
            'description' => 'required|string',
            'payout' => 'required|integer|digits_between:2,5',

            'landing_pages' => 'sometimes|required|array',
            'landing_pages.*' => 'sometimes|required|string|min:12|max:12',

            'restriction_ids' => 'sometimes|required|array',
            'restriction_ids.*' => 'sometimes|required|string|min:12|max:12',

            'promotion_method_ids' => 'sometimes|required|array',
            'promotion_method_ids.*' => 'sometimes|required|string|min:12|max:12',

            'niche_ids' => 'sometimes|required|array',
            'niche_ids.*' => 'sometimes|required|string|min:12|max:12',

            'payout_type_ids' => 'required|array',
            'payout_type_ids.*' => 'string|min:12|max:12',

            'vertical_ids' => 'sometimes|required|array',
            'vertical_ids.*' => 'sometimes|required|string|min:12|max:12',

            'device_ids' => 'sometimes|required|array',
            'device_ids.*' => 'sometimes|required|string|min:12|max:12',

            'os_ids' => 'sometimes|required|array',
            'os_ids.*' => 'sometimes|required|string|min:12|max:12',

            'browser_ids' => 'sometimes|required|array',
            'browser_ids.*' => 'sometimes|required|string|min:12|max:12',

            'country_ids' => 'sometimes|required|array',
            'country_ids.*' => 'sometimes|required|string|min:12|max:12',

            // 'images' => '',

            # promotion
            'promotion.public' => 'required|boolean',
            'promotion.hidden' => 'required|boolean',

            'promotion.promoters' => 'sometimes|required|array',
            'promotion.promoters.*' => 'sometimes|required|string|min:12|max:12',

            'promotion.pending_promoters' => 'sometimes|required|array',
            'promotion.pending_promoters.*' => 'sometimes|required|string|min:12|max:12',

            'promotion.rejected_promoters' => 'sometimes|required|array',
            'promotion.rejected_promoters.*' => 'sometimes|required|string|min:12|max:12',
            /**/
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'title.required' => 'A title is required',
            // 'body.required' => 'A message is required',
            'payout_type_ids.required' => 'Payout types are required',
            // 'payout_type_ids.*' => '',
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            // 'email' => 'email address',
            'payout_type_ids' => 'payout types',
            // 'payout_type_ids.*' => '',
        ];
    }
}