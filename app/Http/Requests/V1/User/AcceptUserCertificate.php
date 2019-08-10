<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class AcceptUserCertificate extends FormRequest
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
            'type' => 'required|in:image_national_code,identify_certificate,image_bill,image_selfie_national_code',
            'status' => 'required|boolean'
        ];
    }
}
