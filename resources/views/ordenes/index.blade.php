@extends('layouts.app')

@section('titulo', 'Listado de órdenes')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de órdenes</h2>
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary">Nueva orden</a>
</div>

@php
    $colorPrioridad = ['Baja' => 'secondary', 'Media' => 'info', 'Alta' => 'warning', 'Urgente' => 'danger'];
    $colorEstado = ['Pendiente' => 'secondary', 'En Proceso' => 'primary', 'Cerrada' => 'success', 'Cancelada' => 'dark'];
@endphp

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle bg-white">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Código orden</th>
                <th>Descripción</th>
                <th>Tipo servicio</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Cierre estimado</th>
                <th>Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ordenes as $orden)
                <tr>
                    <td>{{ $orden->cliente_id }} - {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</td>
                    <td>{{ $orden->usuario_id }} - {{ $orden->usuario->username }}</td>
                    <td>{{ $orden->codigo_orden }}</td>
                    <td>{{ $orden->descripcion }}</td>
                    <td>{{ $orden->tipo_servicio }}</td>
                    <td><span class="badge bg-{{ $colorPrioridad[$orden->prioridad] ?? 'secondary' }}">{{ $orden->prioridad }}</span></td>
                    <td><span class="badge bg-{{ $colorEstado[$orden->estado] ?? 'secondary' }}">{{ $orden->estado }}</span></td>
                    <td>{{ $orden->fecha_cierre_estimada?->format('d/m/Y') }}</td>
                    <td>{{ $orden->created_at?->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No hay órdenes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
