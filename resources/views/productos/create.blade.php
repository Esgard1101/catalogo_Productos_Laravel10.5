@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Crear Producto</h1>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="precio_compra" class="form-label">Precio Compra</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control"
                                    value="{{ old('precio_compra') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="precio_venta" class="form-label">Precio Venta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control"
                                    value="{{ old('precio_venta') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-select" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select name="marca_id" id="marca_id" class="form-select" required>
                                <option value="">Seleccione una marca</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="unidad_id" class="form-label">Unidad</label>
                            <select name="unidad_id" id="unidad_id" class="form-select" required>
                                <option value="">Seleccione una unidad</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id }}" {{ old('unidad_id') == $unidad->id ? 'selected' : '' }}>
                                        {{ $unidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection