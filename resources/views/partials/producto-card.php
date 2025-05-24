<div class="producto-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
    <!-- Imagen del producto -->
    <div class="relative pb-[75%] overflow-hidden">
        <img
            src="{{ $producto->imagen_principal_url ?? 'https://via.placeholder.com/300' }}"
            alt="{{ $producto->nombre }}"
            class="absolute h-full w-full object-cover hover:scale-105 transition-transform duration-300"
            loading="lazy"
        >
        <!-- Badge de estado -->
        @if($producto->estado_venta)
            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                Disponible
            </span>
        @else
            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                Agotado
            </span>
        @endif
    </div>

    <!-- Contenido de la card -->
    <div class="p-4">
        <!-- Nombre y precio -->
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>
            <span class="text-indigo-600 font-bold">${{ number_format($producto->precio, 0, ',', '.') }}</span>
        </div>

        <!-- Fechas -->
        <div class="text-sm text-gray-500 mb-3">
            <div class="flex items-center mb-1">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Hasta {{ $producto->fecha_termino->format('d M Y') }}
            </div>
        </div>

        <!-- Menús asociados -->
        @if($producto->menus->count() > 0)
            <div class="flex flex-wrap gap-1 mb-3">
                @foreach($producto->menus as $menu)
                    <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                        {{ $menu->nombre }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Botón de acción -->
        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md transition-colors duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Añadir al carrito
        </button>
    </div>
</div>