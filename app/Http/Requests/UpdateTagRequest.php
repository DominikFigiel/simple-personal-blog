<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => "required|max:100|unique:tags,name,{$this->id}"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.unique' => 'Tag o takiej nazwie już istnieje.',
            'name.max' => 'Przekroczono limit znaków (:max)',
        ];
    }
}
