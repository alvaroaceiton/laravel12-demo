<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'id_menu_padre',
        'nombre',
        'label',
        'slug',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];
    // Relación para los hijos directos
    public function hijos()
    {
        return $this->hasMany(Menu::class, 'id_menu_padre');
    }

    // Relación para los nietos (hijos de hijos)
    public function nietos()
    {
        return $this->hijos()->with('hijos');
    }

    // Relación para el padre
    public function padre()
    {
        return $this->belongsTo(Menu::class, 'id_menu_padre');
    }

    // Relación para el abuelo
    public function abuelo()
    {
        return $this->padre->padre ?? null;
    }

    // app/Models/Menu.php
    public function scopeActivo($query)
    {
        return $query->where('activo', 1);
    }

    public function scopePorSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeHijoDe($query, $idPadre)
    {
        return $query->where('id_menu_padre', $idPadre);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'producto_menu', 'id_menu', 'id_producto');
    }
}
