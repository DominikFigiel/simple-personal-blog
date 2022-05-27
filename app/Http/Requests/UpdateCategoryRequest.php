<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => "required|max:100|unique:categories,name,{$this->id}"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.unique' => 'Kategoria o takiej nazwie już istnieje.',
            'name.max' => 'Przekroczono limit znaków (:max)',
        ];
    }
}
