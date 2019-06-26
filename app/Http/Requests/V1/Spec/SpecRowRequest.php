<?php

namespace App\Http\Requests\V1\Spec;

use Illuminate\Foundation\Http\FormRequest;

class SpecRowRequest extends FormRequest
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
            'title'     => 'required|string|max:50',
            'label'     => 'nullable|string|max:50',
            'values'    => 'nullable|string|max:255',
            'help'      => 'nullable|string|max:255',
        ];
    }
}
