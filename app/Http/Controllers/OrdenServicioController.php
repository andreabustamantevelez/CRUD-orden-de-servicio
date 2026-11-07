<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdenServicio;
use App\Models\Usuario;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    private array $prioridades = ['Baja', 'Media', 'Alta', 'Urgente'];
    private array $estados = ['Pendiente', 'En Proceso', 'Cerrada', 'Cancelada'];

    // R: LISTAR
    public function index()
    {
        $ordenes = OrdenServicio::with(['cliente', 'usuario'])
            ->orderByDesc('created_at')
            ->get();

        return view('ordenes.index', compact('ordenes'));
    }

    // C: CREAR
    public function create()
    {
        return view('ordenes.create', [
            'clientes' => Cliente::orderBy('nombre')->get(),
            'usuarios' => Usuario::orderBy('username')->get(),
            'prioridades' => $this->prioridades,
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'cliente_id' => 'required|exists:cliente,id_cliente',
            'usuario_id' => 'required|exists:usuario,id_usuario',
            'codigo_orden' => 'required|string|max:50|unique:orden_de_servicio,codigo_orden',
            'descripcion' => 'required|string',
            'tipo_servicio' => 'required|string|max:50',
            'prioridad' => 'required|in:' . implode(',', $this->prioridades),
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'exists' => 'El :attribute seleccionado no es válido.',
            'unique' => 'Ese código de orden ya existe.',
            'max' => 'El campo :attribute no puede superar :max caracteres.',
            'in' => 'La prioridad seleccionada no es válida.',
        ], [
            'cliente_id' => 'cliente',
            'usuario_id' => 'usuario',
            'codigo_orden' => 'código de la orden',
            'descripcion' => 'descripción',
            'tipo_servicio' => 'tipo de servicio',
            'prioridad' => 'prioridad',
        ]);

        OrdenServicio::create($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden creada correctamente.');
    }

    // U: ACTUALIZAR
    public function edit(OrdenServicio $orden)
    {
        $orden->load(['cliente', 'usuario']);

        return view('ordenes.edit', [
            'orden' => $orden,
            'prioridades' => $this->prioridades,
            'estados' => $this->estados,
        ]);
    }

    public function update(Request $request, OrdenServicio $orden)
    {
        $datos = $request->validate([
            'tipo_servicio' => 'required|string|max:50',
            'prioridad' => 'required|in:' . implode(',', $this->prioridades),
            'estado' => 'required|in:' . implode(',', $this->estados),
            'fecha_cierre_estimada' => 'nullable|date',
        ]);

        $orden->update($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden actualizada correctamente.');
    }
}
