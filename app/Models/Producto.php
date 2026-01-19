<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'precio_compra',
        'precio_venta',
        'stock',
        'categoria_id',
        'marca_id',
        'unidad_id'
    ];

    /**
     
     * 
     * Regla de Oro (Integridad Histórica):
     * Usamos ->withTrashed() para que si una Marca/Categoria es eliminada lógicamente,
     * el producto siga mostrando su nombre en los historiales.
     */

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withTrashed();
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class)->withTrashed();
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class)->withTrashed();
    }
}
