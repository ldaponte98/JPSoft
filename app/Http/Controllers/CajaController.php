<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Dominio;
use App\Factura;
use App\ResolucionFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    public function apertura(Request $request)
    {
        $post    = $request->all();
        $errores = [];
        if ($post) {
            $post                 = (object) $post;
            $caja                 = new Caja;
            $caja->id_usuario     = session('id_usuario');
            $caja->fecha_apertura = date('Y-m-d H:i:s');
            $caja->valor_inicial  = 0;
            $caja->id_licencia    = session('id_licencia');
            if ($post->tipo_apertura == "apertura_0") {
                $caja->save();
                return redirect()->route('caja/view', $caja->id_caja);
            }

            if ($post->tipo_apertura == "apertura_valor") {
                if ($post->valor_inicial >= 0) {
                    $caja->valor_inicial = $post->valor_inicial;
                    $caja->save();
                    return redirect()->route('caja/view', $caja->id_caja);
                } else {
                    $errores[] = "El valor inicial de la caja no es valido";
                }
            }
        }
        return view("caja.apertura", compact(["errores"]));
    }

    public function view($id_caja)
    {
        $caja = Caja::where('id_caja', $id_caja)->where('id_licencia', session('id_licencia'))->first();
        if ($caja) {
            $canales     = Dominio::get_canales(session('id_licencia'));
            $formas_pago = Dominio::where('id_padre', 19)
                ->get();
            return view('caja.view', compact(['caja', 'canales', 'formas_pago']));
        }
        echo "Direccion no valida";die;
    }

    public function cerrar_caja($id_caja)
    {
        $error   = true;
        $mensaje = "";
        $caja    = Caja::find($id_caja);
        if ($caja) {
            if ($caja->id_usuario == session('id_usuario')) {
                $caja->fecha_cierre = date('Y-m-d H:i:s');
                $caja->save();
                $error   = false;
                $mensaje = "Caja cerrada exitosamente";
            } else {
                $mensaje = "La caja no puede ser cerrada por otro usuario distinto al que la abre";
            }
        } else {
            $mensaje = "Caja no valida";
        }
        return response()->json([
            'error'   => $error,
            'mensaje' => $mensaje,
        ]);
    }

    public function nuevo_documento(Request $request)
    {
        $post    = $request->all();
        $factura = new Factura;
        $errors  = [];

        if ($post) {
            $post = (object) $post;
            //$factura->fill($request->except(['_token']));
            $resolucion = ResolucionFactura::where('id_licencia', session('id_licencia'))->first();
            if ($resolucion) {
                DB::beginTransaction();
                //RESOLUCION DEL DOCUMENTO
                if ($post->id_dominio_tipo_factura == 53) {
                    //COMPROBANTE DE EGRESO
                    $factura->numero = $resolucion->prefijo_comprobante_egreso . "-" . ($resolucion->consecutivo_comprobante_egreso + 1);
                }

                $caja = Caja::where('id_usuario', session('id_usuario'))
                    ->where('estado', 1)
                    ->where('fecha_cierre', null)
                    ->first();

                if ($caja) {
                    $factura->id_tercero              = $post->id_tercero;
                    $factura->id_caja                 = $caja->id_caja;
                    $factura->valor                   = $post->valor;
                    $factura->id_dominio_tipo_factura = $post->id_dominio_tipo_factura;
                    $factura->observaciones           = $post->observaciones;
                    $factura->id_usuario_registra     = session('id_usuario');
                    $factura->id_licencia             = session('id_licencia');
                    $factura->id_dominio_canal        = 49;
                    $factura->finalizada              = 1;
                    if ($factura->save()) {
                        if ($post->id_dominio_tipo_factura == 53) {
                            $resolucion->consecutivo_comprobante_egreso += 1;
                        }
                        $resolucion->save();
                        DB::commit();
                        return redirect()->route('caja/view', $caja->id_caja);
                    } else {
                        DB::rollBack();
                        $errors = $factura->errors;
                    }
                } else {
                    DB::rollBack();
                    $errors[] = "No existe caja abierta para este usuario activa";
                }
            } else {
                DB::rollBack();
                $errors[] = "No tiene resolución de factura activa";
            }
        }
        return view('caja.nuevo_documento', compact(['factura', 'errors']));
    }
}
