@extends('layouts.admin')

@section('titulo', 'Registrar Nuevo Insumo')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Registrar Nuevo Insumo</h1>
    <small class="text-muted">AGROVALLE Honduras - Formulario de Alta</small>
</div>

<div class="card shadow-sm border-0 col-xl-10">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-file-earmark-plus me-2"></i>Ficha del Insumo</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('insumos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="codigo" class="form-label fw-bold">Código SKU <span class="text-danger">*</span></label>
                    <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}"
                           class="form-control @error('codigo') is-invalid @enderror" placeholder="Ej: FER-002">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Insumo <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                           class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej: Fertilizante Urea 46% (saco 45 kg)">
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
                            <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fabricante" class="form-label fw-bold">Fabricante <span class="text-danger">*</span></label>
                    <input type="text" id="fabricante" name="fabricante" value="{{ old('fabricante') }}"
                           class="form-control @error('fabricante') is-invalid @enderror" placeholder="Ej: Yara Honduras">
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
                        <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio') }}"
                               class="form-control @error('precio') is-invalid @enderror" placeholder="0.00">
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="costo" class="form-label fw-bold">Costo (L.) <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">L.</span>
                        <input type="number" step="0.01" id="costo" name="costo" value="{{ old('costo') }}"
                               class="form-control @error('costo') is-invalid @enderror" placeholder="0.00">
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="inventario" class="form-label fw-bold">Inventario (unidades) <span class="text-danger">*</span></label>
                    <input type="number" id="inventario" name="inventario" value="{{ old('inventario') }}"
                           class="form-control @error('inventario') is-invalid @enderror" placeholder="0">
                    @error('inventario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="numero_lote" class="form-label fw-bold">Número de Lote <span class="text-danger">*</span></label>
                    <input type="text" id="numero_lote" name="numero_lote" value="{{ old('numero_lote') }}"
                           class="form-control @error('numero_lote') is-invalid @enderror" placeholder="Ej: LT-2026-050">
                    @error('numero_lote')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fecha_vencimiento" class="form-label fw-bold">Fecha de Vencimiento <span class="text-danger">*</span></label>
                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}"
                           class="form-control @error('fecha_vencimiento') is-invalid @enderror">
                    @error('fecha_vencimiento')
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

            <div class="mb-3">
                <label for="imagen" class="form-label fw-bold">Fotografía del Empaque</label>
                <input type="file" id="imagen" name="imagen" accept=".jpg,.jpeg,.png,.webp"
                       class="form-control @error('imagen') is-invalid @enderror">
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Formatos permitidos: jpg, png o webp. Tamaño máximo: 5MB.</div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('insumos.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Guardar Insumo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
