<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTagRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:tags|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.unique' => 'Tag o takiej nazwie już istnieje.',
            'name.max' => 'Przekroczono limit znaków (:max)'
        ];
    }
}
