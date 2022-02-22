<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    protected $table      = 'forma_pago';
    protected $primaryKey = 'id_forma_pago';

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_forma_pago');
    }
}
