<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaInventario extends Model
{
    protected $table      = 'auditoria_inventario';
    protected $primaryKey = 'id_auditoria_inventario';

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public static function write_descuento($id_factura, $id_producto, $cantidad, $id_licencia)
    {
        $auditoria                             = new AuditoriaInventario;
        $auditoria->id_factura                 = $id_factura;
        $auditoria->id_producto                = $id_producto;
        $auditoria->cantidad                   = $cantidad;
        $auditoria->id_licencia                = $id_licencia;
        $auditoria->id_dominio_tipo_movimiento = 51;
        $auditoria->save();
    }

    public static function write_ingreso($id_factura, $id_producto, $cantidad, $id_licencia)
    {
        $auditoria                             = new AuditoriaInventario;
        $auditoria->id_factura                 = $id_factura;
        $auditoria->id_producto                = $id_producto;
        $auditoria->cantidad                   = $cantidad;
        $auditoria->id_licencia                = $id_licencia;
        $auditoria->id_dominio_tipo_movimiento = 52;

        $auditoria->save();
    }
}
