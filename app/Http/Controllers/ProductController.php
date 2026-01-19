<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Unidad;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'unidad']);

        // Filtros (Logic Layer)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhereHas('categoria', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhereHas('marca', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            });
        }

        if ($catId = $request->input('categoria_id')) {
            $query->where('categoria_id', $catId);
        }

        if ($marcaId = $request->input('marca_id')) {
            $query->where('marca_id', $marcaId);
        }

        $query->orderBy('nombre');
        $productos = $query->paginate(3);
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = Unidad::orderBy('nombre')->get();

        return view('productos.index', compact('productos', 'categorias', 'marcas', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = Unidad::orderBy('nombre')->get();
        return view('productos.create', compact('categorias', 'marcas', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        Producto::create($request->validated());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = Unidad::orderBy('nombre')->get();
        return view('productos.edit', compact('producto', 'categorias', 'marcas', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function exportPDF(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'unidad']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhereHas('categoria', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhereHas('marca', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            });
        }

        $filtros = [];
        if ($search) {
            $filtros['search'] = $search;
        }

        if ($catId = $request->input('categoria_id')) {
            $query->where('categoria_id', $catId);
            $categoria = Categoria::find($catId);
            $filtros['categoria'] = $categoria ? $categoria->nombre : 'ID: ' . $catId;
        }

        if ($marcaId = $request->input('marca_id')) {
            $query->where('marca_id', $marcaId);
            $marca = Marca::find($marcaId);
            $filtros['marca'] = $marca ? $marca->nombre : 'ID: ' . $marcaId;
        }

        $query->orderBy('nombre');
        $productos = $query->get();
        // $filtros passed compacted above

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('productos.pdf', compact('productos', 'filtros'))
            ->setPaper('a4', 'landscape');
        
        return $pdf->download('productos_' . now()->format('YmdHis') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'unidad']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhereHas('categoria', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhereHas('marca', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            });
        }

        if ($catId = $request->input('categoria_id')) {
            $query->where('categoria_id', $catId);
        }

        if ($marcaId = $request->input('marca_id')) {
            $query->where('marca_id', $marcaId);
        }

        $query->orderBy('nombre');
        $productos = $query->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductosExport($productos), 'productos_' . now()->format('YmdHis') . '.xlsx');
    }
}
