<?php

namespace App\Http\Requests\V1\Spec;

use Illuminate\Foundation\Http\FormRequest;

class SpecHeaderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|string|max:50',
            'description' => 'nullable|string|max:255',

            /* relateion */
            'spec_id'    => 'required|integer|exists:specs,id',
        ];
    }
}
