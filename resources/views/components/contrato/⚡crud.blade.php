<?php

use App\Models\Contrato;
use App\Models\Empleado;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public $contarto_id, $empleado_id, $tipo_contrato, $fecha_inicio, $fecha_fin, $salario_base, $activo;

    #[Computed()]
    public function empleados()
    {
        return Empleado::activos()->get();
    }

    public function validarCampos()
    {
        $this->validate([
            'empleado_id' => 'required',
            'tipo_contrato' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'salario_base' => 'required|numeric|decimal:2'
        ]);
    }
    public function registrarContrato()
    {

        $this->validarCampos();

        // Si existe contrato_id, estamos editando
        if ($this->contarto_id) {

            $contrato = Contrato::findOrFail($this->contarto_id);

            // Verificar si el empleado seleccionado
            // ya tiene OTRO contrato vigente
            $contratoVigente = Contrato::where('empleado_id', $this->empleado_id)
                ->where('id', '!=', $contrato->id)
                ->whereDate('fecha_fin', '>=', today())
                ->exists();

            if ($contratoVigente) {
                $this->addError(
                    'empleado_id',
                    'El empleado seleccionado ya tiene otro contrato vigente.'
                );
               
                return;
            }

            // Actualizar contrato
            $contrato->update([
                'empleado_id'   => $this->empleado_id,
                'tipo_contrato' => $this->tipo_contrato,
                'fecha_inicio'  => $this->fecha_inicio,
                'fecha_fin'     => $this->fecha_fin,
                'salario_base'  => $this->salario_base,
            ]);
        } else {

            // Verificar si el empleado ya tiene un contrato vigente
            $contratoVigente = Contrato::where('empleado_id', $this->empleado_id)
                ->whereDate('fecha_fin', '>=', today())
                ->exists();

            if ($contratoVigente) {
                $this->addError(
                    'empleado_id',
                    'El empleado ya tiene un contrato vigente hasta la fecha de finalización.'
                );
              
                return;
            }

            // Crear nuevo contrato
            Contrato::create([
                'empleado_id'   => $this->empleado_id,
                'tipo_contrato' => $this->tipo_contrato,
                'fecha_inicio'  => $this->fecha_inicio,
                'fecha_fin'     => $this->fecha_fin,
                'salario_base'  => $this->salario_base,
            ]);
        }



        $this->limpiarCampos();
        $this->dispatch('actualizar-tabla');
    }
    #[On('abrir-modal-editar')]
    public function editar($id)
    {

        $data = Contrato::findOrFail($id);
        $this->contarto_id = $data->id;
        $this->empleado_id = $data->empleado_id;
        $this->tipo_contrato = $data->tipo_contrato;
        $this->fecha_inicio = $data->fecha_inicio;
        $this->fecha_fin = $data->fecha_fin;
        $this->salario_base = $data->salario_base;
    }
    #[On('limpiar-modal')]
    public function limpiarCampos()
    {
        $this->reset();
        $this->resetValidation();
    }
    #[On('eliminar-contrato')]
    public function eliminar($id)
    {
        $data = Contrato::findOrFail($id);

        $data->update([
            'activo' => 0,
        ]);
        $this->dispatch('actualizar-tabla');
    }
}
?>

<div>
    <button type="button" class="btn btn-light fw-semibold" data-bs-toggle="modal" data-bs-target="#modalContrato">

        <i class="bi bi-person-plus-fill me-2"></i>
        Nuevo Contrato
    </button>

    <div wire:ignore.self class="modal fade" id="modalContrato" tabindex="-1" aria-labelledby="modalContratoLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <form wire:submit="registrarContrato" method="POST">

                <div class="modal-content border-0 shadow-lg rounded-4">

                    <!-- Header -->
                    <div class="modal-header bg-primary text-white border-0 rounded-top-4 px-4 py-3">

                        <div>
                            <h5 class="modal-title fw-bold mb-1" id="modalContratoLabel">
                                <i class="bi bi-file-earmark-text-fill me-2"></i>
                                Nuevo Contrato
                            </h5>

                            <small class="opacity-75">
                                Registre la información contractual del empleado
                            </small>
                        </div>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <!-- Body -->
                    <div class="modal-body p-4">

                        <!-- Información del empleado -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">
                                    <i class="bi bi-person-badge-fill fs-5"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-0">
                                        Empleado
                                    </h6>

                                    <small class="text-muted">
                                        Seleccione el trabajador asignado al contrato
                                    </small>
                                </div>

                            </div>

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <label class="form-label fw-semibold">
                                        Empleado
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person-fill text-primary"></i>
                                        </span>

                                        <select class="form-select" wire:model="empleado_id">
                                            <option value="">Seleccione un empleado</option>

                                            @foreach ($this->empleados as $empleado)
                                            <option value="{{ $empleado->id }}">
                                                {{ $empleado->nombre_completo }} {{$empleado->apellidos_completos}}
                                            </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    @error('empleado_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <!-- Información contractual -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-2 me-2">
                                    <i class="bi bi-briefcase-fill fs-5"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-0">
                                        Datos del contrato
                                    </h6>

                                    <small class="text-muted">
                                        Información laboral y económica
                                    </small>
                                </div>

                            </div>

                            <div class="row g-3">

                                <!-- Tipo contrato -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Tipo de contrato
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-file-earmark-text text-success"></i>
                                        </span>

                                        <select class="form-select" wire:model="tipo_contrato">
                                            <option value="">Seleccione</option>
                                            <option value="Permantente">Permanente</option>
                                            <option value="Temporal">Temporal</option>
                                            <option value="Practicante">Practicante</option>
                                        </select>

                                    </div>

                                    @error('tipo_contrato')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <!-- Estado -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Estado
                                    </label>

                                    <select class="form-select" wire:model="activo">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>

                                </div>

                                <!-- Fecha inicio -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Fecha de inicio
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-calendar-event text-success"></i>
                                        </span>

                                        <input type="date" class="form-control" wire:model="fecha_inicio">

                                    </div>

                                    @error('fecha_inicio')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <!-- Fecha fin -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Fecha de finalización
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-calendar-check text-success"></i>
                                        </span>

                                        <input type="date" class="form-control" wire:model="fecha_fin">

                                    </div>

                                    @error('fecha_fin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <!-- Salario -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Salario base
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            S/
                                        </span>

                                        <input type="number" step="0.01" min="0" class="form-control" placeholder="0.00"
                                            wire:model="salario_base">

                                    </div>

                                    @error('salario_base')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer bg-light border-0 px-4 py-3 rounded-bottom-4">

                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">

                            <i class="bi bi-x-circle me-1"></i>
                            Cancelar

                        </button>

                        <button type="submit" class="btn btn-primary px-4 shadow-sm">

                            <i class="bi bi-check-circle me-1"></i>
                            Guardar contrato

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
</div>
@section('js')
<script type="module">
var modalContrato = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalContrato'))
var modal = document.getElementById('modalContrato')
Livewire.on('actualizar-tabla', (event) => {
    modalContrato.hide();
});
Livewire.on('abrir-modal-editar', (event) => {
    modalContrato.show();
});

modal.addEventListener('hidden.bs.modal', function(event) {
    Livewire.dispatch('limpiar-modal')
})
</script>
@endsection