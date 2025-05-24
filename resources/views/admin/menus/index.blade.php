@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $title }}</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Menú
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Submenús</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->nombre }}</td>
                        <td>{{ $menu->slug }}</td>
                        <td>
                            @if($menu->hijos_count > 0)
                                <span class="badge bg-primary">{{ $menu->hijos_count }}</span>
                            @else
                                <span class="text-muted">Ninguno</span>
                            @endif
                        </td>
                        <td>
                            @if($menu->hijos_count > 0)
                                <a href="{{ route('menus.hijos', $menu) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Ver Submenús
                                </a>
                            @endif
                            <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este menú?')">
                                    <i class="fas fa-trash"></i> Eliminar
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

@push('scripts')
    <script>
        console.log('Dashboard loaded');
    </script>
@endpush