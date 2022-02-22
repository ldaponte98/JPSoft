<?php

namespace App\Http\Controllers;

use App\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TerceroController extends Controller
{
    public function administrar(Request $request)
    {
        $post     = (object) $request->all();
        $terceros = Tercero::all()->where('id_licencia', session('id_licencia'));
        return view('tercero.administrar', compact('terceros'));
    }
    public function crear(Request $request, $id_tercero = null)
    {
        $post            = $request->all();
        $tercero         = new Tercero;
        $tercero->estado = null;
        if ($id_tercero != null) {
            $tercero = Tercero::find($id_tercero);
        }

        $errors = [];
        if ($post) {
            $post = (object) $post;
            $tercero->fill($request->except(['_token', 'imagen']));

            if ($tercero->identificacion == null or $tercero->identificacion == "") {
                $tercero->identificacion = date('YmdHis') . rand(1000, 9999);
            }
            $tercero_identificacion = Tercero::where('identificacion', $post->identificacion)
                ->where('id_licencia', session('id_licencia'))
                ->where('id_tercero', '<>', $id_tercero)
                ->first();

            if (!$tercero_identificacion) {
                $tercero->id_licencia = session('id_licencia');
                $file                 = $request->file('imagen');
                if ($file) {
                    $ruta           = '/imagenes/tercero';
                    $extension      = explode('.', $file->getClientOriginalName())[1];
                    $nombre_archivo = rand(1000, 999999) . "-" . date('Y-m-d-H-i-s') . "." . $extension;
                    Storage::disk('public')->put($ruta . "/" . $nombre_archivo, \File::get($file));
                    $tercero->imagen = $nombre_archivo;
                }
                if ($tercero->save()) {
                    return redirect()->route('tercero/view', $tercero->id_tercero);
                } else {
                    $errors = $tercero->errors;
                }
            } else {
                $errors[] = "identificacion ya existente.";
                return view('tercero.form', compact(['tercero', 'errors']));
            }
        }
        return view('tercero.form', compact(['tercero', 'errors']));

    }

    public function view($id_tercero)
    {
        $tercero = Tercero::find($id_tercero);
        if ($tercero) {
            return view('tercero.view', compact(['tercero']));
        }
        echo "Acceso denegado";
    }

    public function buscar($caracteres)
    {
        if (strlen($caracteres) > 3) {
            $sql = "select * from tercero where id_tercero = '" . $caracteres . "'" .
            " or UPPER(nombres) like '%" . strtoupper($caracteres) . "%'" .
            " or UPPER(apellidos) like '%" . strtoupper($caracteres) . "%'" .
            " or UPPER(email) like '%" . strtoupper($caracteres) . "%'" .
            " or UPPER(identificacion) like '%" . strtoupper($caracteres) . "%'" .
            " and id_licencia = " . session('id_licencia') . " limit 10";
            $response = DB::select($sql);
            return response()->json($response);
        }
    }

    public function listar()
    {
        return Tercero::all()->where('id_licencia', session('id_licencia'));
    }
}
