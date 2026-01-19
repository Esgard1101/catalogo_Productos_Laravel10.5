<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $productos;

    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    public function collection()
    {
        return $this->productos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Categoría',
            'Marca',
            'Precio Compra',
            'Precio Venta',
            'Stock',
            'Margen (%)',
            'Estado',
        ];
    }

    public function map($producto): array
    {
        $margen = $producto->precio_compra > 0
            ? (($producto->precio_venta - $producto->precio_compra) / $producto->precio_compra) * 100
            : 0;

        return [
            $producto->id,
            $producto->nombre,
            $producto->categoria->nombre ?? 'N/A',
            $producto->marca->nombre ?? 'N/A',
            $producto->precio_compra,
            $producto->precio_venta,
            $producto->stock,
            number_format($margen, 2) . '%',
            $producto->stock > 0 ? 'Disponible' : 'Agotado',
        ];
    }
}
