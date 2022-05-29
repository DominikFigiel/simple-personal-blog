<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'max:250',
            'slug' => 'required|max:250|unique:posts',
            'body' => 'max:250',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Pole nazwa jest wymagane.',
            'title.max' => 'Przekroczono limit znaków (:max)',
            'slug.unique' => 'Taki slug już istnieje',
        ];
    }
}
