<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenda extends FormRequest
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
            'agendatype' => 'required',
            'title' => 'required',
            'event_date' => 'required_if:agendatype,0',
            'content' => 'required',
        
        ];
    }

    public function messages()
    {
        return [
            'agendatype.required' => 'Agenda type harus dipilih',
            'title.required' => 'Judul harus diisi',
            'event_date.required' => 'Tanggal pelaksanaan harus diisi',
            'content.required' => 'Konten harus diisi',
            
        ];
    }
}
