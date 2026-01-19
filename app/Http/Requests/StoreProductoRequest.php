<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'codigo' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('productos')->whereNull('deleted_at')
            ],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'gt:precio_compra'],
            'stock' => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'marca_id' => ['required', 'exists:marcas,id'],
            'unidad_id' => ['required', 'exists:unidades,id'],
            'descripcion' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'Este código ya está registrado.',
            'precio_venta.gt' => 'El precio de venta debe ser mayor al precio de compra.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'marca_id.required' => 'Debe seleccionar una marca.',
            'unidad_id.required' => 'Debe seleccionar una unidad.',
        ];
    }
}
