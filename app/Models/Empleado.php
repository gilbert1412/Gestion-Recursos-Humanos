<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
    protected $table='empleados';
    protected $fillable = [
        'numero_documento',
        'nombre_completo',
        'apellidos_completos',
        'email',
        'telefono',
        'fecha_ingreso',
        'estado',
    ];
    
    #[Scope]
    protected function activos(Builder $query):void{
        $query->where('estado','ACTIVADO');
    }

}
