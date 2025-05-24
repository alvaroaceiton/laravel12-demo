<?php

// app/Models/ProductoImagen.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    use HasFactory;

    protected $table = 'producto_imagenes';
    protected $fillable = ['id_producto', 'url', 'orden'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
