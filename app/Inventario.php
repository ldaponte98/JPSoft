<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table      = 'inventario';
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'id_producto',
        'id_dominio_tipo_movimiento',
        'fecha',
        'id_tercero_proveedor',
        'estado',
        'observaciones',
        'id_usuario_registra',
        'id_usuario_modifica',
        'id_licencia',
    ];

    public function detalles()
    {
        return $this->hasMany(InventarioDetalle::class, 'id_inventario');
    }

    public function usuario_registra()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }

    public function usuario_modifica()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_modifica', 'id_usuario');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function proveedor()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero_proveedor', 'id_tercero');
    }

    public function tipo_movimiento()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo_movimiento');
    }

    public function total()
    {
        $total = 0;
        foreach ($this->detalles as $detalle) {
            $total += ($detalle->cantidad * $detalle->precio_producto);
        }
        return $total;
    }
}
