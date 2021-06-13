<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreNewsCategory extends FormRequest
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
        // request()->slug = Str::slug(request()->category_name, '-');

        return [
            'category_name' => ['required', 'max:255'],
            // 'slug' => ['nullable', 'max:255', 'unique:App\Models\NewsCategory,category_name,slug', 'alpha_dash'],
            'description' => ['nullable', 'string'],
        ];
    }

    // protected function getValidatorInstance()
    // {
    //     $data = $this->all();
    //     $data['slug'] = Str::slug(request()->category_name, '-');
    //     $this->getInputSource()->replace($data);

    //     /*modify data before send to validator*/

    //     return parent::getValidatorInstance();
    // }

}
