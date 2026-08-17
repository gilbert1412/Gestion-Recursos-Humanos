<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
    protected function activos(Builder $query, ?string $buscar = null): void
    {
        $query->where('estado', 'ACTIVO');
        if (!empty($buscar)) {
            $query->where(function ($q) use ($buscar) {
                $q->where('numero_documento', 'like', "%{$buscar}%")
                ->orWhere('nombre_completo', 'like', "%{$buscar}%")
                ->orWhere('apellidos_completos', 'like', "%{$buscar}%")
                ->orWhereRaw(
                    "CONCAT(nombre_completo, ' ', apellidos_completos) LIKE ?",
                    ["%{$buscar}%"]
                )
                ->orWhere('fecha_ingreso', 'like', "%{$buscar}%")
                ->orWhere('estado', 'like', "%{$buscar}%");
            });
        }

        
    }
    public function contratos(): HasMany
    { 
        return $this->hasMany(Contrato::class);
    }
   
    

}