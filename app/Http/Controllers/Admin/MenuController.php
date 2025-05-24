<?php
namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Obtener solo los menús padre (nivel 1)
        $menus = Menu::withCount('hijos')
                    ->whereNull('id_menu_padre')
                    ->where('activo', 1)
                    ->orderBy('nombre')
                    ->get();

        return view('admin.menus.index', compact('menus'))->with('title', 'Gestión de Menús');
    }
    public function create()
    {
        $menuPadre = null;
        $nivelActual = 1;
        $menusDelMismoNivel = collect(); // Menús hermanos (mismo nivel)
        $menuSuperPadre = null; // Padre común para menús del mismo nivel

        $menusPadre = [];
        if(request()->has('padre')) {
            $menuPadre = Menu::with('padre')->findOrFail(request('padre'));

            // Determinar nivel actual
            $nivelActual = 2; // Solo permitimos hasta nivel 2

            // Si el menú desde el que creamos tiene padre (es nivel 2)
            if($menuPadre) {
                $menuSuperPadre = $menuPadre->padre();
                if(!$menuSuperPadre){
                    // Obtenemos todos los menús con el mismo padre (hermanos)
                    $menusDelMismoNivel = Menu::where('id_menu_padre', $menuPadre->id_menu)
                    ->where('activo', 1)
                    ->get();
                }else{
                    $menuSuperPadre  = $menuPadre;
                }

            }
        }else{
            $menusPadre = Menu::whereNull('id_menu_padre')->where('activo', 1)->get();
        }

        return view('admin.menus.create', [
            'menuPadre' => $menuPadre,
            'nivelActual' => $nivelActual,
            'menusDelMismoNivel' => $menusDelMismoNivel,
            'menuSuperPadre' => $menuSuperPadre,
            'menusPadre' => $menusPadre
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:menu,slug',
            'id_menu_padre' => 'nullable|exists:menu,id_menu',
            'opcion_creacion' => 'sometimes|in:nuevo,existente'
        ]);

        // Si se seleccionó asociar a existente y viene el campo
        if($request->opcion_creacion == 'existente' && $request->id_menu_existente) {
            $validated['id_menu_padre'] = $request->id_menu_existente;
        }

        Menu::create($validated);

        // Redirección inteligente
        if($validated['id_menu_padre']) {
            $padre = Menu::find($validated['id_menu_padre']);
            return redirect()->route('menus.hijos', $padre)
                   ->with('success', 'Menú creado exitosamente');
        }

        return redirect()->route('menus.index')
               ->with('success', 'Menú principal creado');
    }

    protected function redirectAfterStore(Menu $menu)
    {
        if ($menu->padre) {
            if ($menu->padre->padre) {
                // Nivel 3 → redirigir al abuelo
                return redirect()->route('menus.hijos', $menu->padre->padre)
                       ->with('success', 'Submenú nivel 3 creado');
            }
            // Nivel 2 → redirigir al padre
            return redirect()->route('menus.hijos', $menu->padre)
                   ->with('success', 'Submenú nivel 2 creado');
        }
        // Nivel 1 → redirigir al listado
        return redirect()->route('menus.index')
               ->with('success', 'Menú principal creado');
    }

    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    public function showHijos(Menu $menu)
    {
        $hijos = Menu::withCount('hijos')
                    ->where('id_menu_padre', $menu->id_menu)
                    ->where('activo', 1)
                    ->orderBy('nombre')
                    ->get();

        return view('admin.menus.hijos', [
            'padre' => $menu,
            'menus' => $hijos,
            'title' => 'Menús hijos de: ' . $menu->nombre
        ]);
    }

    public function edit(Menu $menu)
    {
        // Verificar si el menú es de nivel 3
        $esNivel3 = false;
        if($menu->padre && $menu->padre->padre) {
            $esNivel3 = true;
        }

        $menusDisponibles = Menu::whereNull('id_menu_padre')
                              ->where('activo', 1)
                              ->where('id_menu', '!=', $menu->id_menu)
                              ->pluck('nombre', 'id_menu');

        return view('admin.menus.edit', [
            'menu' => $menu,
            'menusDisponibles' => $menusDisponibles,
            'esNivel3' => $esNivel3
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'label' => 'nullable|max:50',
            'slug' => 'nullable|max:100|unique:menu,slug,'.$menu->id_menu.',id_menu',
            'id_menu_padre' => 'nullable|exists:menu,id_menu',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'activo' => 'boolean',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')
                         ->with('success', 'Menú actualizado exitosamente');
    }

    public function destroy(Menu $menu)
    {
        // Verificar si tiene hijos antes de eliminar
        if($menu->hijos()->exists()) {
            return redirect()->route('menus.index')
                             ->with('error', 'No se puede eliminar el menú porque tiene elementos hijos');
        }

        $menu->delete();



        //return redirect()->route('menus.index')->with('success', 'Menú eliminado exitosamente');

            if (!$menu->id_menu_padre) {
            return redirect()->route('menus.index');
        }

        $parent = $menu->padre;

        if ($parent->id_menu_padre) {
            // Menu nivel 3 → redirigir a nivel 2
            return redirect()->route('menus.show', $parent->id);
        }

        // Menu nivel 2 → redirigir a nivel 1 (index)
        return redirect()->route('menus.index');
    }
}