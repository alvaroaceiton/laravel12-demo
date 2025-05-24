@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')

    <h1>{{ isset($menuPadre) ? 'Nuevo Submenú para: '.$menuPadre->nombre : 'Nuevo Menú' }}</h1>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            @if(isset($menuPadre))
                @if($nivelActual == 1)
                    <!-- Creando desde un menú principal (nivel 1) -->
                    <label>Creando submenú para: {{ $menuPadre->nombre }}</label>
                    <input type="hidden" name="id_menu_padre" value="{{ $menuPadre->id_menu }}">

                    <div class="alert alert-info mt-2">
                        <i class="fas fa-info-circle"></i> Estás creando un submenú de nivel 2
                    </div>
                @else
                    <!-- Creando desde un submenú (nivel 2) -->
                    <label>Jerarquía:</label>
                    <div class="p-3 bg-light rounded mb-3">
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge bg-primary me-2">Nivel 1</span>
                            {{ $menuSuperPadre->nombre }}
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success me-2">Nivel 2</span>
                            <span class="fst-italic">Nuevo elemento</span>
                        </div>
                    </div>

                    <label>Opciones:</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="opcion_creacion" id="opcion_nuevo" value="nuevo" checked>
                        <label class="form-check-label" for="opcion_nuevo">
                            Crear nuevo submenú para {{ $menuSuperPadre->nombre }}
                        </label>
                    </div>

                    @if($menusDelMismoNivel->isNotEmpty())
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opcion_creacion" id="opcion_existente" value="existente">
                            <label class="form-check-label" for="opcion_existente">
                                Asociar a un submenú existente del mismo nivel
                            </label>
                        </div>

                        <select name="id_menu_existente" id="id_menu_existente" class="form-control mt-2" disabled>
                            @foreach($menusDelMismoNivel as $menuHermano)
                                <option value="{{ $menuHermano->id_menu }}">
                                    {{ $menuHermano->nombre }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <input type="hidden" name="id_menu_padre" id="id_menu_padre_field" value="{{ $menuSuperPadre->id_menu }}">
                @endif
            @else
                <!-- Creación de menú principal -->
                <label for="id_menu_padre">Tipo de menú:</label>
                <select name="id_menu_padre" id="id_menu_padre" class="form-control">
                    <option value="">Menú principal (Nivel 1)</option>
                    @foreach($menusPadre as $menuPrincipal)
                        <option value="{{ $menuPrincipal->id_menu }}">
                            {{ $menuPrincipal->nombre }}(Sub menú nivel 2)
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly>
            <small class="text-muted">Dejar en blanco para generarlo automáticamente</small>
        </div>

        <!-- Resto de campos del formulario -->

        <div class="d-flex justify-content-between">
            <a href="{{ isset($menuPadre) ? route('menus.hijos', $menuPadre) : route('menus.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                Guardar Menú
            </button>
        </div>
    </form>

@stop

@push('scripts')
    <script>
        console.log('Dashboard loaded');
    </script>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar la selección de opciones para menús nivel 2
        const opcionNuevo = document.getElementById('opcion_nuevo');
        const opcionExistente = document.getElementById('opcion_existente');
        const selectExistente = document.getElementById('id_menu_existente');
        const padreField = document.getElementById('id_menu_padre_field');

        if(opcionExistente) {
            opcionExistente.addEventListener('change', function() {
                selectExistente.disabled = !this.checked;
                if(this.checked) {
                    padreField.disabled = true;
                    padreField.name = ''; // Desactivamos el campo hidden
                    selectExistente.name = 'id_menu_padre'; // Usamos este select
                }
            });

            opcionNuevo.addEventListener('change', function() {
                selectExistente.disabled = true;
                selectExistente.name = '';
                padreField.disabled = false;
                padreField.name = 'id_menu_padre';
            });
        }
    });
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
@endpush