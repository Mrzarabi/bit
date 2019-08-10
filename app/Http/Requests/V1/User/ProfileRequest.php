<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'first_name'                 => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string', 'max:20'
            ],

            'last_name'                  => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string', 'max:30'
            ],

            'birthday'                   => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string'
            ],

            'address'                    => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string', 'max:255'
            ],

            'national_code'              => [
                'required','string', 'min:10', 
                Rule::unique('users')->ignore( request()->route()->parameters['user'] ), 'regex:/^[0-9]{10}$/'
            ],

            'phone_number'               => [
                'nullable', 'string', 'min:7',
                Rule::unique('users')->ignore( request()->route()->parameters['user'] ), 'regex:/^(\+98|0)?9\d{9}$/'
            ],

            'email'                      => [
                'nullable',
                Rule::unique('users')->ignore( request()->route()->parameters['user'] ),
            ],

            'avatar'                    => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],  
        ];
    }
}