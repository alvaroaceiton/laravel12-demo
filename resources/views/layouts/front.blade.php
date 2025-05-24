<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Mi Sitio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Otros meta tags y CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS de Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Animaciones básicas */
        .mobile-menu-animation {
            animation: slideDown 0.3s ease-out forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estructura del menú desktop */
        .desktop-menu-item {
            position: relative;
        }

        .desktop-submenu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 50;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .desktop-menu-item:hover .desktop-submenu {
            opacity: 1;
            pointer-events: auto;
        }

        .desktop-submenu-item {
            position: relative;
        }

        .desktop-submenu-l3 {
            position: absolute;
            left: 100%;
            top: 0;
            z-index: 60;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .desktop-submenu-item:hover .desktop-submenu-l3 {
            opacity: 1;
            pointer-events: auto;
        }

        /* Animación de flecha para desktop */
        .desktop-menu-item button svg {
            transition: transform 0.2s ease;
        }

        .desktop-menu-item:hover button svg {
            transform: rotate(180deg);
        }

        /* Flecha para items con submenú en nivel 2 */

        .desktop-submenu-item:hover svg {
            transform: rotate(180deg);
            /* Gira hacia la izquierda */
        }
        /* Asegura que el menú móvil no haga scroll con la página */
#mobile-menu {
    position: fixed;
    top: 5rem;
    left: 0;
    right: 0;
    z-index: 40;
}

/* Efecto de reducción */
.nav-scrolled {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-scrolled #nav-main-row {
    height: 3.5rem;
}

.nav-scrolled #nav-logo {
    height: 8;
}

.nav-scrolled #nav-brand {
    font-size: 1.1rem;
}

.nav-scrolled #nav-desktop-menu {
    height: 0;
    overflow: hidden;
    opacity: 0;
}

