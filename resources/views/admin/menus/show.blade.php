@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $menu->nombre }}</h5>
            <p class="card-text">
                <strong>Label:</strong> {{ $menu->label ?? 'N/A' }}<br>
                <strong>Slug:</strong> {{ $menu->slug ?? 'N/A' }}<br>
                <strong>Menú Padre:</strong> {{ $menu->padre->nombre ?? 'N/A' }}<br>
                <strong>Fecha Inicio:</strong> {{ $menu->fecha_inicio ? $menu->fecha_inicio->format('d/m/Y H:i') : 'N/A' }}<br>
                <strong>Fecha Fin:</strong> {{ $menu->fecha_fin ? $menu->fecha_fin->format('d/m/Y H:i') : 'N/A' }}<br>
                <strong>Estado:</strong> {{ $menu->activo ? 'Activo' : 'Inactivo' }}
            </p>
            <a href="{{ route('menus.edit', $menu->id_menu) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        console.log('Dashboard loaded');
    </script>
@endpush