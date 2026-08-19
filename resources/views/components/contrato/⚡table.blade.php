<?php

use App\Models\Contrato;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public $listadoEmpleados=[];
    public $buscar;
    #[On('actualizar-tabla')]
    #[Computed()]
    public function contratos(){
        return Contrato::activos($this->buscar)->get();
    }
};
?>

<div>
    <!-- Buscador -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" wire:model.live="buscar" class="form-control border-start-0"
                    placeholder="Buscar empleado...">
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>Tipo de Contrato</th>
                    <th>Inicio de Contrato</th>
                    <th>Fin de Contrato</th>
                    <th>Salario</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($this->contratos() as $item)
                <tr>
                    <td class="fw-bold">{{ $loop->index }}</td>
                    <td>{{ $item->empleado->nombre_completo }} {{ $item->empleado->apellidos_completos }}</td>
                    <td>{{ $item->tipo_contrato }}</td>
                    <td>{{ $item->fecha_inicio }}</td>
                    <td>{{ $item->fecha_fin }}</td>
                    <td>{{ $item->salario_base }}</td>


                    <td class="text-center">

                        <div class="btn-group">

                            <button class="btn btn-warning btn-sm"
                                wire:click="$dispatch('abrir-modal-editar',{id: {{ $item->id }}})">

                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <button class="btn btn-danger btn-sm"
                                wire:click="$dispatch('eliminar-contrato',{id: {{ $item->id }}})"
                                wire:confirm="Esta seguro de que quiere eliminar al Contrato?">
                                <i class="bi bi-trash-fill"></i>
                            </button>


                        </div>

                    </td>
                </tr>
                @empty

                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="bi bi-search fs-1 text-secondary"></i>

                        <p class="fw-semibold text-secondary mt-3 mb-1">
                            No se encontraron registros
                        </p>

                        <small class="text-muted">
                            Intenta realizar otra búsqueda.
                        </small>
                    </td>
                </tr>
                @endforelse



            </tbody>

        </table>
    </div>
</div>