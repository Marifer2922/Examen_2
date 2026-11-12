@extends('layouts.admin')

@section('titulo', 'Catálogo de Insumos')

@section('contenido')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-0">Catálogo de Insumos Agropecuarios</h1>
        <small class="text-muted">AGROVALLE Honduras - Control de Inventario</small>
    </div>
    <a href="{{ route('insumos.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Nuevo Insumo
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-box-seam me-2"></i>Listado General de Insumos</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('insumos.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-6 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="buscar" value="{{ $buscar }}" class="form-control"
                           placeholder="Buscar por nombre o código SKU" aria-label="Buscar por nombre o código SKU">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Buscar</button>
                @if ($buscar)
                    <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Foto</th>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Fabricante</th>
                        <th>Lote</th>
                        <th class="text-end">Precio</th>
                        <th class="text-end">Costo</th>
                        <th class="text-center">Existencias</th>
                        <th class="text-center">Vencimiento</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insumos as $insumo)
                    <tr>
                        <td class="text-center">
                            @if ($insumo->imagen)
                                <img src="{{ asset($insumo->imagen) }}" alt="Foto de {{ $insumo->nombre }}"
                                     class="rounded border" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span class="d-inline-flex align-items-center justify-content-center rounded border bg-light text-secondary"
                                      style="width: 60px; height: 60px;" role="img" aria-label="Sin imagen">
                                    <i class="bi bi-image fs-4"></i>
                                </span>
                            @endif
                        </td>
                        <td class="fw-bold text-nowrap">{{ $insumo->codigo }}</td>
                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->categoria }}</td>
                        <td>{{ $insumo->fabricante }}</td>
                        <td class="text-nowrap">{{ $insumo->numero_lote }}</td>
                        <td class="text-end text-nowrap">L. {{ number_format($insumo->precio, 2) }}</td>
                        <td class="text-end text-nowrap">L. {{ number_format($insumo->costo, 2) }}</td>
                        <td class="text-center">
                            @if ($insumo->inventario > 20)
                                <span class="badge bg-success">{{ $insumo->inventario }} - Óptimo</span>
                            @elseif ($insumo->inventario >= 10)
                                <span class="badge bg-warning text-dark">{{ $insumo->inventario }} - Moderado</span>
                            @else
                                <span class="badge bg-danger">{{ $insumo->inventario }} - ¡Desabastecimiento!</span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">{{ $insumo->fecha_vencimiento->format('d/m/Y') }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-warning btn-sm me-1" title="Editar insumo">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('insumos.destroy', $insumo) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Está seguro de eliminar el insumo {{ $insumo->codigo }}? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar insumo">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-5">
                            <i class="bi bi-box fs-1 d-block mb-2"></i>
                            @if ($buscar)
                                No se encontraron insumos con "<strong>{{ $buscar }}</strong>".
                            @else
                                No hay insumos registrados. Haga clic en <strong>Nuevo Insumo</strong> para comenzar.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $insumos->links() }}
        </div>
    </div>
</div>
@endsection
