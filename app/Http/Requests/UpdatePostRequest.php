<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => "required|max:100",
            'slug' => "required|max:100|unique:posts,slug,{$this->id}",
            'category_id' => 'required',
            'image' => 'nullable|file|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Pole nazwa jest wymagane.',
            'title.max' => 'Przekroczono limit znaków (:max)',
            'slug.unique' => 'Taki slug już istnieje',
            'category_id.required' => 'Wybierz kategorię wpisu'
        ];
    }
}
