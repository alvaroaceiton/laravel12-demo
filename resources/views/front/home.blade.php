@extends('layouts.front')

@section('title', 'Inicio')

@section('content')

    <div class="bg-gray-50">
        <div x-data="bannerCarousel()" class="relative w-full">
            <!-- Carrusel Container -->
            <div class="swiper banner-swiper">
                <div class="swiper-wrapper  !h-auto">

                    <div class="swiper-slide">
                        <picture>
                            <!-- Versión mobile (opcional, si tienes imágenes diferentes) -->
                            <source media="(max-width: 640px)"
                                srcset="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/143bddb67cb558a5682b708c99858740164a2f7b.jpg">
                            <!-- Versión desktop -->
                            <img src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/438d9560791b62378056ec8fa9db434ce8b2efa7.jpg"
                                alt="Banner"
                                class="w-full h-auto object-cover max-h-[500px] md:max-h-[600px] lg:max-h-[700px] max-w-[1920px] mx-auto ">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <!-- Versión mobile (opcional, si tienes imágenes diferentes) -->
                            <source media="(max-width: 640px)"
                                srcset="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/143bddb67cb558a5682b708c99858740164a2f7b.jpg">
                            <!-- Versión desktop -->
                            <img src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/ff6c968bb6da6ce119a1b0ceb6daf7502fd36606.jpg"
                                alt="Banner"
                                class="w-full h-auto object-cover max-h-[500px] md:max-h-[600px] lg:max-h-[700px] max-w-[1920px] mx-auto ">
                        </picture>
                    </div>
                    <div class="swiper-slide h-auto">
                        <picture>
                            <!-- Versión mobile (opcional, si tienes imágenes diferentes) -->
                            <source media="(max-width: 640px)"
                                srcset="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/143bddb67cb558a5682b708c99858740164a2f7b.jpg">
                            <!-- Versión desktop -->
                            <img src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/438d9560791b62378056ec8fa9db434ce8b2efa7.jpg"
                                alt="Banner"
                                class="w-full h-auto object-cover max-h-[500px] md:max-h-[600px] lg:max-h-[700px] max-w-[1920px] mx-auto ">
                        </picture>
                    </div>
                    <div class="swiper-slide h-auto">
                        <picture>
                            <!-- Versión mobile (opcional, si tienes imágenes diferentes) -->
                            <source media="(max-width: 640px)"
                                srcset="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/143bddb67cb558a5682b708c99858740164a2f7b.jpg">
                            <!-- Versión desktop -->
                            <img src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/ff6c968bb6da6ce119a1b0ceb6daf7502fd36606.jpg"
                                alt="Banner"
                                class="w-full h-auto object-cover max-h-[500px] md:max-h-[600px] lg:max-h-[700px] max-w-[1920px] mx-auto ">
                        </picture>
                    </div>
                </div>

                <!-- Paginación -->
                <div class="swiper-pagination"></div>

                <!-- Navegación -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 px-4 md:px-6 max-w-[1200px] mx-auto py-4 md:py-6">
            <!-- Banner 1 -->
            <article
                class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out h-[100px] sm:h-[120px] md:h-[150px]"
                data-id="banner-3905">
                <a href="https://www.cuponatic.com/vende" class="block h-full">
                    <img class="w-full h-full object-cover" alt="Promoción vendedores"
                        src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/b0c94c7441d0d4c18e651f43248e7716a20bb8a4.jpg"
                        loading="lazy">
                </a>
            </article>

            <!-- Banner 2 -->
            <article
                class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out h-[100px] sm:h-[120px] md:h-[150px]"
                data-id="banner-4089">
                <img class="w-full h-full object-cover" alt="Promoción cuotas"
                    src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/4f9f1ba9e7a46da7d151972b36a1bc2b9837bfad.jpg"
                    loading="lazy">
            </article>
        </div>


        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">Bienvenido a nuestro sitio</h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Descripción breve de tu página de inicio.</p>

                    <div class="mt-10">
                        <a href="/contact"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            Contáctanos
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-3 px-4 md:px-6 max-w-[1200px] mx-auto py-4 md:py-6">
            <h1 class="text-3xl font-bold text-left mb-8">Nuestros Productos</h1>
            <!-- Filtro por menú -->
            <div class="mb-6 max-w-md">
                <label for="filtro-menu" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por menú:</label>
                <select id="filtro-menu"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Todos los productos</option>
                    <!-- Las opciones de menú se cargarán por API -->
                </select>
            </div>

            <!-- Contenedor de productos -->
            <div id="productos-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
                <!-- Los productos se cargarán dinámicamente via API -->
            </div>

            <!-- Estado de carga -->
            <div id="loading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-600"></div>
                <p class="mt-2 text-gray-600">Cargando productos...</p>
            </div>

            <!-- Mensaje cuando no hay productos -->
            <div id="no-productos" class="text-center py-12 hidden">
                <p class="text-xl text-gray-500">No se encontraron productos disponibles</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 px-4 md:px-6 max-w-[1200px] mx-auto py-4 md:py-6">
            <!-- Banner 1 -->
            <article
                class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out h-[100px] sm:h-[120px] md:h-[150px]"
                data-id="banner-3905">
                <a href="https://www.cuponatic.com/vende" class="block h-full">
                    <img class="w-full h-full object-cover" alt="Promoción vendedores"
                        src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/b0c94c7441d0d4c18e651f43248e7716a20bb8a4.jpg"
                        loading="lazy">
                </a>
            </article>

            <!-- Banner 2 -->
            <article
                class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out h-[100px] sm:h-[120px] md:h-[150px]"
                data-id="banner-4089">
                <img class="w-full h-full object-cover" alt="Promoción cuotas"
                    src="https://cuponassets.cuponatic-latam.com/backendCl/uploads/imagenes_banners_gigantes/4f9f1ba9e7a46da7d151972b36a1bc2b9837bfad.jpg"
                    loading="lazy">
            </article>
        </div>

        <!-- Más secciones de tu home -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Otras secciones de contenido -->
            </div>
        </div>
    @endsection

    <script>
        function bannerCarousel() {
            return {
                init() {
                    new Swiper('.banner-swiper', {
                        loop: true,
                        autoplay: {
                            delay: 5000,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            // Cuando el ancho es >= 640px
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 0
                            },
                            // Cuando el ancho es >= 1024px
                            1024: {
                                slidesPerView: 1,
                                spaceBetween: 0
                            }
                        }
                    });
                }
            }
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productosContainer = document.getElementById('productos-container');
            const loadingElement = document.getElementById('loading');
            const noProductsElement = document.getElementById('no-productos');
            const filtroMenu = document.getElementById('filtro-menu');

            // Variable para almacenar todos los menús encontrados
            let todosLosMenus = new Set();

            // Función para cargar productos
            function cargarProductos(menuId = '') {
                loadingElement.classList.remove('hidden');
                productosContainer.innerHTML = '';
                noProductsElement.classList.add('hidden');

                const url = menuId ?
                    `/api/v1/productos/menu/${menuId}` :
                    '/api/v1/productos';

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        loadingElement.classList.add('hidden');

                        if (data.success && data.data.length > 0) {
                            // Procesar productos y extraer menús
                            data.data.forEach(producto => {
                                // Agregar menús al conjunto
                                if (producto.menus && producto.menus.length > 0) {
                                    producto.menus.forEach(menu => {
                                        todosLosMenus.add(JSON.stringify({
                                            id_menu: menu.id_menu,
                                            nombre: menu.nombre
                                        }));
                                    });
                                }

                                productosContainer.appendChild(crearCardProducto(producto));
                            });

                            // Actualizar el filtro de menús
                            actualizarFiltroMenus();
                        } else {
                            noProductsElement.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loadingElement.classList.add('hidden');
                        noProductsElement.classList.remove('hidden');
                    });
            }

            // Función para actualizar el select de menús
            function actualizarFiltroMenus() {
                // Limpiar opciones existentes (excepto la primera)
                while (filtroMenu.options.length > 1) {
                    filtroMenu.remove(1);
                }

                // Convertir Set a array y ordenar alfabéticamente
                const menusArray = Array.from(todosLosMenus)
                    .map(menuStr => JSON.parse(menuStr))
                    .sort((a, b) => a.nombre.localeCompare(b.nombre));

                // Agregar opciones al select
                menusArray.forEach(menu => {
                    const option = document.createElement('option');
                    option.value = menu.id_menu;
                    option.textContent = menu.nombre;
                    filtroMenu.appendChild(option);
                });
            }

            // Función para crear una card de producto
            function crearCardProducto(producto) {
                const card = document.createElement('div');
                card.className =
                    'bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col h-full cursor-pointer';

                // Formatear fecha
                const fechaTermino = new Date(producto.fecha_termino);
                const opcionesFecha = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                const fechaFormateada = fechaTermino.toLocaleDateString('es-ES', opcionesFecha);

                // Crear badges de menús
                let menusHTML = '';
                if (producto.menus && producto.menus.length > 0) {
                    menusHTML = `
        <div class="flex flex-wrap gap-1 mb-3">
            ${producto.menus.map(menu => `
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                            ${menu.nombre}
                        </span>
                    `).join('')}
        </div>
    `;
                }

                card.innerHTML = `
    <div class="relative pb-[75%] overflow-hidden">
        <img
            src="${producto.imagen_principal_url || 'https://via.placeholder.com/300'}"
            alt="${producto.nombre}"
            class="absolute h-full w-full object-cover hover:scale-105 transition-transform duration-300"
            loading="lazy"
        >
        <span class="absolute top-2 right-2 ${
            producto.estado_venta
                ? 'bg-green-500'
                : 'bg-red-500'
        } text-white text-xs font-semibold px-2 py-1 rounded-full">
            ${producto.estado_venta ? 'Disponible' : 'Agotado'}
        </span>
    </div>

    <div class="p-4 flex flex-col flex-grow">
        <div class="flex-grow">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-lg font-semibold text-gray-800">${producto.nombre}</h3>
                <span class="text-indigo-600 font-bold">$${
                    producto.precio?.toLocaleString('es-ES') || '0'
                }</span>
            </div>

            <div class="text-sm text-gray-500 mb-3">
                <div class="flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Hasta ${fechaFormateada}
                </div>
            </div>

            ${menusHTML}
        </div>

        <button class="mt-auto w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md transition-colors duration-300 flex items-center justify-center cursor-pointer">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Añadir al carrito
        </button>
    </div>
`;

                return card;
            }

            // Cargar productos iniciales
            cargarProductos();

            // Evento de cambio en el filtro
            if (filtroMenu) {
                filtroMenu.addEventListener('change', function() {
                    cargarProductos(this.value);
                });
            }
        });
    </script>
