<?php

namespace App\Http\Requests\V1\Spec;

use Illuminate\Foundation\Http\FormRequest;

class SpecRequest extends FormRequest
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

            /* relateion */
            'parent'    => 'required|integer|exists:categories,id', 
        ];
    }
}
