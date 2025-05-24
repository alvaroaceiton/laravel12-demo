@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@push('css')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da;
    }
</style>
@endpush
@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Producto</h3>
        </div>
        <form action="{{ route('admin.producto.update', $producto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha y Hora de Inicio</label>
                            <input
                                type="datetime-local"
                                id="fecha_inicio"
                                name="fecha_inicio"
                                required
                                class="form-control @error('fecha_inicio') is-invalid @enderror"
                                value="{{ old('fecha_inicio', $producto->fecha_inicio ? $producto->fecha_inicio->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                            >
                            @error('fecha_inicio')
                                <div class="invalid-feedback">
                                    <i class="icon fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_termino">Fecha y Hora de Término</label>
                            <input
                                type="datetime-local"
                                id="fecha_termino"
                                name="fecha_termino"
                                required
                                class="form-control @error('fecha_termino') is-invalid @enderror"
                                value="{{ old('fecha_termino', $producto->fecha_termino ? $producto->fecha_termino->format('Y-m-d\TH:i') : now()->addDay()->format('Y-m-d\TH:i')) }}"
                                min="{{ old('fecha_inicio', $producto->fecha_inicio ? $producto->fecha_inicio->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                            >
                            @error('fecha_termino')
                                <div class="invalid-feedback">
                                    <i class="icon fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="menus">Menús asociados</label>
                    <select name="menus[]" id="menus" class="form-control select2" multiple="multiple">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id_menu }}"
                                {{ $producto->menus->contains('id_menu', $menu->id_menu) ? 'selected' : '' }}>
                                {{ $menu->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="estado" name="estado" value="1"
                            {{ old('estado', $producto->estado) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="estado">Activo</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="estado_venta" name="estado_venta"
                            value="1" {{ old('estado_venta', $producto->estado_venta) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="estado_venta">Disponible para venta</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagen_principal">Imagen Principal</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagen_principal" name="imagen_principal">
                        <label class="custom-file-label" for="imagen_principal">Seleccionar archivo</label>
                    </div>
                    @if ($producto->imagen_principal)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" alt="Imagen principal"
                                style="max-height: 150px;">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Imágenes Adicionales</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagenes" name="imagenes[]" multiple>
                        <label class="custom-file-label" for="imagenes">Seleccionar archivos</label>
                    </div>

                    <div class="row mt-3">
                        @foreach ($producto->imagenes as $imagen)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $imagen->url) }}" alt="Imagen del producto"
                                        class="card-img-top img-fluid p-2" style="max-height: 180px; object-fit: contain;">

                                    <div class="card-footer bg-white border-top-0">
                                        <button type="button" class="btn btn-sm btn-danger btn-block"
                                            onclick="if(confirm('¿Estás seguro?')) { document.getElementById('form-delete-{{ $imagen->id }}').submit(); }">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr>
                <h4>Segmentos</h4>
                <div id="segmentos-container">
                    @foreach ($producto->segmentos as $index => $segmento)
                        <div class="segmento-item card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control"
                                                name="segmentos[{{ $index }}][nombre]"
                                                value="{{ $segmento->nombre }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input type="number" class="form-control"
                                                name="segmentos[{{ $index }}][stock]"
                                                value="{{ $segmento->stock }}" required min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="segmentos[{{ $index }}][estado]">
                                                <option value="1" {{ $segmento->estado ? 'selected' : '' }}>Activo
                                                </option>
                                                <option value="0" {{ !$segmento->estado ? 'selected' : '' }}>Inactivo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-segmento">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-segmento" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Agregar Segmento
                </button>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.producto.index') }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
        @foreach ($producto->imagenes as $imagen)
            <!-- FORMULARIO CORREGIDO - versión 100% funcional -->
            <form method="POST"
                action="{{ route('admin.producto.imagenes.destroy', ['producto' => $producto->id_producto, 'imagen' => $imagen->id]) }}"
                id="form-delete-{{ $imagen->id }}">
                @csrf
                @method('DELETE')

            </form>
        @endforeach
    </div>
@stop

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.select2').select2({
            placeholder: "Seleccione los menús",
            allowClear: true
        });
    });
</script>

@push('js')
    <script>
        function submitDeleteForm(formId) {
            const form = document.getElementById(formId);
            if (form) {
                if (confirm('¿Estás seguro de eliminar esta imagen?')) {
                    form.submit();
                }
            } else {
                console.error('Formulario no encontrado:', formId);
            }
        }
    </script>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let segmentoCount = {{ $producto->segmentos->count() }};

            document.getElementById('add-segmento').addEventListener('click', function() {
                const container = document.getElementById('segmentos-container');
                const newSegmento = document.createElement('div');
                newSegmento.className = 'segmento-item card mb-3';
                newSegmento.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="segmentos[${segmentoCount}][nombre]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="segmentos[${segmentoCount}][stock]" required min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name="segmentos[${segmentoCount}][estado]">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-segmento">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

                container.appendChild(newSegmento);
                segmentoCount++;
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-segmento')) {
                    e.target.closest('.segmento-item').remove();
                }
            });

            // Mostrar nombre de archivo en inputs file
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    let fileName = this.files[0]?.name || 'Seleccionar archivo';
                    if (this.files.length > 1) {
                        fileName = `${this.files.length} archivos seleccionados`;
                    }
                    this.nextElementSibling.textContent = fileName;
                });
            });
        });
    </script>
@endpush
