<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Caja extends Model
{
    protected $table      = 'caja';
    protected $primaryKey = 'id_caja';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function get_total()
    {
        return $this->valor_inicial + Factura::where('estado', 1)
            ->where('id_caja', $this->id_caja)
            ->where('id_dominio_tipo_factura', '<>', 17)
            ->where('id_dominio_tipo_factura', '<>', 53)
            ->where('id_dominio_tipo_factura', '<>', 56)
            ->where('pagada', 1)
            ->sum('valor') - Factura::where('estado', 1)
            ->where('id_caja', $this->id_caja)
            ->where('id_dominio_tipo_factura', 53)
            ->sum('valor');
    }

    public function get_descuentos()
    {
        return Factura::where('estado', 1)
            ->where('id_caja', $this->id_caja)
            ->where('id_dominio_tipo_factura', '<>', 17)
            ->sum('descuento');
    }

    public function get_egresos()
    {
        return Factura::where('estado', 1)
            ->where('id_caja', $this->id_caja)
            ->where('id_dominio_tipo_factura', 53)
            ->sum('valor');
    }

    public function total_por_canal($id_dominio_canal)
    {
        return Factura::where('estado', 1)
            ->where('id_caja', $this->id_caja)
            ->where('id_dominio_tipo_factura', '<>', 17)
            ->where('id_dominio_canal', $id_dominio_canal)
            ->sum('valor');
    }

    public function total_por_forma_pago($id_dominio_forma_pago)
    {
        return DB::table('factura as f')
            ->join('forma_pago as fp', 'fp.id_factura', '=', 'f.id_factura')
            ->where('f.estado', 1)
            ->where('f.id_caja', $this->id_caja)
            ->where('f.id_dominio_tipo_factura', '<>', 17)
            ->where('fp.id_dominio_forma_pago', $id_dominio_forma_pago)
            ->sum('fp.valor');
    }
}
