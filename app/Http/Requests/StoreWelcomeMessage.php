<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWelcomeMessage extends FormRequest
{

    
    public function rules()
    {
        return [
            'title' => 'required',
            'message' => 'required',
            'image' => 'mimetypes:image/jpeg,image/png|mimes:jpeg,jpg,png|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',

            'message.required' => 'Pesan harus diisi',
            'image.image' => 'image harus jpg atau png',
        ];
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
