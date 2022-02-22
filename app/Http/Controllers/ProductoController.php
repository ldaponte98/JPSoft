<?php

namespace App\Http\Controllers;

use App\Dominio;
use App\Producto;
use App\ProductoCategoria;
use App\ProductoIngrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function buscar($id_producto)
    {
        return response()->json(Producto::find($id_producto));
    }

    public function administrar(Request $request)
    {
        $post  = (object) $request->all();
        $tipos = Dominio::all()->where('id_padre', 35);
        return view('producto.administrar', compact('tipos'));
    }

    public function guardar(Request $request, $id_producto = null)
    {
        $post                              = $request->all();
        $producto                          = new Producto;
        $producto->estado                  = null;
        $producto->precio_venta            = 0;
        $producto->precio_compra           = 0;
        $producto->iva                     = 0;
        $producto->descontado              = 0;
        $producto->descontado_ingredientes = 0;
        $producto->contenido               = 1;
        $producto->cantidad_actual         = 0;
        $producto->cantidad_minimo_alerta  = 0;
        $producto->alerta                  = 0;
        $categorias                        = [];
        if ($id_producto != null) {
            $producto   = Producto::find($id_producto);
            $categorias = $producto->get_id_categorias();
        }

        $errors = [];
        if ($post) {
            $post = (object) $post;
            $producto->fill($request->except(['_token', 'imagen']));
            $producto->id_usuario_registra = session('id_usuario');
            $producto_nombre               = Producto::where('nombre', $post->nombre)
                ->where('id_licencia', session('id_licencia'))
                ->where('id_producto', '<>', $id_producto)
                ->first();
            if (isset($post->descontado)) {
                $producto->descontado = 1;
            } else {
                $producto->contenido       = 1;
                $producto->cantidad_actual = 0;
                $producto->descontado      = 0;
            }

            if (isset($post->descontado_ingredientes)) {
                $producto->descontado_ingredientes = 1;
            } else {
                $producto->descontado_ingredientes = 0;
            }

            if (isset($post->alerta)) {
                $producto->alerta = 1;
            } else {
                $producto->alerta = 0;
            }

            if (isset($post->categorias) or $producto->id_dominio_tipo_producto != 36) {
                //36 ES PRODUCTO
                $categorias = isset($post->categorias) ? $post->categorias : [];
                if (!$producto_nombre) {
                    $producto->id_licencia = session('id_licencia');
                    $file                  = $request->file('imagen');
                    if ($file) {
                        $ruta           = '/imagenes/producto';
                        $extension      = explode('.', $file->getClientOriginalName())[1];
                        $nombre_archivo = rand(1000, 999999) . "-" . date('Y-m-d-H-i-s') . "." . $extension;
                        Storage::disk('public')->put($ruta . "/" . $nombre_archivo, \File::get($file));
                        $producto->imagen = $nombre_archivo;
                    }
                    if ($producto->save()) {

                        //AHORA REGISTRAMOS LAS CATEGORIAS
                        DB::delete("DELETE FROM producto_categoria WHERE id_producto = " . $producto->id_producto);
                        foreach ($categorias as $id_categoria) {
                            $item               = new ProductoCategoria;
                            $item->id_producto  = $producto->id_producto;
                            $item->id_categoria = $id_categoria;
                            $item->save();
                        }

                        //AHORA REGISTRAMOS LOS INGREDIENTES
                        $delete = ProductoIngrediente::where('id_producto', $producto->id_producto)->delete();
                        if ($producto->descontado_ingredientes == 1) {
                            $ingredientes = [];
                            if (isset($post->ingredientes)) {
                                $ingredientes = json_decode($post->ingredientes);
                            }

                            foreach ($ingredientes as $ingrediente) {
                                $item                 = new ProductoIngrediente;
                                $item->id_producto    = $producto->id_producto;
                                $item->id_ingrediente = $ingrediente->id;
                                $item->cantidad       = $ingrediente->cantidad;
                                $item->save();
                            }

                        }
                        return redirect()->route('producto/view', $producto->id_producto);
                    } else {
                        $errors = $producto->errors;
                    }
                } else {
                    $errors[] = "El nombre de este producto ya esta registrado.";
                    return view('producto.form', compact(['producto', 'categorias', 'errors']));
                }
            } else {
                $errors[] = "Debe escoger por lo menos una categoria.";
                return view('producto.form', compact(['producto', 'categorias', 'errors']));
            }
        }
        return view('producto.form', compact(['producto', 'categorias', 'errors']));
    }

    public function view($id_producto)
    {
        $producto = Producto::find($id_producto);
        if ($producto) {
            return view('producto.view', compact(['producto']));
        }
        echo "Acceso denegado";
    }

}
