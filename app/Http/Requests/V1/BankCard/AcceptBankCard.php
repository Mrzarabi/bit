<?php

namespace App\Http\Requests\V1\BankCard;

use Illuminate\Foundation\Http\FormRequest;

class AcceptBankCard extends FormRequest
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
            'type' => 'required|in:image_bank_card',
            'status' => 'required|boolean'
        ];
    }
}
