 // Inicializar todas las funciones
document.addEventListener('DOMContentLoaded', () => {
    // Menú principal móvil
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const content = document.getElementById('mobile-menu-content');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');

        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            content.classList.add('mobile-menu-animation');
            openIcon.classList.add('opacity-0');
            closeIcon.classList.remove('opacity-0');
        } else {
            content.classList.remove('mobile-menu-animation');
            openIcon.classList.remove('opacity-0');
            closeIcon.classList.add('opacity-0');
            setTimeout(() => menu.classList.add('hidden'), 300);
        }
    });

    // Dropdowns móviles
    document.querySelectorAll('.mobile-menu-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            const icon = this.querySelector('i');
            submenu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });

    document.querySelectorAll('.mobile-submenu-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const subsubmenu = this.nextElementSibling;
            const icon = this.querySelector('i');
            subsubmenu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });

    // Hover para desktop
    document.querySelectorAll('.desktop-menu-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.desktop-submenu').classList.remove('hidden');
        });

        item.addEventListener('mouseleave', function() {
            this.querySelector('.desktop-submenu').classList.add('hidden');
        });
    });

    document.querySelectorAll('.desktop-submenu-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.desktop-submenu-l3').classList.remove('hidden');
        });

        item.addEventListener('mouseleave', function() {
            this.querySelector('.desktop-submenu-l3').classList.add('hidden');
        });
    });
});