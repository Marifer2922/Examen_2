@extends('layouts.admin')

@section('titulo', 'Editar Proveedor')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Editar Proveedor</h1>
    <small class="text-muted">Modificando: <strong>{{ $proveedor->empresa }}</strong> (RTN: {{ $proveedor->rtn }})</small>
</div>

<div class="card shadow-sm border-0 col-xl-10">
    <div class="card-header bg-warning text-dark py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Actualizar Información del Proveedor</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="rtn" class="form-label fw-bold">RTN <span class="text-danger">*</span></label>
                    <input type="text" id="rtn" name="rtn" value="{{ old('rtn', $proveedor->rtn) }}" maxlength="14" inputmode="numeric"
                           class="form-control @error('rtn') is-invalid @enderror">
                    @error('rtn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-3">
                    <label for="empresa" class="form-label fw-bold">Empresa (Razón Social) <span class="text-danger">*</span></label>
                    <input type="text" id="empresa" name="empresa" value="{{ old('empresa', $proveedor->empresa) }}"
                           class="form-control @error('empresa') is-invalid @enderror">
                    @error('empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="contacto" class="form-label fw-bold">Asesor Comercial <span class="text-danger">*</span></label>
                    <input type="text" id="contacto" name="contacto" value="{{ old('contacto', $proveedor->contacto) }}"
                           class="form-control @error('contacto') is-invalid @enderror">
                    @error('contacto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" maxlength="8" inputmode="numeric"
                           class="form-control @error('telefono') is-invalid @enderror">
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
                            <option value="{{ $categoria }}" {{ old('categoria', $proveedor->categoria) == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
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
                        <input type="number" step="0.01" id="limite_credito" name="limite_credito" value="{{ old('limite_credito', $proveedor->limite_credito) }}"
                               class="form-control @error('limite_credito') is-invalid @enderror">
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
                            <option value="{{ $dias }}" {{ old('dias_credito', $proveedor->dias_credito) == $dias ? 'selected' : '' }}>{{ $dias }} días</option>
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
                        <option value="Activo" {{ old('estado', $proveedor->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $proveedor->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fecha_registro" class="form-label fw-bold">Fecha de Registro <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_registro" name="fecha_registro"
                           value="{{ old('fecha_registro', $proveedor->fecha_registro->format('Y-m-d')) }}"
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
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-arrow-repeat me-1"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
