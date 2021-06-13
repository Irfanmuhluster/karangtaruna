<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGallery extends FormRequest
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
            'image' => ['required'],
        ];

        $method = request()->method();
        if ($method == 'PUT') {
            $return['image'][0] = 'nullable';
        }

        return $return;
    }

    public function messages()
    {
        return [
            'image.required' => 'image harus diisi',
        ];
    }
}
