@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Lista de Productos</h4>
                <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo Producto</a>
            </div>

            <!-- Filtros y Exportaciones -->
            <div class="bg-light p-3 rounded">
                <form action="{{ route('productos.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="search" class="form-control" placeholder="Nombre , Marca o Categoria"
                            value="{{ request('search') }}">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria_id" class="form-select">
                            <option value="">-- Todas --</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Marca</label>
                        <select name="marca_id" class="form-select">
                            <option value="">-- Todas --</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>

                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Limpiar</a>
                        </div>
                    </div>
                </form>

                <div class="mt-3 border-top pt-3 d-flex justify-content-end gap-2">
                    <span class="align-self-center text-muted me-auto">
                        Total: {{ $productos->total() }} registros
                    </span>
                    <a href="{{ route('productos.export-pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </a>
                    <a href="{{ route('productos.export-excel', request()->query()) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Exportar Excel
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->codigo }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio_compra, 2) }}</td>
                            <td>${{ number_format($producto->precio_venta, 2) }}</td>
                            <td>
                                {{ $producto->stock }} {{ $producto->unidad->nombre ?? '' }}
                                @if($producto->stock <= 5)
                                    <span class="badge bg-warning text-dark">Bajo Stock</span>
                                @endif
                            </td>

                            <!-- VISUALIZACIÓN DE ESTADOS (INTEGRIDAD HISTÓRICA) -->
                            <td>
                                {{ $producto->marca->nombre ?? 'N/A' }}
                                @if(optional($producto->marca)->trashed())
                                    <span class="badge bg-danger" title="Marca eliminada">(Eliminado)</span>
                                @endif
                            </td>

                            <td>
                                {{ $producto->categoria->nombre ?? 'N/A' }}
                                @if(optional($producto->categoria)->trashed())
                                    <span class="badge bg-danger" title="Categoría eliminada">(Eliminado)</span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                                        onsubmit="return confirm('¿Confirma eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-muted mb-0">No se encontraron productos con los filtros seleccionados.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- PAGINACIÓN -->
            <div class="mt-3 text-center">
                {{ $productos->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
