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
        $ordenes = OrdenServicio::with(['cliente', 'usuario'])
            ->orderByDesc('created_at')
            ->get();

        return view('ordenes.index', compact('ordenes'));
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
        // TODO (Vale): cargar cliente y usuario y enviar todo a la vista
        return view('ordenes.edit');
    }

    public function update(Request $request, OrdenServicio $orden)
    {
        // TODO (Vale): validar y actualizar solo los 4 campos editables
        return redirect()->route('ordenes.index');
    }
}
