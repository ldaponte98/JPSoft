<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'factura_detalle';
    protected $primaryKey = 'id_factura_detalle';


    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
