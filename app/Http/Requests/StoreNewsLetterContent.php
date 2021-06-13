<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsLetterContent extends FormRequest
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
            'subject' => 'required|string|max:255',
            'from_name' => 'required',
            'from_email' => 'email|required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Judul harus diisi',
            'from_name.required' => 'Nama harus diisi',
            'from_email.required' => 'Email pengirim harus diisi',
            'content.required' => 'Konten harus diisi',
        ];
    }
}
