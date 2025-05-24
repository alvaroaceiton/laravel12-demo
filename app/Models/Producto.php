<?php

// app/Models/Producto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre',
        'estado',
        'fecha_inicio',
        'fecha_termino',
        'estado_venta',
        'imagen_principal'
    ];
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_termino' => 'datetime',
    ];

    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'id_producto');
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class, 'id_producto');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'producto_menu', 'id_producto', 'id_menu');
    }
}
