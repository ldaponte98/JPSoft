<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function administrar(Request $request)
    {
        $post       = (object) $request->all();
        $categorias = Categoria::all()->where('id_licencia', session('id_licencia'));
        return view('categoria.administrar', compact('categorias'));
    }

    public function guardar(Request $request, $id_categoria = null)
    {
        $post              = $request->all();
        $categoria         = new Categoria;
        $categoria->estado = null;
        if ($id_categoria != null) {
            $categoria = Categoria::find($id_categoria);
        }
        $errors = [];
        if ($post) {
            $post = (object) $post;
            $categoria->fill($request->except(['_token']));
            $categoria_nombre = Categoria::where('nombre', $post->nombre)
                ->where('id_licencia', session('id_licencia'))
                ->where('id_categoria', '<>', $id_categoria)
                ->first();
            if (!$categoria_nombre) {
                $categoria->id_licencia = session('id_licencia');
                if ($categoria->save()) {
                    return redirect()->route('categoria/administrar');
                } else {
                    $errors = $categoria->errors;
                }
            } else {
                $errors[] = "El nombre de esta categoria ya esta registrado.";
                return view('categoria.form', compact(['categoria', 'errors']));
            }
        }
        return view('categoria.form', compact(['categoria', 'errors']));
    }
}
