<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <button type="button" class="btn btn-light fw-semibold" data-bs-toggle="modal" data-bs-target="#modalEmpleado">

        <i class="bi bi-person-plus-fill me-2"></i>
        Nuevo Empleado
    </button>

    <!-- Modal Nuevo / Editar Empleado -->
    <div class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="modalEmpleadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                        maxlength="8">
                                </div>
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

                                    <input type="text" class="form-control" placeholder="Ingrese los nombres">
                                </div>
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

                                    <input type="text" class="form-control" placeholder="Ingrese los apellidos">
                                </div>
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

                                    <input type="text" class="form-control" placeholder="Ej. 987654321">
                                </div>
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

                                    <input type="email" class="form-control" placeholder="empleado@correo.com">
                                </div>
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

                                    <input type="date" class="form-control">
                                </div>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">
                                    Estado
                                </label>

                                <select class="form-select">
                                    <option value="">Seleccione un estado</option>
                                    <option value="ACTIVADO">Activado</option>
                                    <option value="DESACTIVADO">Desactivado</option>
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
        </div>
    </div>
</div>
