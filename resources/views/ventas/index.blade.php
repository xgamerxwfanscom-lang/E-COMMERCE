@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Lista de ventas</h2>
                <a href="{{ route('ventas.create') }}" class="btn btn-warning">Crear venta</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->producto->nombre ?? 'Sin producto' }}</td>
                                <td>{{ $venta->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $venta->vendedor->nombre ?? 'Sin vendedor' }}</td>
                                <td>${{ number_format($venta->total, 2) }}</td>
                                <td>{{ $venta->fecha }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay ventas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection