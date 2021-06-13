<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenus extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'menu_label' => 'required|string|max:255',
            'menu_route_index' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'menu_label.required' => 'Nama Menu harus diisi',
            'menu_route_index.required' => 'Route harus diisi',
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
