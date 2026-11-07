<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    protected $table = 'orden_de_servicio';

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'codigo_orden',
        'descripcion',
        'tipo_servicio',
        'prioridad',
        'estado',
        'fecha_cierre_estimada',
    ];

    protected $casts = [
        'fecha_cierre_estimada' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
