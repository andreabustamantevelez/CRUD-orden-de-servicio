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

    // ============================================================
    // R: LISTAR  ->  responsable: Nikol (rama feature/listado)
    // ============================================================
    public function index()
    {
        // TODO (Nikol): consultar las órdenes con cliente y usuario
        // y enviarlas a la vista ordenes.index
        return view('ordenes.index');
    }


    // ============================================================
    // C: CREAR  ->  responsable: Juan (rama feature/crear)
    // ============================================================
    public function create()
    {
        // TODO (Juan): enviar clientes, usuarios y prioridades a la vista
        return view('ordenes.create');
    }

    public function store(Request $request)
    {
        // TODO (Juan): validar y guardar la orden
        return redirect()->route('ordenes.index');
    }


    // ============================================================
    // U: ACTUALIZAR  ->  responsable: Vale (rama feature/editar)
    // ============================================================
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
        // Solo se aceptan los 4 campos editables; los demás no se tocan
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
