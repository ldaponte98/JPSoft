<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dominio extends Model
{
    protected $table      = 'dominio';
    protected $primaryKey = 'id_dominio';

    public static function get($name)
    {
        $dominio = Dominio::where('nombre', $name)->first();
        return $dominio ? $dominio->id_dominio : null;
    }

    public static function get_canales($id_licencia)
    {
        $canales    = [];
        $permitidos = DB::table('licencia_canal')
            ->select('id_dominio_canal')
            ->where('id_licencia', $id_licencia)
            ->where('estado', 1)
            ->get();

        foreach ($permitidos as $permitido) {
            $permitido = (object) $permitido;
            $canales[] = Dominio::find($permitido->id_dominio_canal);
        }

        //AGREGAMOS EL CANAL GENERAL QUE ES NO DEFINIDO
        $canales[] = Dominio::find(49);
        return $canales;
    }

    public function get_imagen()
    {
        if ($this->imagen != null and $this->imagen != '') {
            return asset('imagenes/' . $this->imagen);
        } else {
            return asset('plantilla/images/app/sinimagen.jpg');
        }
    }
}
