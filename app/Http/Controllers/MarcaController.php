<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::orderBy('nombre')->paginate(10);
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreMarcaRequest $request)
    {
        Marca::create($request->validated());

        return redirect()->route('marcas.index')
            ->with('success', 'Marca creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\UpdateMarcaRequest $request, Marca $marca)
    {
        $marca->update($request->validated());

        return redirect()->route('marcas.index')
            ->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminada exitosamente.');
    }
}
