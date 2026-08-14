@extends('Admin.dashboard.index')
@section('title', 'Empleado')
@section('nombreVista', 'Empleado')
@section('contenido')
    <div class="card border-0 shadow-lg rounded-4">

        <!-- Header -->
        <div class="card-header bg-primary text-white py-4 border-0 rounded-top-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1 fw-bold">

                        Mantenimiento de Empleados
                    </h2>
                    <small>Gestión y administración del personal</small>
                </div>

                <livewire:empleado.crud />
            </div>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <livewire:empleado.table />

        </div>

    </div>
@endsection
