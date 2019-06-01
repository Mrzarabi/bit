<?php

namespace App\Http\Requests\V1\Opinion;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'message'       => 'required|string|min:5',
            
            /*Relation*/
            'parent_id'     => 'nullable|integer|exists:comments,id',
            'article_id'    => 'required|integer|exists:articles,id',
        ];
    }
}
