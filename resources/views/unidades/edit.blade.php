@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Editar Unidad</h1>
            <a href="{{ route('unidades.index') }}" class="btn btn-secondary">
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
                <form action="{{ route('unidades.update', $unidad->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ old('nombre', $unidad->nombre) }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection