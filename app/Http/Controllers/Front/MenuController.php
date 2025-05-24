<?php


namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show($slugAbuelo = null, $slugPadre = null, $slugHijo = null)
    {
        $menu = null;
        $jerarquia = [];

        // Nivel 1: Abuelo
        if ($slugAbuelo) {
            $menu = Menu::activo()->porSlug($slugAbuelo)->firstOrFail();
            $jerarquia['abuelo'] = $menu;
        }

        // Nivel 2: Padre
        if ($slugPadre) {
            $menu = Menu::activo()->porSlug($slugPadre)->hijoDe($menu->id_menu)->firstOrFail();
            $jerarquia['padre'] = $menu;
        }

        // Nivel 3: Hijo
        if ($slugHijo) {
            $menu = Menu::activo()->porSlug($slugHijo)->hijoDe($menu->id_menu)->firstOrFail();
            $jerarquia['hijo'] = $menu;
        }

        return view('front.menus.show', compact('menu', 'jerarquia'));
    }
}