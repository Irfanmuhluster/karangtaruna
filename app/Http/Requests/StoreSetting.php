<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetting extends FormRequest
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
            'title' => 'required',
            'favicon' => 'mimetypes:image/x-icon|mimes:ico|max:1024',
            'logo' => 'mimetypes:image/jpeg,jpg,image/png|mimes:jpeg,jpg,png|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',
            // 'title.unique' => 'Judul sudah ada',
            'favicon.mimetypes' => 'favicon harus .ico',
            'logo.mimetypes' => 'logo harus jpg atau png',
        ];
    }
}
