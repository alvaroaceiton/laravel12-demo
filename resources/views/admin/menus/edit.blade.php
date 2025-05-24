@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')
<h1>Editar Menú</h1>

<form action="{{ route('menus.update', $menu->id_menu) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $menu->nombre }}" required>
    </div>

    <div class="form-group">
        <label for="label">Label</label>
        <input type="text" class="form-control" id="label" name="label" value="{{ $menu->label }}">
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $menu->slug }}" disabled>
    </div>

    <div class="form-group mb-3">
        <label for="id_menu_padre">Menú Padre</label>
        @if($esNivel3)
            <input type="text" class="form-control" value="{{ $menu->padre->padre->nombre }} → {{ $menu->padre->nombre }}" readonly>
            <small class="text-muted">No se puede cambiar el padre de un menú de nivel 3</small>
            <input type="hidden" name="id_menu_padre" value="{{ $menu->id_menu_padre }}">
        @else
            <select name="id_menu_padre" id="id_menu_padre" class="form-control">
                <option value="">-- Menú principal --</option>
                @foreach($menusDisponibles as $id => $nombre)
                    <option value="{{ $id }}" {{ $menu->id_menu_padre == $id ? 'selected' : '' }}>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
               value="{{ $menu->fecha_inicio ? date('Y-m-d\TH:i', strtotime($menu->fecha_inicio)) : '' }}">
    </div>

    <div class="form-group">
        <label for="fecha_fin">Fecha Fin</label>
        <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin"
               value="{{ $menu->fecha_fin ? date('Y-m-d\TH:i', strtotime($menu->fecha_fin)) : '' }}">
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ $menu->activo ? 'checked' : '' }}>
        <label class="form-check-label" for="activo">Activo</label>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@stop

@push('scripts')
    <script>
        console.log('Dashboard loaded');
    </script>
@endpush
<script>
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        const nombreInput = document.getElementById('nombre');
        const slugInput = document.getElementById('slug');

        if (nombreInput && slugInput) {
            nombreInput.addEventListener('input', function() {
                slugInput.value = generarSlug(this.value);
            });

            // Generar slug inicial si hay valor en nombre
            if (nombreInput.value) {
                slugInput.value = generarSlug(nombreInput.value);
            }
        }

        function generarSlug(texto) {
            return texto
                .toString()
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '_')
                .replace(/^-+|-+$/g, '');
        }
    });
</script>