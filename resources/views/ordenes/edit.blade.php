@extends('layouts.app')

@section('titulo', 'Editar orden')

@section('contenido')
<h2 class="mb-3">Editar orden {{ $orden->codigo_orden }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ordenes.update', $orden) }}" method="POST" class="card card-body">
    @csrf
    @method('PUT')

    {{-- Campos solo de lectura --}}
    <div class="mb-3">
        <label class="form-label">Cliente</label>
        <input type="text" class="form-control" disabled
               value="{{ $orden->cliente_id }} - {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" class="form-control" disabled
               value="{{ $orden->usuario_id }} - {{ $orden->usuario->username }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Código de la orden</label>
        <input type="text" class="form-control" disabled value="{{ $orden->codigo_orden }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" rows="3" disabled>{{ $orden->descripcion }}</textarea>
    </div>

    {{-- Campos editables --}}
    <div class="mb-3">
        <label class="form-label">Tipo de servicio</label>
        <input type="text" name="tipo_servicio" class="form-control" maxlength="50"
               value="{{ old('tipo_servicio', $orden->tipo_servicio) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prioridad</label>
        <select name="prioridad" class="form-select" required>
            @foreach ($prioridades as $p)
                <option value="{{ $p }}" @selected(old('prioridad', $orden->prioridad) == $p)>{{ $p }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            @foreach ($estados as $e)
                <option value="{{ $e }}" @selected(old('estado', $orden->estado) == $e)>{{ $e }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha de cierre estimada</label>
        <input type="date" name="fecha_cierre_estimada" class="form-control"
               value="{{ old('fecha_cierre_estimada', $orden->fecha_cierre_estimada?->format('Y-m-d')) }}">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection
