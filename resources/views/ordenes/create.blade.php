@extends('layouts.app')

@section('titulo', 'Nueva orden')

@section('contenido')
<h2 class="mb-3">Nueva orden de servicio</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ordenes.store') }}" method="POST" class="card card-body">
    @csrf

    <div class="mb-3">
        <label class="form-label">Cliente</label>
        <select name="cliente_id" class="form-select" required>
            <option value="">Seleccione...</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}" @selected(old('cliente_id') == $cliente->id_cliente)>
                    {{ $cliente->id_cliente }} - {{ $cliente->nombre }} {{ $cliente->apellido }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <select name="usuario_id" class="form-select" required>
            <option value="">Seleccione...</option>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id_usuario }}" @selected(old('usuario_id') == $usuario->id_usuario)>
                    {{ $usuario->id_usuario }} - {{ $usuario->username }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Código de la orden</label>
        <input type="text" name="codigo_orden" class="form-control" maxlength="50"
               value="{{ old('codigo_orden') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo de servicio</label>
        <input type="text" name="tipo_servicio" class="form-control" maxlength="50"
               placeholder="Instalación, Reparación, Mantenimiento..."
               value="{{ old('tipo_servicio') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prioridad</label>
        <select name="prioridad" class="form-select" required>
            @foreach ($prioridades as $p)
                <option value="{{ $p }}" @selected(old('prioridad', 'Media') == $p)>{{ $p }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

@endsection
