@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Marcas</h1>
            <a href="{{ route('marcas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nueva Marca
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
                        @foreach($marcas as $marca)
                            <tr>
                                <td>{{ $marca->id }}</td>
                                <td>{{ $marca->nombre }}</td>
                                <td>
                                    <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta marca?')">
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
                {{ $marcas->links() }}
            </div>
        </div>
    </div>
@endsection