<?php

use App\Models\Empleado;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $numero_documento;
    public $nombre_completo;
    public $apellidos_completos;
    public $email;
    public $telefono;
    public $fecha_ingreso;
    public $id_empleado;
    public $estado;

    public function validarDatos()
    {
        $this->validate([
            'numero_documento' => 'required|string|max:15|unique:empleados,numero_documento,' . $this->id_empleado,
            'nombre_completo' => 'required|string|max:100',
            'apellidos_completos' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:empleados,email,' . $this->id_empleado,
            'telefono' => 'nullable|string|max:20',
            'fecha_ingreso' => 'required|date',
        ]);
    }
    public function registrarEmpleado()
    {
        $this->validarDatos();

        if (isset($this->id_empleado)) {
            $empleado = Empleado::findOrFail($this->id_empleado);
            $empleado->update([
                'numero_documento' => $this->numero_documento,
                'nombre_completo' => $this->nombre_completo,
                'apellidos_completos' => $this->apellidos_completos,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'fecha_ingreso' => $this->fecha_ingreso,
                'estado'=>$this->estado
            ]);
        } else {
            Empleado::create([
                'numero_documento' => $this->numero_documento,
                'nombre_completo' => $this->nombre_completo,
                'apellidos_completos' => $this->apellidos_completos,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'fecha_ingreso' => $this->fecha_ingreso,
            ]);
        }
        $this->limpiarCampos();
        $this->dispatch('actualizar-tabla');
    }
    #[On('abrir-modal-editar')]
    public function editar($id)
    {
        $data=Empleado::findOrFail($id);
        $this->id_empleado=$data->id;
        $this->numero_documento=$data->numero_documento;
        $this->nombre_completo=$data->nombre_completo;
        $this->apellidos_completos=$data->apellidos_completos;
        $this->email=$data->email;
        $this->telefono=$data->telefono;
        $this->fecha_ingreso=$data->fecha_ingreso;
        $this->estado=$data->estado;

    }
    #[On('eliminar-empleado')]
    public function eliminar($id){
        $data=Empleado::findOrFail($id);
        $data->update(['estado'=>'INACTIVO']);
        $this->dispatch('actualizar-tabla');
    }
    public function limpiarCampos()
    {
        $this->reset();
        $this->resetValidation();
    }
};
?>

<div>
    <button type="button" class="btn btn-light fw-semibold" data-bs-toggle="modal" data-bs-target="#modalEmpleado">

        <i class="bi bi-person-plus-fill me-2"></i>
        Nuevo Empleado
    </button>

    <!-- Modal Nuevo / Editar Empleado -->
    <div wire:ignore.self class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="modalEmpleadoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form wire:submit="registrarEmpleado" method="POST" class="needs-validation" novalidate>
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <!-- Header -->
                    <div class="modal-header bg-primary text-white border-0 rounded-top-4 px-4 py-3">
                        <div>
                            <h5 class="modal-title fw-bold mb-1" id="modalEmpleadoLabel">
                                <i class="bi bi-person-plus-fill me-2"></i>
                                Nuevo Empleado
                            </h5>

                            <small class="opacity-75">
                                Registre la información del empleado
                            </small>
                        </div>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Cerrar">
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-4">

                        <!-- Información personal -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">
                                    <i class="bi bi-person-vcard fs-5"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-0">
                                        Información personal
                                    </h6>

                                    <small class="text-muted">
                                        Datos principales del empleado
                                    </small>
                                </div>
                            </div>

                            <div class="row g-3">

                                <!-- DNI -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        DNI
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-card-text text-primary"></i>
                                        </span>

                                        <input type="text" class="form-control" placeholder="Ej. 70344825"
                                            maxlength="15" wire:model="numero_documento">
                                    </div>
                                    <span class="text-danger">
                                        @error('numero_documento')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- Nombres -->
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">
                                        Nombres
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person text-primary"></i>
                                        </span>

                                        <input type="text" class="form-control" placeholder="Ingrese los nombres"
                                            wire:model="nombre_completo">
                                    </div>
                                    <span class="text-danger">
                                        @error('nombre_completo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- Apellidos -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Apellidos
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person-lines-fill text-primary"></i>
                                        </span>

                                        <input type="text" class="form-control" placeholder="Ingrese los apellidos"
                                            wire:model="apellidos_completos">
                                    </div>
                                    <span class="text-danger">
                                        @error('apellidos_completos')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Teléfono
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-telephone text-primary"></i>
                                        </span>

                                        <input type="text" class="form-control" placeholder="Ej. 987654321"
                                            wire:model="telefono">
                                    </div>
                                    <span class="text-danger">
                                        @error('telefono')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>


                        <!-- Información laboral -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-2 me-2">
                                    <i class="bi bi-briefcase-fill fs-5"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-0">
                                        Información laboral
                                    </h6>

                                    <small class="text-muted">
                                        Datos relacionados con el vínculo laboral
                                    </small>
                                </div>
                            </div>

                            <div class="row g-3">

                                <!-- Email -->
                                <div class="col-md-7">
                                    <label class="form-label fw-semibold">
                                        Correo electrónico
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-envelope text-success"></i>
                                        </span>

                                        <input type="email" class="form-control" placeholder="empleado@correo.com"
                                            wire:model="email">
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- Fecha ingreso -->
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">
                                        Fecha de ingreso
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-calendar-event text-success"></i>
                                        </span>

                                        <input type="date" class="form-control" wire:model="fecha_ingreso">
                                    </div>
                                    <span class="text-danger">
                                        @error('fecha_ingreso')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <!-- Estado -->
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">
                                        Estado
                                    </label>

                                    <select class="form-select" wire:model="estado">
                                        <option value="">Seleccione un estado</option>
                                        <option value="ACTIVO">Activado</option>
                                        <option value="INACTIVO">Desactivado</option>
                                    </select>
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
                            Guardar empleado
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@section('js')
    <script>
        document.addEventListener('livewire:init', () => {
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEmpleado'))
            Livewire.on('actualizar-tabla', (event) => {
                modal.hide();
            });
             Livewire.on('abrir-modal-editar', (event) => {
                modal.show();
            });


        });
    </script>
@endsection
