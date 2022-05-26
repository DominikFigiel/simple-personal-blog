<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:categories|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.unique' => 'Kategoria o takiej nazwie już istnieje.',
            'name.max' => 'Przekroczono limit znaków (:max)'
        ];
    }
}
