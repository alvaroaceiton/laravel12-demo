@extends('layouts.front')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb (Migajas de pan) -->
        <nav aria-label="breadcrumb">
            <ol class="flex flex-wrap items-center space-x-2">
                @isset($jerarquia['abuelo'])
                    <li class="breadcrumb-item">
                        <a href="{{ route('menu.dinamico', ['slugAbuelo' => $jerarquia['abuelo']->slug]) }}" class="text-blue-600 hover:text-blue-800">
                            {{ $jerarquia['abuelo']->nombre }}
                        </a>
                    </li>
                @endisset

                @isset($jerarquia['padre'])
                    <li class="breadcrumb-item">
                        <span class="mx-2">/</span>
                        <a href="{{ route('menu.dinamico', [
                            'slugAbuelo' => $jerarquia['abuelo']->slug,
                            'slugPadre' => $jerarquia['padre']->slug
                        ]) }}" class="text-blue-600 hover:text-blue-800">
                            {{ $jerarquia['padre']->nombre }}
                        </a>
                    </li>
                @endisset

                @isset($jerarquia['hijo'])
                    <li class="breadcrumb-item">
                        <span class="mx-2">/</span>
                        <span class="text-gray-500" aria-current="page">
                            {{ $jerarquia['hijo']->nombre }}
                        </span>
                    </li>
                @endisset
            </ol>
        </nav>

        <!-- Contenido del menú -->
        <h1 class="text-2xl font-bold mt-6 mb-4">
            Promociones destacadas del menú: {{ $menu->nombre }}
        </h1>

        @if($menu->hijos && $menu->hijos->isNotEmpty())
            <div class="mt-6 space-y-2">
                @foreach($menu->hijos as $hijo)
                    <a href="{{ route('menu.dinamico', [
                        'slugAbuelo' => $jerarquia['abuelo']->slug ?? null,
                        'slugPadre' => $jerarquia['padre']->slug ?? null,
                        'slugHijo' => $hijo->slug
                    ]) }}"
                       class="block p-4 border rounded-lg hover:bg-gray-100 transition">
                        {{ $hijo->nombre }}
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 mt-4">No hay submenús disponibles.</p>
        @endif
    </div>
</div>
@endsection