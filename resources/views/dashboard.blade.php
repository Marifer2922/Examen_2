@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')
<div class="mb-3">
    <h1 class="h3 mb-0">Dashboard Gerencial</h1>
    <small class="text-muted">AGROVALLE Honduras - Sistema de Gestión Interna</small>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <p class="mb-0">
            Bienvenido(a), <strong>{{ Auth::user()->name }}</strong>.
            Use el menú lateral para navegar por los módulos del sistema.
        </p>
    </div>
</div>
@endsection
