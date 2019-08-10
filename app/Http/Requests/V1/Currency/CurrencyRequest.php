<?php

namespace App\Http\Requests\V1\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
            'title'                => 'required|string|max:50',
            'short_description'    => 'nullable|string|max:255',
            'note'                 => 'nullable|string|max:255',
            'price'                => 'required|integer',
            'inventory'            => 'required|integer',
            'code'                 => 'nullable|string',
            'status'               => 'required|integer',
            'photo'                => [
                request()->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],
            
            // 'photo'          => 'required|image|mimes:jpeg,jpg,png|max:1024',
            
            /* relateion */
            'categories.*'          => 'required|integer|exists:categories,id',
            "specs"                 => 'nullable|array',
            "specs.*"               => 'nullable|array',
            "specs.*.id"            => 'nullable|integer|exists:specs,id',
            "specs.*.data"          => 'nullable',
        ];
    }
}
