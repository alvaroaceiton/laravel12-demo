@extends('layouts.admin')

@section('header_title', 'Listado de Productos')


@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Productos</h3>
            <div class="card-tools">
                <a href="{{ route('admin.producto.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Término</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>
                            @if($producto->imagen_principal)
                                <img src="{{ asset('storage/' . $producto->imagen_principal) }}"
                                     alt="{{ $producto->nombre }}" style="max-height: 50px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $producto->estado ? 'bg-success' : 'bg-danger' }}">
                                {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>{{ $producto->fecha_inicio->format('Y-m-d H:s:i') }}</td>
                        <td>{{ $producto->fecha_termino->format('Y-m-d H:s:i') }}</td>
                        <td>
                            <a href="{{ route('admin.producto.edit', $producto) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.producto.destroy', $producto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop