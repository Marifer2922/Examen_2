@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Dashboard Gerencial</h1>
    <small class="text-muted">AGROVALLE Honduras - Sistema de Gestión Interna</small>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <p class="mb-0">
            Bienvenido(a), <strong>{{ Auth::user()->name }}</strong>.
            Use el menú lateral para navegar por los módulos del sistema.
        </p>
    </div>
</div>

<div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100 text-dark" style="background-color: #e8f5e9; border: 1px solid #c8e6c9;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-bold text-muted">Insumos en Catálogo</div>
                    <div class="display-6 fw-bold">{{ $totalInsumos }}</div>
                </div>
                <i class="bi bi-box-seam" style="font-size: 2.8rem; color: #2e7d32;"></i>
            </div>
            <div class="card-footer border-0" style="background-color: #c8e6c9;">
                <a href="{{ route('insumos.index') }}" class="text-dark small text-decoration-none">
                    Ver módulo <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100 text-dark" style="background-color: #e3f2fd; border: 1px solid #bbdefb;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-bold text-muted">Proveedores Activos</div>
                    <div class="display-6 fw-bold">{{ $proveedoresActivos }}</div>
                </div>
                <i class="bi bi-truck" style="font-size: 2.8rem; color: #1565c0;"></i>
            </div>
            <div class="card-footer border-0" style="background-color: #bbdefb;">
                <a href="{{ route('proveedores.index') }}" class="text-dark small text-decoration-none">
                    Ver módulo <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100 text-dark" style="background-color: #f3e5f5; border: 1px solid #e1bee7;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-bold text-muted">Empleados en Nómina</div>
                    <div class="display-6 fw-bold">{{ $totalEmpleados }}</div>
                </div>
                <i class="bi bi-people" style="font-size: 2.8rem; color: #6a1b9a;"></i>
            </div>
            <div class="card-footer border-0" style="background-color: #e1bee7;">
                <a href="{{ route('empleados.index') }}" class="text-dark small text-decoration-none">
                    Ver módulo <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100 text-dark" style="background-color: #fff8e1; border: 1px solid #ffecb3;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase fw-bold text-muted">Valor del Inventario Agrícola</div>
                    <div class="fs-3 fw-bold text-nowrap">L. {{ number_format($valorInventario, 2) }}</div>
                </div>
                <i class="bi bi-cash-stack" style="font-size: 2.8rem; color: #f9a825;"></i>
            </div>
            <div class="card-footer border-0" style="background-color: #ffecb3;">
                <a href="{{ route('insumos.index') }}" class="text-dark small text-decoration-none">
                    Ver inventario <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
