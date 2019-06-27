<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name'                 => 'required|string|max:20',
            'last_name'                  => 'required|string|max:30',
            'birthday'                   => 'required|string|',
            'address'                    => 'nullable|string|max:255',

            'national_code'              => [
                'required','string', 'min:10', 
                Rule::unique('users')->ignore( request()->route()->user->id )
            ],
            'phone_number'               => [
                'nullable', 'string', 'min:7',
                Rule::unique('users')->ignore( request()->route()->user->id )
            ],

            'email'                      => [
                'nullable',
                Rule::unique('users')->ignore( request()->route()->user->id ),
            ],
            'password'                   => [ 
                $this->method() === 'POST' ? 'required' : 'nullable', 'string', 'min:4', 'confirmed'
            ],

            'avatar'                     => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',

            'image_national_code'        => [
                $this->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024' ],

            'identify_certificate'          => [
                $this->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024' ],
            
            'image_bill'                 => [
                $this->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024' ],
            
            'image_selfie_national_code' => [
                $this->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024' ],
        ];
    }
}
