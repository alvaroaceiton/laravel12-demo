<?php

// app/Models/Segmento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    use HasFactory;
    protected $table = 'segmento';
    protected $primaryKey = 'id_segmento';
    protected $fillable = [
        'id_producto',
        'id_descuento',
        'estado',
        'nombre',
        'stock'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}