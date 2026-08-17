<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
class Contrato extends Model
{
    protected $table='contratos';
    protected $fillable = [
        'empleado_id',
        'empleados',
        'tipo_contrato',
        'fecha_inicio',
        'fecha_fin',
        'salario_base'
    ];
    #[Scope]
    protected function activos(Builder $query, ?string $buscar){
        $query->where('activos',true);
    }
    public function empleado() :BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }
    
}