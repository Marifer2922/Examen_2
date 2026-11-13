@extends('layouts.admin')

@section('titulo', 'Proveedores')

@section('contenido')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-0">Red de Fabricantes y Proveedores Agrícolas</h1>
        <small class="text-muted">AGROVALLE Honduras - Gestión de Proveedores</small>
    </div>
    <a href="{{ route('proveedores.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Nuevo Proveedor
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-truck me-2"></i>Listado General de Proveedores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>RTN</th>
                        <th>Empresa</th>
                        <th>Asesor Comercial</th>
                        <th>Teléfono</th>
                        <th>Categoría</th>
                        <th class="text-end">Límite de Crédito</th>
                        <th class="text-center">Plazo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                    <tr>
                        <td class="text-nowrap">{{ $proveedor->rtn }}</td>
                        <td class="fw-bold">{{ $proveedor->empresa }}</td>
                        <td>{{ $proveedor->contacto }}</td>
                        <td class="text-nowrap">{{ substr($proveedor->telefono, 0, 4) }}-{{ substr($proveedor->telefono, 4) }}</td>
                        <td>{{ $proveedor->categoria }}</td>
                        <td class="text-end text-nowrap">L. {{ number_format($proveedor->limite_credito, 2) }}</td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">{{ $proveedor->dias_credito }} días</span>
                        </td>
                        <td class="text-center">
                            @if ($proveedor->estado == 'Activo')
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge" style="background-color: #6c757d;">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">{{ $proveedor->fecha_registro->format('d/m/Y') }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning btn-sm me-1" title="Editar proveedor">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Está seguro de eliminar al proveedor {{ $proveedor->empresa }}? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar proveedor">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="bi bi-truck fs-1 d-block mb-2"></i>
                            No hay proveedores registrados. Haga clic en <strong>Nuevo Proveedor</strong> para comenzar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $proveedores->links() }}
        </div>
    </div>
</div>
@endsection
