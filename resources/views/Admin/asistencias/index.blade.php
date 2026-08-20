@extends('Admin.dashboard.index')
@section('title', 'Asistencias')
@section('nombreVista', 'Asistencias')
@section('contenido')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">
            <i class="fas fa-user-check me-2"></i>
            Registro de Asistencia
        </h4>
    </div>

    <div class="card-body">

        <!-- Datos Generales -->
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Fecha
                </label>
                <input type="date" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Hora de Entrada
                </label>
                <input type="time" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Hora de Salida
                </label>
                <input type="time" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Buscar Empleado
                </label>
                <input type="text" class="form-control" placeholder="Nombre o DNI">
            </div>

        </div>

        <!-- Tabla -->
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="80">#</th>
                        <th>Empleado</th>
                        <th>DNI</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Estado</th>
                        <th>Observación</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>

                        <td>
                            <div class="fw-semibold">
                                Juan Pérez García
                            </div>
                            <small class="text-muted">
                                Área de Recursos Humanos
                            </small>
                        </td>

                        <td>74581236</td>

                        <td>
                            <input type="time" class="form-control form-control-sm">
                        </td>

                        <td>
                            <input type="time" class="form-control form-control-sm">
                        </td>

                        <td>
                            <select class="form-select form-select-sm">
                                <option value="Presente">
                                    ✅ Presente
                                </option>
                                <option value="Tardanza">
                                    ⏰ Tardanza
                                </option>
                                <option value="Aucente">
                                    ❌ Ausente
                                </option>
                                <option value="Justificado">
                                    📄 Justificado
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="text" class="form-control form-control-sm" placeholder="Observación">
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Resumen -->
        <div class="row mt-4">

            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h5 class="text-success">25</h5>
                        <small>Presentes</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <h5 class="text-warning">3</h5>
                        <small>Tardanzas</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h5 class="text-danger">1</h5>
                        <small>Ausentes</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h5 class="text-info">2</h5>
                        <small>Justificados</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-end gap-2 mt-4">

            <button class="btn btn-outline-secondary">
                <i class="fas fa-times me-1"></i>
                Cancelar
            </button>

            <button class="btn btn-primary">
                <i class="fas fa-save me-1"></i>
                Guardar Asistencia
            </button>

        </div>

    </div>
</div>
@endsection