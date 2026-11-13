<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'rtn',
        'empresa',
        'contacto',
        'telefono',
        'limite_credito',
        'categoria',
        'dias_credito',
        'estado',
        'fecha_registro',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
    ];
}
