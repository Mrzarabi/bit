<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name'               => 'required|string|max:20',
            'second_name'              => 'required|string|max:20',
            'last_name'                => 'required|string|max:30',

            'social_link'              => 'required|string|min:10|unique:users,social_links',
            'phone_number'             => 'nullable|integer|min:7|unique:users,phone-number',
            'birthday'                 => 'required|string|',
            'address'                  => 'nullable|string|max:255',

            'email'                    => 'nullable|unique:users,email',
            'password'                 => 'required|string|min:4',

            'avatar'                   => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',

            'image_social_link'        => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
            'image_certificate'        => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
            'image_bill'               => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
            'image_selfie_social_link' => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
        ];
    }
}
