@extends('layouts.admin')

@section('titulo', 'Empleados')

@section('contenido')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h1 class="h3 mb-0">Recursos Humanos y Personal Técnico</h1>
        <small class="text-muted">AGROVALLE Honduras - Nómina de Personal</small>
    </div>
    <a href="{{ route('empleados.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-person-plus me-1"></i> Nuevo Empleado
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-success text-white py-3">
        <h6 class="m-0 fw-bold"><i class="bi bi-people me-2"></i>Listado del Personal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>DNI</th>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-end">Salario Mensual</th>
                        <th class="text-center">Fecha de Ingreso</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                    <tr>
                        <td class="text-nowrap">{{ substr($empleado->identidad, 0, 4) }}-{{ substr($empleado->identidad, 4, 4) }}-{{ substr($empleado->identidad, 8) }}</td>
                        <td class="fw-bold">{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td>{{ $empleado->correo }}</td>
                        <td class="text-center">
                            @if ($empleado->cargo == 'Ingeniero Agrónomo')
                                <span class="badge" style="background-color: #198754;"><i class="bi bi-flower1 me-1"></i>{{ $empleado->cargo }}</span>
                            @elseif ($empleado->cargo == 'Asesor Técnico de Campo')
                                <span class="badge" style="background-color: #0d6efd;"><i class="bi bi-clipboard-check me-1"></i>{{ $empleado->cargo }}</span>
                            @elseif ($empleado->cargo == 'Jefe de Bodega Central')
                                <span class="badge text-dark" style="background-color: #ffc107;"><i class="bi bi-box-seam me-1"></i>{{ $empleado->cargo }}</span>
                            @elseif ($empleado->cargo == 'Operador de Maquinaria')
                                <span class="badge" style="background-color: #8b5a2b;"><i class="bi bi-gear me-1"></i>{{ $empleado->cargo }}</span>
                            @else
                                <span class="badge" style="background-color: #6f42c1;"><i class="bi bi-cash-coin me-1"></i>{{ $empleado->cargo }}</span>
                            @endif
                        </td>
                        <td class="text-end text-nowrap">L. {{ number_format($empleado->salario, 2) }}</td>
                        <td class="text-center text-nowrap">{{ $empleado->fecha_ingreso->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if ($empleado->estado == 'Activo')
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge" style="background-color: #6c757d;">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm me-1" title="Editar empleado">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Está seguro de eliminar a {{ $empleado->nombre }} {{ $empleado->apellido }} de la nómina? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar empleado">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                            No hay empleados registrados. Haga clic en <strong>Nuevo Empleado</strong> para comenzar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $empleados->links() }}
        </div>
    </div>
</div>
@endsection
