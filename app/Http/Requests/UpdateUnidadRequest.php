<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('unidades')->ignore($this->route('unidad'))->whereNull('deleted_at'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Esta unidad ya existe.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
        ];
    }
}
