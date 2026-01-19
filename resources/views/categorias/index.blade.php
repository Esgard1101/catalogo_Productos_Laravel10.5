@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Categorías</h1>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nueva Categoría
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                                            class="btn btn-sm btn-warning text-white" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
@endsection