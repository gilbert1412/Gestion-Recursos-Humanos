<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table='asistencias';
    protected $fillable = [
        'empleado_id',
        'dia',
        'hora_entrada',
        'minuto_retraso',
        'stado',
    ];
}