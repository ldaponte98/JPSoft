<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResolucionFactura extends Model
{
    protected $table = 'resolucion_factura';
    protected $primaryKey = 'id_resolucion_factura';


    public function licencia()
    {
        return $this->belongsTo(Licencia::class, 'id_licencia');
    }
}
