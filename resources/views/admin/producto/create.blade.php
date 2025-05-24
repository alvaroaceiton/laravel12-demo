@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nuevo Producto</h3>
        </div>
        <form action="{{ route('admin.producto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
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
                                value="{{ old('fecha_inicio', now()->format('Y-m-d\TH:i')) }}"
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
                                value="{{ old('fecha_termino', now()->addDay()->format('Y-m-d\TH:i')) }}"
                                min="{{ old('fecha_inicio', now()->format('Y-m-d\TH:i')) }}"
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
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="estado" name="estado" value="1"
                            checked>
                        <label class="custom-control-label" for="estado">Activo</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="estado_venta" name="estado_venta"
                            value="1" checked>
                        <label class="custom-control-label" for="estado_venta">Disponible para venta</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagen_principal">Imagen Principal</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagen_principal" name="imagen_principal">
                        <label class="custom-file-label" for="imagen_principal">Seleccionar archivo</label>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.producto.index') }}" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
@stop

@push('js')
    <script>
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
    </script>
@endpush
