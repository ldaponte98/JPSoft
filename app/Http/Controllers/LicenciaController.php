<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Licencia;

class LicenciaController extends Controller
{
    public function menu_clientes()
    {
        $licencia = Licencia::find(session('id_licencia'));
        if ($licencia) {
            return view('licencia.menu_clientes', compact(['licencia']));
        } else {
            echo "<h1>Direccion no valida</h1>";
        }
    }

    public function validar_pedidos_nuevos()
    {
        $error   = true;
        $pedidos = Factura::where('id_licencia', session('id_licencia'))
            ->where('estado', 1)
            ->where('finalizada', 0)
            ->where('id_dominio_canal', 54)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($pedidos) {
            $error = false;
        }

        return response()->json(['error' => $error]);
    }
}
