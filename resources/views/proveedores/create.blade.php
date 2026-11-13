@extends('layouts.admin')

@section('titulo', 'Registrar Nuevo Proveedor')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Registrar Nuevo Proveedor</h1>
    <small class="text-muted">AGROVALLE Honduras - Formulario de Alta</small>
</div>

<div class="card shadow-sm border-0 col-xl-10">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-building-add me-2"></i>Ficha del Proveedor</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('proveedores.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="rtn" class="form-label fw-bold">RTN <span class="text-danger">*</span></label>
                    <input type="text" id="rtn" name="rtn" value="{{ old('rtn') }}" maxlength="14" inputmode="numeric"
                           class="form-control @error('rtn') is-invalid @enderror" placeholder="14 dígitos sin guiones">
                    @error('rtn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-3">
                    <label for="empresa" class="form-label fw-bold">Empresa (Razón Social) <span class="text-danger">*</span></label>
                    <input type="text" id="empresa" name="empresa" value="{{ old('empresa') }}"
                           class="form-control @error('empresa') is-invalid @enderror" placeholder="Ej: Agroquímicos del Norte S.A. de C.V.">
                    @error('empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="contacto" class="form-label fw-bold">Asesor Comercial <span class="text-danger">*</span></label>
                    <input type="text" id="contacto" name="contacto" value="{{ old('contacto') }}"
                           class="form-control @error('contacto') is-invalid @enderror" placeholder="Nombre del asesor comercial">
                    @error('contacto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="8" inputmode="numeric"
                           class="form-control @error('telefono') is-invalid @enderror" placeholder="Ej: 27721234">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">8 dígitos, iniciando con 2, 3, 8 o 9.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                    <select id="categoria" name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                        <option value="">-- Seleccione --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="limite_credito" class="form-label fw-bold">Límite de Crédito (L.) <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">L.</span>
                        <input type="number" step="0.01" id="limite_credito" name="limite_credito" value="{{ old('limite_credito') }}"
                               class="form-control @error('limite_credito') is-invalid @enderror" placeholder="0.00">
                        @error('limite_credito')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="dias_credito" class="form-label fw-bold">Días de Crédito <span class="text-danger">*</span></label>
                    <select id="dias_credito" name="dias_credito" class="form-select @error('dias_credito') is-invalid @enderror">
                        <option value="">-- Seleccione --</option>
                        @foreach ($diasCredito as $dias)
                            <option value="{{ $dias }}" {{ old('dias_credito') == $dias ? 'selected' : '' }}>{{ $dias }} días</option>
                        @endforeach
                    </select>
                    @error('dias_credito')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
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

                <div class="col-md-4 mb-3">
                    <label for="fecha_registro" class="form-label fw-bold">Fecha de Registro <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro', date('Y-m-d')) }}"
                           class="form-control @error('fecha_registro') is-invalid @enderror">
                    @error('fecha_registro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Guardar Proveedor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
