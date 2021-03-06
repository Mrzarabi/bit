<?php

namespace App\Http\Requests\V1\Grouping;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title'         => 'required|string|max:50',
            'description'   => 'nullable|string|max:255',
            'logo'          => [
                'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],

            /*Relation */
            'parent_id'     => 'nullable|integer|exists:categories,id',
        ];
    }
}
