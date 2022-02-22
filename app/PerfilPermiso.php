<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilPermiso extends Model
{
    protected $table      = 'perfil_permiso';
    protected $primaryKey = 'id_perfil_permiso';

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'id_permiso');
    }
}
