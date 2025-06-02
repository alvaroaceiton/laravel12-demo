<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Front\MenuController as FrontMenuController;
use App\Http\Controllers\Front\HomeController;

use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// routes/web.php

// Ruta dinámica para manejar los 3 niveles
Route::get('menu/{slugAbuelo?}/{slugPadre?}/{slugHijo?}', [FrontMenuController::class, 'show'])
    ->where([
        'abuelo' => '[a-z0-9-]+',
        'padre' => '[a-z0-9-]+',
        'hijo' => '[a-z0-9-]+'
    ])
    ->name('menu.dinamico');

// Rutas personalizadas para el login bajo /admin
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.home');
    }
    return app(LoginController::class)->showLoginForm();
});

Route::prefix('/admin')->group(function () {
    Auth::routes();
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/pages', function(){
        return view('admin.pages');
    });
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::resource('menus', AdminMenuController::class);
    Route::get('menus/{menu}/hijos', [AdminMenuController::class, 'showHijos'])->name('menus.hijos');
    // routes/web.php
    Route::resource('producto', ProductoController::class)->names('admin.producto');
    Route::delete('producto/{producto}/imagenes/{imagen}', [ProductoController::class, 'destroyImage'])
        ->name('admin.producto.imagenes.destroy');

});
