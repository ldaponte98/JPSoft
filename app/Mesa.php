<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table      = 'mesa';
    protected $primaryKey = 'id_mesa';

    protected $fillable = [
        'id_mesa',
        'numero',
        'estado',
    ];

    public function ocupada()
    {
        //RECORREMOS LAS FACTURAS QUE ESTEN ABIERTAS CON MESA
        $busqueda = Factura::where('estado', 1)
            ->where('id_licencia', $this->id_licencia)
            ->where('finalizada', 0)
            ->where('id_mesa', $this->id_mesa)
            ->first();
        return $busqueda ? true : false;
    }

    public function get_factura_ocupada()
    {
        $busqueda = Factura::where('estado', 1)
            ->where('id_licencia', $this->id_licencia)
            ->where('finalizada', 0)
            ->where('id_mesa', $this->id_mesa)
            ->first();
        return $busqueda;
    }
}
