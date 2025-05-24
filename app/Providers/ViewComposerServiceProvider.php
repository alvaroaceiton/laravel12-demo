<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
{
    View::composer('*', function ($view) {
        if (str_starts_with($view->getName(), 'layouts.')) {
            try {
                $menus = Menu::with(['hijos' => function($query) {
                    $query->where('activo', 1)
                        ->with(['hijos' => function($query) {
                            $query->where('activo', 1);
                        }]);
                }])
                ->whereNull('id_menu_padre')
                ->where('activo', 1)
                ->orderBy('nombre')
                ->get();

                $view->with('menus', $menus);
            } catch (\Exception $e) {
                if (app()->environment('local')) {
                    logger()->error('Error loading menus: '.$e->getMessage());
                    $view->with('menus', collect());
                } else {
                    $view->with('menus', collect());
                }
            }
        }
    });
}
}