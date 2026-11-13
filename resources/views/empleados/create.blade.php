@extends('layouts.admin')

@section('titulo', 'Registrar Nuevo Empleado')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Registrar Nuevo Empleado</h1>
    <small class="text-muted">AGROVALLE Honduras - Alta en Nómina</small>
</div>

<div class="card shadow-sm border-0 col-xl-10">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-person-vcard me-2"></i>Ficha del Colaborador</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="identidad" class="form-label fw-bold">DNI <span class="text-danger">*</span></label>
                    <input type="text" id="identidad" name="identidad" value="{{ old('identidad') }}" maxlength="13" inputmode="numeric"
                           class="form-control @error('identidad') is-invalid @enderror" placeholder="Ej: 0801199012345">
                    @error('identidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">13 dígitos, sin guiones.</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                           class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="apellido" class="form-label fw-bold">Apellido <span class="text-danger">*</span></label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}"
                           class="form-control @error('apellido') is-invalid @enderror">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label fw-bold">Correo <span class="text-danger">*</span></label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                           class="form-control @error('correo') is-invalid @enderror" placeholder="Ej: nombre.apellido@agrovalle.hn">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cargo" class="form-label fw-bold">Cargo <span class="text-danger">*</span></label>
                    <select id="cargo" name="cargo" class="form-select @error('cargo') is-invalid @enderror">
                        <option value="">-- Seleccione un cargo --</option>
                        @foreach ($cargos as $cargo)
                            <option value="{{ $cargo }}" {{ old('cargo') == $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                        @endforeach
                    </select>
                    @error('cargo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="salario" class="form-label fw-bold">Salario Mensual (L.) <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">L.</span>
                        <input type="number" step="0.01" id="salario" name="salario" value="{{ old('salario') }}"
                               class="form-control @error('salario') is-invalid @enderror" placeholder="0.00">
                        @error('salario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fecha_ingreso" class="form-label fw-bold">Fecha de Ingreso <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" max="{{ date('Y-m-d') }}"
                           class="form-control @error('fecha_ingreso') is-invalid @enderror">
                    @error('fecha_ingreso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="estado" class="form-label fw-bold">Estado <span class="text-danger">*</span></label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option value="Activo" {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Guardar Empleado
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
