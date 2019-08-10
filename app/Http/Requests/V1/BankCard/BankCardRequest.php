<?php

namespace App\Http\Requests\V1\BankCard;

use Illuminate\Foundation\Http\FormRequest;

class BankCardRequest extends FormRequest
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
            'bank_name'          => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string',
            ],
            'bank_card'          => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'integer', 'digits:16',
            ],
            'code'               => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'string', 'regex:/^[a-z0-9_-]{3,16}$/',
            ],
            'image_bank_card'        => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024' 
            ],
        ];
    }
}
