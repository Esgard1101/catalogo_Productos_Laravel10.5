<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidad::orderBy('nombre')->paginate(10);
        return view('unidades.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnidadRequest $request)
    {
        Unidad::create($request->validated());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidad creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad)
    {
        return view('unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnidadRequest $request, Unidad $unidad)
    {
        $unidad->update($request->validated());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidad $unidad)
    {
        $unidad->delete();

        return redirect()->route('unidades.index')
            ->with('success', 'Unidad eliminada exitosamente.');
    }
}
