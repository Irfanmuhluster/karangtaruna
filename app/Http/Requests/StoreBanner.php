<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
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
        $return = [
            'position' => ['nullable'],
            'title' => ['required', 'string', 'max:255'],
            'urllink' => ['required', 'url'],
            'images' => [
                'required',
                'mimetypes:image/jpeg,image/png',
                'mimes:jpeg,jpg,png',
                'max:1024',
            ],
        ];
        
        $method = request()->method();
        if ($method == 'PUT') {
            $return['images'][0] = 'nullable';
        }

        return $return;
    }

    public function messages()
    {
        return [
            'position.required' => 'Posisi harus dipilih',
            // 'title.unique' => 'Judul sudah ada',
            'title.required' => 'Judul harus diisi',
            'urllink.required' => 'Url harus diisi',
            'images.required' => 'Gambar',
            
        ];
    }
}
