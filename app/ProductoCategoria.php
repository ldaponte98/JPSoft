<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    protected $table      = 'producto_categoria';
    protected $primaryKey = 'id_producto_categoria';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
