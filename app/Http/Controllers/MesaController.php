<?php

namespace App\Http\Controllers;

use App\Mesa;
use Illuminate\Http\Request;

class mesaController extends Controller
{
    public function administrar($value = '')
    {
        $mesas = Mesa::where('id_licencia', session('id_licencia'))
            ->orderBy('id_mesa', 'asc')
            ->get();
        return view('mesa.administrar', compact('mesas'));
    }

    public function guardar(Request $request, $id_mesa = null)
    {
        $post         = $request->all();
        $mesa         = new Mesa;
        $mesa->estado = null;
        if ($id_mesa != null) {
            $mesa = Mesa::find($id_mesa);
        }
        $errors = [];
        if ($post) {
            $post = (object) $post;
            $mesa->fill($request->except(['_token']));
            $mesa_nombre = Mesa::where('numero', $post->numero)
                ->where('id_licencia', session('id_licencia'))
                ->where('id_mesa', '<>', $id_mesa)
                ->first();
            if (!$mesa_nombre) {
                $mesa->id_licencia = session('id_licencia');
                if ($mesa->save()) {
                    return redirect()->route('mesa/administrar');
                } else {
                    $errors = $mesa->errors;
                }
            } else {
                $errors[] = "El numero de esta mesa ya esta registrado.";
                return view('mesa.form', compact(['mesa', 'errors']));
            }
        }
        return view('mesa.form', compact(['mesa', 'errors']));
    }
}
