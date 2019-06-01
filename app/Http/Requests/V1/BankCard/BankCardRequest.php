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
            'bank_name'          => 'required|string|',
            'bank_card'          => 'required|integer|digit:16',
            'code'               => 'required|string|digit:24',
            'image_benk_card'    => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
        ];
    }
}
