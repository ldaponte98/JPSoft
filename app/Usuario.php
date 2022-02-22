<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id_usuario';

    public $clave_confirmacion = null;

    protected $fillable = [
        'id_usuario',
        'id_tercero',
        'id_perfil',
        'usuario',
        'estado',
    ];
    public function tercero()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }
}
