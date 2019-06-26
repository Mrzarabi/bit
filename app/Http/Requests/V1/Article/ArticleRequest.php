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
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            
            /* relateion */
            'subject_id'    => 'required|integer|exists:subjects,id',
        ];
    }
}
