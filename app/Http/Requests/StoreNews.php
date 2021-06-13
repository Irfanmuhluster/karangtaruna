<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNews extends FormRequest
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

    public function rules()
    {
        // dd(request());
        return [
            'category' => 'required',
            // 'title' => 'required|min:4|unique:App\Models\StoreNews,title|max:255',
            'content' => 'required|min:4',
            'image' => 'mimetypes:image/jpeg,image/jpg,image/png|mimes:jpeg,jpg,png|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',
            // 'title.unique' => 'Judul sudah ada',
            'content.required' => 'Pesan harus diisi',
            'image.mimetypes' => 'image harus jpg atau png',
        ];
    }
}
