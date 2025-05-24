<?php
// app/Http/Controllers/Admin/ProductoController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Producto;
use App\Models\Segmento;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('segmentos')->get();
        return view('admin.producto.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.producto.create');
    }

    public function store(Request $request)
    {
        // 1️⃣ Validación (sin try-catch)
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after:fecha_inicio',
            'imagen_principal' => 'nullable|image|max:2048',
        ], [
            'fecha_termino.after' => 'La fecha de término debe ser POSTERIOR a la de inicio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_inicio.date' => 'El formato de fecha de inicio es inválido.',
            'fecha_termino.date' => 'El formato de fecha de término es inválido.',
            'imagen_principal.image' => 'El archivo debe ser una imagen válida.',
            'imagen_principal.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        // 2️⃣ Si pasa la validación, guarda el producto
        $data = $request->only(['nombre', 'estado', 'fecha_inicio', 'fecha_termino', 'estado_venta']);

        if ($request->hasFile('imagen_principal')) {
            $path = $request->file('imagen_principal')->store('productos', 'public');
            $data['imagen_principal'] = $path;
        }

        Producto::create($data);

        return redirect()->route('admin.producto.index')->with('success', 'Producto creado');
    }

    public function show(Producto $producto)
    {
        return view('admin.producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {

        $menus = Menu::all(); // O cualquier query que necesites
        return view('admin.producto.edit', compact('producto', 'menus'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after:fecha_inicio',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'nombre',
            'estado',
            'fecha_inicio',
            'fecha_termino',
            'estado_venta'
        ]);

        // Procesar imagen principal
        if ($request->hasFile('imagen_principal')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen_principal) {
                Storage::disk('public')->delete($producto->imagen_principal);
            }

            // Guardar nueva imagen
            $image = $request->file('imagen_principal');
            $imageName = 'producto-' . $producto->id_producto . '-' . time() . '.' . $image->extension();
            $path = $image->storeAs('productos', $imageName, 'public');
            $data['imagen_principal'] = $path;
        }

        // Actualizar producto
        $producto->update($data);

        // Sincronizar menús
        $producto->menus()->sync($request->input('menus', []));

        // Procesar imágenes adicionales
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $imageName = 'producto-' . $producto->id_producto . '-' . uniqid() . '.' . $imagen->extension();
                $path = $imagen->storeAs('productos/additional', $imageName, 'public');
                $producto->imagenes()->create(['url' => $path]);
            }
        }

        // Procesar segmentos
        if ($request->has('segmentos')) {
            $producto->segmentos()->delete();
            foreach ($request->segmentos as $segmentoData) {
                $producto->segmentos()->create($segmentoData);
            }
        }

        return redirect()->route('admin.producto.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.producto.index')->with('success', 'Producto eliminado correctamente');
    }

    public function destroyImage(Producto $producto, ProductoImagen $imagen)
    {
        Storage::disk('public')->delete($imagen->url);
        $imagen->delete();
        return back()->with('success', 'Imagen eliminada correctamente');
    }
}
