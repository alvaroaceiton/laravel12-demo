<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Obtener productos activos para el home
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productos = Producto::with(['menus', 'imagenes'])
            ->where('estado', 1) // Productos activos
            ->where('estado_venta', 1) // Disponibles para venta
            ->where(function ($query) {
                // Que estén dentro de su rango de fechas válido
                $query->where('fecha_inicio', '<=', now())
                    ->where('fecha_termino', '>=', now());
            })
            ->orderBy('fecha_inicio', 'asc')
            ->get()
            ->map(function($producto){
                return [
                    'id_producto' => $producto->id_producto,
                    'nombre' => $producto->nombre,
                    'imagen_principal_url' => $producto->imagen_principal
                        ? asset('storage/' . $producto->imagen_principal)
                        : null,
                    'menus' => $producto->menus,
                    'fecha_termino' => $producto->fecha_termino,
                    'estado_venta' => $producto->estado_venta
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $productos,
            'message' => 'Productos activos obtenidos correctamente'
        ]);
    }

    /**
     * Obtener productos por menú
     *
     * @param int $idMenu
     * @return \Illuminate\Http\JsonResponse
     */
    public function porMenu($idMenu)
    {
        $productos = Producto::with(['imagenes'])
            ->whereHas('menus', function ($query) use ($idMenu) {
                $query->where('id_menu', $idMenu);
            })
            ->where('estado', 1)
            ->where('estado_venta', 1)
            ->where(function ($query) {
                $query->where('fecha_inicio', '<=', now())
                    ->where('fecha_termino', '>=', now());
            })
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $productos,
            'message' => 'Productos por menú obtenidos correctamente'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
