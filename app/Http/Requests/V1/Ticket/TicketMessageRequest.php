<?php

namespace App\Http\Requests\V1\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketMessageRequest extends FormRequest
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
            'title'        => 'required|string|max:50',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message'      => 'required|string|min:5',
            
            /* relateion */
            'ticket_id'    => 'required|integer|exists:tickets,id',

        ];
    }
}
