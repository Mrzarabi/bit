<?php

namespace App\Http\Requests\V1\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title'          => 'required|string|max:50',
            'description'    => 'nullable|string|max:255',
            'body'           => 'required|string',
            'image'          => [
                $this->method() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:1024'
            ],
            
            /* relateion */
            'subject_id'    => 'nullable|integer|exists:subjects,id',
        ];
    }
}
