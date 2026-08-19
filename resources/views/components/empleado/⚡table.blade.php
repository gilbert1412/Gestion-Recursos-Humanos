<?php

use App\Models\Empleado;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $buscar;
    #[Computed]
    #[On('actualizar-tabla')]
    public function listadoEmpleados()
    {
        return Empleado::activos($this->buscar)->paginate(10);
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
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($this->listadoEmpleados as $empleado)
                <tr>
                    <td class="fw-bold">{{ $loop->index }}</td>
                    <td>{{ $empleado->numero_documento }}</td>
                    <td>{{ $empleado->nombre_completo }}</td>
                    <td>{{ $empleado->apellidos_completos }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->telefono }}</td>
                    <td>{{ $empleado->fecha_ingreso }}</td>

                    <td>
                        @if ($empleado->estado === 'ACTIVO')
                        <span class="badge bg-primary px-3 py-2">
                            {{ $empleado->estado }}
                        </span>
                        @else
                        <span class="badge bg-danger px-3 py-2">
                            {{ $empleado->estado }}
                        </span>
                        @endif


                    </td>

                    <td class="text-center">

                        <div class="btn-group">

                            <button class="btn btn-warning btn-sm"
                                wire:click="$dispatch('abrir-modal-editar',{id:{{ $empleado->id }}})">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <button class="btn btn-danger btn-sm"
                                wire:click="$dispatch('eliminar-empleado',{id:{{ $empleado->id }}})"
                                wire:confirm="Esta seguro de que quiere eliminar al empleado?">
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