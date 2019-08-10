<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class ImageProfileRequest extends FormRequest
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
            'image_national_code'       => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],

            'identify_certificate'      => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],

            'image_bill'                => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],

            'image_selfie_national_code'=> [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],
        ];
    }
}