.nav-scrolled #nav-spacer {
    height: 3.5rem;
}

    </style>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <nav id="main-nav" class="bg-white shadow-lg fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo + Menú móvil -->
                <div class="flex items-center space-x-4">
                    <button id="mobile-menu-button"
                        class="md:hidden text-gray-700 hover:text-indigo-600 relative w-8 h-8 bottom-[12px]">
                        <i id="menu-open-icon" class="fas fa-bars absolute text-2xl transition-all duration-300"></i>
                        <i id="menu-close-icon"
                            class="fas fa-times absolute text-2xl transition-all duration-300 opacity-0"></i>
                    </button>

                    <a href="/" class="flex items-center">
                        <img src="/logo.png" alt="Logo" class="h-10 w-auto">
                        <span class="ml-2 text-xl font-bold text-indigo-600 hidden sm:block">TuMarca</span>
                    </a>
                </div>
                <!-- Iconos de usuario y carrito -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="relative text-gray-700 hover:text-indigo-600 p-2">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>

                    <div class="relative group">
                        <button id="user-icon-button"
                            class="text-gray-700 hover:text-indigo-600 p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-user text-xl"></i>
                        </button>
                        <div
                            class="absolute right-0 mt-0 hidden group-hover:block bg-white shadow-lg rounded-md py-1 w-48 z-50">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Mi cuenta</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Mis pedidos</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 border-t">Cerrar
                                sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden md:flex justify-center items-center h-10">
                <!-- Menú Desktop -->
                <div class="hidden md:flex space-x-8 items-center justify-center flex-1">
                    @foreach ($menus as $menu)
                        @if ($menu->hijos->count() > 0)
                            <!-- Nivel 1 -->
                            <div class="desktop-menu-item">
                                <button
                                    class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-indigo-600 min-w-[120px] justify-center">
                                    {{ $menu->nombre }}
                                    <svg class="w-4 h-4 transform" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Nivel 2 -->
                                <div class="desktop-submenu hidden bg-white shadow-lg rounded-md py-1 w-48">
                                    @foreach ($menu->hijos as $hijo)
                                        @if ($hijo->hijos->count() > 0)
                                            <!-- Item con submenú - Nivel 2 -->
                                            <div class="desktop-submenu-item">
                                                <div
                                                    class="flex justify-between items-center px-4 py-2 hover:bg-indigo-50 text-gray-700 border-b-2 border-transparent hover:border-indigo-600 transition-colors duration-200">
                                                    <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug, 'slugPadre' => $hijo->slug]) }}"
                                                        class="flex-1">
                                                        {{ $hijo->nombre }}
                                                    </a>
                                                    <svg class="w-4 h-4 text-gray-400 transform rotate-270"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>

                                                <!-- Nivel 3 -->
                                                <div
                                                    class="desktop-submenu-l3 hidden bg-white shadow-xl rounded-md py-1 w-48 border border-gray-100">
                                                    @foreach ($hijo->hijos as $nieto)
                                                        <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug, 'slugPadre' => $hijo->slug, 'slugHijo' => $nieto->slug]) }}"
                                                            class="block px-4 py-2 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 border-b-2 border-transparent hover:border-indigo-600 transition-colors duration-200">
                                                            {{ $nieto->nombre }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <!-- Item simple -->
                                            <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug, 'padre' => $hijo->slug]) }}"
                                                class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">
                                                {{ $hijo->nombre }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @if ($menu->slug === 'inicio')
                                <a href="{{ url('/') }}"
                                    class="px-3 py-2 text-gray-700 hover:text-indigo-600 border-b-2 border-transparent hover:border-indigo-600 transition-colors duration-200">
                                    {{ $menu->nombre }}
                                </a>
                            @else
                                <!-- Menú sin hijos -->
                                <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug]) }}"
                                    class="px-3 py-2 text-gray-700 hover:text-indigo-600 border-b-2 border-transparent hover:border-indigo-600 transition-colors duration-200">
                                    {{ $menu->nombre }}
                                </a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Menú Móvil -->
        <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg overflow-hidden">
            <div id="mobile-menu-content" class="px-2 pt-2 pb-4 space-y-1">
                @foreach ($menus as $menu)
                    @if ($menu->hijos->count() > 0)
                        <div class="mobile-menu-item">
                            <button
                                class="mobile-menu-toggle w-full flex justify-between items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                <span>{{ $menu->nombre }}</span>
                                <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                            </button>

                            <div class="mobile-submenu hidden pl-4 space-y-1">
                                @foreach ($menu->hijos as $hijo)
                                    @if ($hijo->hijos->count() > 0)
                                        <div class="mobile-submenu-item">
                                            <button
                                                class="mobile-submenu-toggle w-full flex justify-between items-center px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                                <span>{{ $hijo->nombre }}</span>
                                                <i
                                                    class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                                            </button>

                                            <div class="mobile-subsubmenu hidden pl-4 space-y-1">
                                                @foreach ($hijo->hijos as $nieto)
                                                    <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug, 'slugPadre' => $hijo->slug, 'slugHijo' => $nieto->slug]) }}"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                                        {{ $nieto->nombre }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug, 'slugPadre' => $hijo->slug]) }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                            {{ $hijo->nombre }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        @if ($menu->slug === 'inicio')
                            <a href="{{ url('/') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                {{ $menu->nombre }}
                            </a>
                        @else
                            <a href="{{ route('menu.dinamico', ['slugAbuelo' => $menu->slug]) }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg">
                                {{ $menu->nombre }}
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </nav>
    <div id="nav-spacer" class="w-full transition-all duration-300" style="height: 80px;"></div>

    <!-- Contenido Principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Columna 1 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Sobre Nosotros</h3>
                    <p class="text-gray-300">Descripción breve de tu empresa o proyecto.</p>
                </div>

                <!-- Columna 2 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white">Inicio</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white">Nosotros</a></li>
                        <li><a href="/services" class="text-gray-300 hover:text-white">Servicios</a></li>
                    </ul>
                </div>

                <!-- Columna 3 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                    <p class="text-gray-300">contacto@tusitio.com</p>
                    <p class="text-gray-300">+56 9 1234 5678</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nav = document.getElementById('main-nav');
    const spacer = document.getElementById('nav-spacer');
    let lastScroll = 0;
    const scrollThreshold = 100; // Píxeles a desplazar antes de reducir

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > scrollThreshold) {
            nav.classList.add('nav-scrolled');

            // Efecto de mostrar/ocultar al hacer scroll hacia arriba/abajo
            if (currentScroll > lastScroll && currentScroll > 200) {
                // Scroll hacia abajo
                nav.style.transform = 'translateY(-100%)';
            } else {
                // Scroll hacia arriba
                nav.style.transform = 'translateY(0)';
            }
        } else {
            nav.classList.remove('nav-scrolled');
            nav.style.transform = 'translateY(0)';
        }

        lastScroll = currentScroll;
    });

    // Ajustar el spacer inicialmente
    spacer.style.height = nav.offsetHeight + 'px';
});
document.addEventListener('DOMContentLoaded', function() {
    const nav = document.getElementById('main-nav');
    const spacer = document.getElementById('nav-spacer');
    const desktopMenu = document.getElementById('nav-desktop-menu');

    // Ajustar inicialmente el espaciador
    function updateSpacer() {
        const navHeight = nav.offsetHeight;
        spacer.style.height = `${navHeight}px`;
    }

    // Efecto de scroll
    let lastScroll = 0;
    const scrollThreshold = 100;

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > scrollThreshold) {
            nav.classList.add('nav-scrolled');
            if (desktopMenu) desktopMenu.style.opacity = '0';

            // Efecto de mostrar/ocultar
            if (currentScroll > lastScroll && currentScroll > 200) {
                nav.style.transform = 'translateY(-100%)';
            } else {
                nav.style.transform = 'translateY(0)';
            }
        } else {
            nav.classList.remove('nav-scrolled');
            nav.style.transform = 'translateY(0)';
            if (desktopMenu) desktopMenu.style.opacity = '1';
        }

        lastScroll = currentScroll;
        updateSpacer(); // Actualizar el espaciador dinámicamente
    });

    // Inicializar
    updateSpacer();

    // Actualizar en resize
    window.addEventListener('resize', updateSpacer);
});
</script>
