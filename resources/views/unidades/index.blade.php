@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Unidades</h1>
            <a href="{{ route('unidades.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nueva Unidad
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unidades as $unidad)
                            <tr>
                                <td>{{ $unidad->id }}</td>
                                <td>{{ $unidad->nombre }}</td>
                                <td>
                                    <a href="{{ route('unidades.edit', $unidad->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('unidades.destroy', $unidad->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta unidad?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $unidades->links() }}
            </div>
        </div>
    </div>
@endsection