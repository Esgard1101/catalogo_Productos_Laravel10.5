<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Productos</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #444; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Productos</h2>
        <div class="info">
            <strong>Fecha de emisión:</strong> {{ now()->format('d/m/Y H:i:s') }}<br>
            @if(count($filtros) > 0)
                <strong>Filtros aplicados:</strong>
                @if(isset($filtros['search'])) Búsqueda: "{{ $filtros['search'] }}" @endif
                @if(isset($filtros['categoria'])) Categoría: {{ $filtros['categoria'] }} @endif
                @if(isset($filtros['marca'])) Marca: {{ $filtros['marca'] }} @endif
            @else
                <strong>Filtros:</strong> Ninguno (Listado completo)
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Unidad</th>
                <th class="text-right">Precio Venta</th>
                <th class="text-center">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre ?? 'N/A' }}</td>
                <td>{{ $producto->marca->nombre ?? 'N/A' }}</td>
                <td>{{ $producto->unidad->nombre ?? 'N/A' }}</td>
                <td class="text-right">{{ number_format($producto->precio_venta, 2) }}</td>
                <td class="text-center">{{ $producto->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Ordenado alfabéticamente por nombre. Catálogo de Productos v2.
    </div>
</body>
</html>
