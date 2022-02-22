<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoIngrediente extends Model
{
    protected $table      = 'producto_ingrediente';
    protected $primaryKey = 'id_producto_ingrediente';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function ingrediente()
    {
        return $this->belongsTo(Producto::class, 'id_ingrediente', 'id_producto');
    }
}
