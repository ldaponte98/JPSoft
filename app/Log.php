<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table      = 'log';
    protected $primaryKey = 'id_log';

    public static function write($titulo = "", $detalle = "")
    {
        $log          = new Log;
        $log->titulo  = $titulo;
        $log->detalle = $detalle;
        $log->save();
    }
}
