@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $title }}</h1>
        <div>
            @if($padre->padre)
                <a href="{{ route('menus.hijos', $padre->padre) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-up"></i> Volver a {{ $padre->padre->nombre }}
                </a>
            @else
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-up"></i> Volver a Menús principales
                </a>
            @endif

            <a href="{{ route('menus.create', ['padre' => $padre->id_menu]) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>
                @if($padre->padre)
                    Nuevo Hermano (Mismo Nivel)
                @else
                    Nuevo Submenú
                @endif
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Submenús</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->id_menu }}</td>
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
</div>
@endsection