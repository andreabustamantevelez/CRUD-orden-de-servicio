@extends('layouts.app')

@section('titulo', 'Listado de órdenes')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de órdenes</h2>
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary">Nueva orden</a>
</div>

{{-- TODO (Nikol): reemplazar este aviso por la tabla con el listado --}}
<div class="alert alert-info">Listado pendiente de implementar.</div>
@endsection
