<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioDetalle extends Model
{
    protected $table      = 'inventario_detalle';
    protected $primaryKey = 'id_inventario_detalle';

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id_inventario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
