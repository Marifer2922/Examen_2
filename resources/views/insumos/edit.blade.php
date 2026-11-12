@extends('layouts.admin')

@section('titulo', 'Editar Insumo')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Editar Insumo</h1>
    <small class="text-muted">Modificando: <strong>{{ $insumo->nombre }}</strong> (SKU: {{ $insumo->codigo }})</small>
</div>

<div class="card shadow-sm border-0 col-xl-10">
    <div class="card-header bg-warning text-dark py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Actualizar Información del Insumo</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('insumos.update', $insumo) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="codigo" class="form-label fw-bold">Código SKU <span class="text-danger">*</span></label>
                    <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $insumo->codigo) }}"
                           class="form-control @error('codigo') is-invalid @enderror">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Insumo <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $insumo->nombre) }}"
                           class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                    <select id="categoria" name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                        <option value="">-- Seleccione una categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria }}" {{ old('categoria', $insumo->categoria) == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fabricante" class="form-label fw-bold">Fabricante <span class="text-danger">*</span></label>
                    <input type="text" id="fabricante" name="fabricante" value="{{ old('fabricante', $insumo->fabricante) }}"
                           class="form-control @error('fabricante') is-invalid @enderror">
                    @error('fabricante')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label fw-bold">Precio (L.) <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">L.</span>
                        <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $insumo->precio) }}"
                               class="form-control @error('precio') is-invalid @enderror">
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="costo" class="form-label fw-bold">Costo (L.) <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">L.</span>
                        <input type="number" step="0.01" id="costo" name="costo" value="{{ old('costo', $insumo->costo) }}"
                               class="form-control @error('costo') is-invalid @enderror">
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="inventario" class="form-label fw-bold">Inventario (unidades) <span class="text-danger">*</span></label>
                    <input type="number" id="inventario" name="inventario" value="{{ old('inventario', $insumo->inventario) }}"
                           class="form-control @error('inventario') is-invalid @enderror">
                    @error('inventario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="numero_lote" class="form-label fw-bold">Número de Lote <span class="text-danger">*</span></label>
                    <input type="text" id="numero_lote" name="numero_lote" value="{{ old('numero_lote', $insumo->numero_lote) }}"
                           class="form-control @error('numero_lote') is-invalid @enderror">
                    @error('numero_lote')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fecha_vencimiento" class="form-label fw-bold">Fecha de Vencimiento <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento"
                           value="{{ old('fecha_vencimiento', $insumo->fecha_vencimiento->format('Y-m-d')) }}"
                           class="form-control @error('fecha_vencimiento') is-invalid @enderror">
                    @error('fecha_vencimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fecha_registro" class="form-label fw-bold">Fecha de Registro <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_registro" name="fecha_registro"
                           value="{{ old('fecha_registro', $insumo->fecha_registro->format('Y-m-d')) }}"
                           class="form-control @error('fecha_registro') is-invalid @enderror">
                    @error('fecha_registro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-3 mb-3 text-center">
                    @if ($insumo->imagen)
                        <img src="{{ asset($insumo->imagen) }}" alt="Foto actual de {{ $insumo->nombre }}"
                             class="img-thumbnail" style="max-height: 140px;">
                        <div class="form-text">Foto actual</div>
                    @else
                        <span class="d-inline-flex align-items-center justify-content-center rounded border bg-light text-secondary"
                              style="width: 120px; height: 120px;" role="img" aria-label="Sin imagen">
                            <i class="bi bi-image fs-1"></i>
                        </span>
                        <div class="form-text">Sin foto</div>
                    @endif
                </div>
                <div class="col-md-9 mb-3">
                    <label for="imagen" class="form-label fw-bold">Cambiar Fotografía del Empaque</label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg,.jpeg,.png,.webp"
                           class="form-control @error('imagen') is-invalid @enderror">
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Deje este campo vacío para conservar la foto actual. Formatos: jpg, png o webp. Máximo 5MB.</div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('insumos.index') }}" class="btn btn-secondary">
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
