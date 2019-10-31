<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLink extends FormRequest
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
            'instagram' => 'required|max:50|url',
            'telegram' => 'required|max:50|url',
            'whatsapp' => 'required|max:50|url',
        ];
    }

    public function messages ()
    {
        return [
            'instagram.required' => 'لطفا آدرس صفحه خود در اینستاگرام را وارد کنید',
            'instagram.max' => 'لینک اینستاگرام میبایست حداکثر 50 کاراکتر باشد',
            'instagram.url' => 'لطفا لینک صحیح شبکه اجتماعی اینستاگرام را وارد کنید',
       
            'telegram.required' => 'لطفا آدرس صفحه خود در تلگرام را وارد کنید',
            'telegram.max' => 'لینک تلگرام میبایست حداکثر 50 کاراکتر باشد',
            'telegram.url' => 'لطفا لینک صحیح شبکه اجتماعی تلگرام را وارد کنید',
       
            'whatsapp.required' => 'لطفا آدرس صفحه خود در واتس آپ را وارد کنید',
            'whatsapp.max' => 'ای دی میبایست حداکثر 50 کاراکتر باشد',
            'whatsapp.url' => 'لطفا لینک صحیح شبکه اجتماعی واتس آپ را وارد کنید',
        ];
    }
}