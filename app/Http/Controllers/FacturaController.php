<?php

namespace App\Http\Controllers;

use App\AuditoriaInventario;
use App\Caja;
use App\Categoria;
use App\Dominio;
use App\Factura;
use App\FacturaDetalle;
use App\FormaPago;
use App\Licencia;
use App\Log;
use App\Mesa;
use App\Permiso;
use App\Producto;
use App\ResolucionFactura;
use App\Tercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function crear(Request $request)
    {
        //VALIDAMOS SI EL USUARIO TIENE CAJA ABIERTA PARA PODER FACTURAR
        $caja = Caja::where('id_usuario', session('id_usuario'))
            ->where('estado', 1)
            ->where('fecha_cierre', null)
            ->first();
        if ($caja == null) {
            //VALIDAMOS SI TIENE PERMISO DE FACTURAR CON LA ULTIMA CAJA Q ESTE ABIERTA
            if (Permiso::validar(3)) {
                $caja = Caja::where('id_licencia', session('id_licencia'))
                    ->where('estado', 1)
                    ->where('fecha_cierre', null)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($caja == null) {
                    return redirect()->route('caja/apertura');
                }
            } else {
                return redirect()->route('caja/apertura');
            }
        }
        $post    = (object) $request->all();
        $tercero = new Tercero;
        $accion  = "Facturación";
        $tipo    = $post->tipo;
        if ($tipo == 17) {
            $accion = "Cotización";
        }

        if ($post->id_tercero) {
            $tercero = Tercero::find($post->id_tercero);
        }

        return view('factura.form', compact([
            'tercero', 'accion', 'tipo',
        ]));
    }

    public function finalizar_factura(Request $request)
    {
        $post       = $request->all();
        $error      = true;
        $mensaje    = "";
        $id_factura = null;
        $errors     = [];
        if ($post) {
            $post = (object) $post;
            $caja = Caja::where('id_usuario', session('id_usuario'))
                ->where('estado', 1)
                ->where('fecha_cierre', null)
                ->first();
            if ($caja == null) {
                if (Permiso::validar(3)) {
                    $caja = Caja::where('id_licencia', session('id_licencia'))
                        ->where('estado', 1)
                        ->where('fecha_cierre', null)
                        ->orderBy('created_at', 'desc')
                        ->first();
                }
            }
            if ($caja) {
                //primero buscamos el consecutivo de la resolucion para la factura
                $resolucion = ResolucionFactura::where('id_licencia', session('id_licencia'))->first();
                DB::beginTransaction();
                if ($resolucion) {
                    $factura = new Factura;
                    if ($post->tipo_factura == 16) {
                        $factura->numero = $resolucion->prefijo_factura . "-" . ($resolucion->consecutivo_factura + 1);
                    }

                    if ($post->tipo_factura == 17) {
                        $factura->numero = $resolucion->prefijo_cotizacion . "-" . ($resolucion->consecutivo_cotizacion + 1);
                    }

                    $factura->id_tercero              = $post->id_tercero;
                    $factura->id_caja                 = $caja->id_caja;
                    $factura->valor                   = $post->total_carrito;
                    $factura->id_dominio_tipo_factura = $post->tipo_factura;
                    $factura->observaciones           = $post->observaciones;
                    $factura->id_usuario_registra     = session('id_usuario');
                    $factura->id_licencia             = session('id_licencia');
                    $factura->id_dominio_canal        = 49;
                    $factura->finalizada              = 1;
                    $factura->pagada                  = 1;
                    if ($factura->save()) {
                        //ahora aumentamos el consecutivo de la resolucion
                        if ($post->tipo_factura == 16) {
                            $resolucion->consecutivo_factura += 1;
                        }

                        if ($post->tipo_factura == 17) {
                            $resolucion->consecutivo_cotizacion += 1;
                        }

                        $total_descuentos = 0;
                        //ahora registramos los detalles de la factura
                        foreach ($post->carrito as $producto) {

                            $producto                       = (object) $producto;
                            $p                              = Producto::find($producto->id_producto);
                            $detalle                        = new FacturaDetalle;
                            $detalle->id_factura            = $factura->id_factura;
                            $detalle->id_producto           = $producto->id_producto;
                            $detalle->iva_producto          = $producto->iva;
                            $detalle->nombre_producto       = $producto->nombre;
                            $detalle->descripcion_producto  = $producto->descripcion;
                            $detalle->precio_producto       = $producto->precio;
                            $detalle->descuento_producto    = $producto->descuento;
                            $detalle->presentacion_producto = $p->presentacion->nombre;
                            $detalle->save();
                            $total_descuentos += $producto->descuento;
                        }

                        $factura->descuento = $total_descuentos;
                        $factura->save();
                        //Ahora registramos las formas de pago
                        if (isset($post->formas_pago)) {
                            foreach ($post->formas_pago as $forma) {
                                $forma                             = (object) $forma;
                                $forma_pago                        = new FormaPago;
                                $forma_pago->id_factura            = $factura->id_factura;
                                $forma_pago->id_dominio_forma_pago = $forma->id_dominio_forma_pago;
                                $forma_pago->valor                 = $forma->valor;
                                $forma_pago->save();

                                if ($forma_pago->id_dominio_forma_pago == Dominio::get('Credito (Saldo pendiente)')) {
                                    $texto_resolucion                 = $resolucion->prefijo_credito . "-" . ($resolucion->consecutivo_credito + 1);
                                    $factura->numero                  = $texto_resolucion;
                                    $factura->id_dominio_tipo_factura = Dominio::get('Factura a credito (Saldo pendiente)');
                                    $factura->save();
                                }
                            }
                        }

                        if ($post->factura->id_factura == null) {
                            //ahora aumentamos el consecutivo de la resolucion
                            if ($factura->id_dominio_tipo_factura == Dominio::get('Factura a credito (Saldo pendiente)')) {
                                $resolucion->consecutivo_credito += 1;
                            }
                            if ($factura->id_dominio_tipo_factura == 16) {
                                //FACTURA DE VENTA
                                $resolucion->consecutivo_factura += 1;
                            }

                            $resolucion->save();
                        }

                        $this->descontar_inventario_detalles($factura->detalles, $factura->id_factura);

                        $id_factura = $factura->id_factura;
                        $mensaje    = "Documento registrado exitosamente";
                        $error      = false;
                        DB::commit();
                        $factura->enviar_email();
                    } else {
                        DB::rollBack();
                        $mensaje = "Error al registrar la factura";
                        $errors  = $factura->errors;
                    }
                } else {
                    DB::rollBack();
                    $mensaje = "No tiene resolucion activa";
                }
            } else {
                DB::rollBack();
                $mensaje = "No tiene resolucion activa";
            }

            return response()->json([
                'error'      => $error,
                'mensaje'    => $mensaje,
                'errors'     => $errors,
                'id_factura' => $id_factura,
            ]);
        }
    }

    public function imprimir($id_factura)
    {
        set_time_limit(72000);
        $factura = Factura::find($id_factura);
        $pdf     = \PDF::loadView('pdf.factura', compact('factura'));
        return $pdf->stream($factura->tipo->nombre . ' ' . $factura->licencia->nombre . '.pdf');
    }

    public function imprimir_ticket_comanda($id_factura)
    {
        $factura = Factura::find($id_factura);

        $customPaper = array(0, 0, 225.80, 450.00);
        $pdf         = \PDF::loadView('pdf.ticket_comanda', compact('factura'))
            ->setPaper($customPaper);
        return $pdf->stream("Comanda #" . $factura->numero . '.pdf');
    }

    public function imprimir_ticket_factura($id_factura)
    {
        $factura = Factura::find($id_factura);

        $customPaper = array(0, 0, 225.80, 767.00);
        //return view('pdf.ticket_factura', compact('factura'));
        $pdf = \PDF::loadView('pdf.ticket_factura', compact('factura'))
            ->setPaper($customPaper);
        return $pdf->stream("Factura #" . $factura->numero . '.pdf');
    }

    public function canales_servicio()
    {
        $fecha   = date('Y-m-d');
        $canales = Dominio::get_canales(session('id_licencia'));

        $mesas = Mesa::where('estado', 1)
            ->where('id_licencia', session('id_licencia'))
            ->orderBy('id_mesa', 'asc')
            ->get();

        $facturas = Factura::where('id_licencia', session('id_licencia'))
            ->where('estado', 1)
            ->whereIn('id_dominio_tipo_factura', [16, 56])
            ->where('finalizada', 0)
            ->get();

        return view("factura.canales_servicio", compact([
            'canales', 'mesas', 'facturas',
        ]));
    }

    public function facturador(Request $request)
    {
        //VALIDAMOS SI EL USUARIO TIENE CAJA ABIERTA PARA PODER FACTURAR
        $caja = Caja::where('id_usuario', session('id_usuario'))
            ->where('estado', 1)
            ->where('fecha_cierre', null)
            ->first();
        if ($caja == null) {
            //VALIDAMOS SI TIENE PERMISO DE FACTURAR CON LA ULTIMA CAJA Q ESTE ABIERTA
            if (Permiso::validar(3)) {
                $caja = Caja::where('id_licencia', session('id_licencia'))
                    ->where('estado', 1)
                    ->where('fecha_cierre', null)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($caja == null) {
                    return redirect()->route('caja/apertura');
                }
            } else {
                return redirect()->route('caja/apertura');
            }
        }

        $categorias = Categoria::where('estado', 1)
            ->where('id_licencia', session('id_licencia'))
            ->orderBy('nombre', 'desc')
            ->get();

        $productos = Producto::where('estado', 1)
            ->where('id_licencia', session('id_licencia'))
            ->orderBy('nombre', 'desc')
            ->get();

        $_mesas = Mesa::where('estado', 1)
            ->where('id_licencia', session('id_licencia'))
            ->orderBy('numero', 'asc')
            ->get();

        $formas_pago = Dominio::where('id_padre', 19)
            ->get();

        $canales = Dominio::get_canales(session('id_licencia'));

        $mesas = [];
        foreach ($_mesas as $mesa) {
            if (!$mesa->ocupada()) {
                $mesas[] = $mesa;
            }
        }

        $formas_pago_selected = [20];
        $post                 = $request->all();
        $factura              = null;
        $id_mesa              = null;
        $canal                = null;
        if ($post) {
            $post = (object) $post;
            if (isset($post->factura)) {
                $factura = Factura::find($post->factura);
                if ($factura->id_mesa) {
                    $mesas[] = $factura->mesa;
                }
                $formas_pago_selected = $factura->get_formas_pago();
            }

            if (isset($post->mesa)) {
                $id_mesa = $post->mesa;
            }
            if (isset($post->canal)) {
                $canal = $post->canal;
            }
        }
        sort($mesas);
        return view("factura.facturador", compact([
            'categorias', 'productos', 'mesas', 'formas_pago',
            'formas_pago_selected', 'factura', 'id_mesa', 'canal', 'canales',
        ]));
    }

    public function finalizar_factura_facturador(Request $request)
    {
        $post       = $request->all();
        $error      = true;
        $mensaje    = "";
        $id_factura = null;
        $errors     = [];
        if ($post) {
            $post                   = (object) $post;
            $post->factura          = (object) $post->factura;
            $post->factura->cliente = (object) $post->factura->cliente;
            $menu_digital           = false;
            $caja                   = new Caja;
            $id_licencia            = session('id_licencia');
            $id_usuario             = session('id_usuario');
            if ($post->factura->id_dominio_canal == 54 and $id_licencia == null) {
                $menu_digital = true;
                $id_licencia  = $post->factura->id_licencia;
                $id_usuario   = 1;
            } else {
                //validamos si el usuario tiene caja abierta para facturar
                $caja = Caja::where('id_usuario', $id_usuario)
                    ->where('estado', 1)
                    ->where('fecha_cierre', null)
                    ->first();

                if ($caja == null) {
                    if (Permiso::validar(3)) {
                        $caja = Caja::where('id_licencia', $id_licencia)
                            ->where('estado', 1)
                            ->where('fecha_cierre', null)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    }
                }
            }

            if ($caja or $menu_digital) {
                //primero buscamos el consecutivo de la resolucion para la factura
                $resolucion = ResolucionFactura::where('id_licencia', $id_licencia)->first();
                DB::beginTransaction();
                if ($resolucion) {
                    $factura          = $post->factura->id_factura == null ? new Factura : Factura::find($post->factura->id_factura);
                    $texto_resolucion = $resolucion->prefijo_factura . "-" . ($resolucion->consecutivo_factura + 1);
                    $factura->numero  = $post->factura->id_factura == null ? $texto_resolucion : $factura->numero;

                    $cliente                          = $this->guardar_cliente_factura($post);
                    $factura->id_tercero              = $cliente->id_tercero;
                    $factura->id_caja                 = $menu_digital ? null : $caja->id_caja;
                    $factura->valor                   = $post->factura->total;
                    $factura->descuento               = $post->factura->descuento;
                    $factura->id_dominio_tipo_factura = 16;
                    $factura->servicio_voluntario     = $post->factura->servicio_voluntario;
                    $factura->observaciones           = $post->factura->observaciones;
                    $factura->id_usuario_registra     = $id_usuario;
                    $factura->id_licencia             = $id_licencia;
                    $factura->domicilio               = 0;
                    $factura->id_mesa                 = null;
                    $factura->finalizada              = $post->factura->finalizada;
                    $factura->id_dominio_canal        = $post->factura->id_dominio_canal;
                    $factura->direccion               = $post->factura->direccion;
                    $factura->pagada                  = 1;

                    if ($post->factura->id_dominio_canal == Dominio::get('Mesa')) {
                        $factura->id_mesa = $post->factura->id_mesa;
                    }
                    if ($post->factura->id_dominio_canal == Dominio::get('Domicilio')) {
                        $factura->domicilio = $post->factura->domicilio;
                    }

                    if ($factura->save()) {

                        //ahora registramos los detalles de la factura
                        DB::statement('delete from factura_detalle where id_factura = ' . $factura->id_factura);
                        foreach ($post->factura->detalles as $producto) {
                            $producto                       = (object) $producto;
                            $detalle                        = new FacturaDetalle;
                            $detalle->id_factura            = $factura->id_factura;
                            $detalle->id_producto           = $producto->id_producto;
                            $detalle->cantidad              = $producto->cantidad;
                            $detalle->nombre_producto       = $producto->nombre;
                            $detalle->precio_producto       = $producto->precio_venta;
                            $detalle->presentacion_producto = $producto->presentacion;
                            $detalle->save();
                        }

                        //Ahora registramos las formas de pago
                        DB::statement('delete from forma_pago where id_factura = ' . $factura->id_factura);
                        if (isset($post->factura->formas_pago)) {
                            foreach ($post->factura->formas_pago as $id_dominio_forma_pago) {
                                $forma_pago                        = new FormaPago;
                                $forma_pago->id_factura            = $factura->id_factura;
                                $forma_pago->id_dominio_forma_pago = $id_dominio_forma_pago;
                                $forma_pago->valor                 = ($factura->valor / count($post->factura->formas_pago));
                                $forma_pago->save();

                                if ($forma_pago->id_dominio_forma_pago == Dominio::get('Credito (Saldo pendiente)')) {
                                    $texto_resolucion                 = $resolucion->prefijo_credito . "-" . ($resolucion->consecutivo_credito + 1);
                                    $factura->numero                  = $post->factura->id_factura == null ? $texto_resolucion : $factura->numero;
                                    $factura->id_dominio_tipo_factura = Dominio::get('Factura a credito (Saldo pendiente)');
                                    $factura->save();
                                }
                            }
                        }

                        if ($post->factura->id_factura == null) {
                            //ahora aumentamos el consecutivo de la resolucion
                            if ($factura->id_dominio_tipo_factura == Dominio::get('Factura a credito (Saldo pendiente)')) {
                                $resolucion->consecutivo_credito += 1;
                            }
                            if ($factura->id_dominio_tipo_factura == 16) {
                                //FACTURA DE VENTA
                                $resolucion->consecutivo_factura += 1;
                            }

                            $resolucion->save();
                        }

                        if ($factura->finalizada == 1) {
                            $this->descontar_inventario_detalles($post->factura->detalles, $factura->id_factura);
                        }

                        $id_factura = $factura->id_factura;
                        $mensaje    = "Factura registrada exitosamente";
                        $error      = false;
                        DB::commit();

                        if ($factura->finalizada == 1) {
                            $factura->enviar_email();
                        }
                    } else {
                        DB::rollBack();
                        $mensaje = "Error al registrar la factura";
                        $errors  = $factura->errors;
                    }
                } else {
                    DB::rollBack();
                    $mensaje = "No tiene resolucion activa";
                }
            } else {
                DB::rollBack();
                $mensaje = "No cuenta con caja abierta para facturar";
            }

            return response()->json([
                'error'      => $error,
                'mensaje'    => $mensaje,
                'errors'     => $errors,
                'id_factura' => $id_factura,
            ]);
        }
    }

    public function guardar_cliente_factura($post)
    {
        $cliente     = new Tercero;
        $id_licencia = session('id_licencia');
        if ($post->factura->id_dominio_canal == 54) {
            $id_licencia = $post->factura->id_licencia;
        }
        //BUSCAMOS SI EL CLIENTE EXISTE CON LA IDENTIFICACION
        $cliente_busqueda = Tercero::where('identificacion', $post->factura->cliente->identificacion)
            ->where('id_licencia', $id_licencia)
            ->first();
        if ($cliente_busqueda) {
            $cliente = $cliente_busqueda;
        }

        //BUSCAMOS SI EL CLIENTE EXISTE CON EL NUMERO DE TELEFONO
        if ($cliente->id_tercero == null) {
            $cliente_busqueda = Tercero::where('telefono', $post->factura->cliente->telefono)
                ->where('id_licencia', $id_licencia)
                ->where('telefono', '<>', null)
                ->first();
            if ($cliente_busqueda) {
                $cliente = $cliente_busqueda;
            }
        }

        //AHORA VALIDAMOS SI NO ENCONTRO UN CLIENTE IGUAL LO ASIGNAMOS A UN CLIENTE GENERAL DESCONOCIDO
        if ($cliente->id_tercero == null) {
            $iden     = $post->factura->cliente->identificacion ? $post->factura->cliente->identificacion : "000000000";
            $nombre   = $post->factura->cliente->nombre ? $post->factura->cliente->nombre : "Desconocido";
            $telefono = $post->factura->cliente->telefono ? $post->factura->cliente->telefono : null;

            $cliente->nombres                        = $nombre;
            $cliente->id_dominio_tipo_tercero        = 3;
            $cliente->id_dominio_tipo_identificacion = 5;
            $cliente->identificacion                 = $iden;
            $cliente->email                          = "desconocido@gmail.com";
            $cliente->id_dominio_sexo                = 13;
            $cliente->telefono                       = $telefono;
            $cliente->id_licencia                    = $id_licencia;

            //AHORA VERIFICAMOS SI EL USUARIO DESCONOCIDO YA ESTA CREADO PARA LA LICENCIA
            $cliente_busqueda = Tercero::where('identificacion', $iden)
                ->where('id_licencia', $id_licencia)
                ->first();
            if ($cliente_busqueda) {
                $cliente = $cliente_busqueda;
            } else {
                //BUSCAMOS SI EL CLIENTE EXISTE CON EL NUMERO DE TELEFONO
                $cliente_busqueda = Tercero::where('telefono', $telefono)
                    ->where('id_licencia', $id_licencia)
                    ->where('telefono', '<>', null)
                    ->first();
                if ($cliente_busqueda) {
                    $cliente = $cliente_busqueda;
                } else {
                    $cliente->save();
                }
            }
        }

        return $cliente;
    }

    public function descontar_inventario_detalles($detalles, $id_factura)
    {
        foreach ($detalles as $detalle) {
            $detalle  = (object) $detalle;
            $producto = Producto::find($detalle->id_producto);
            //VALIDAMOS SI EL PRODUCTO ESTA HABILITADO PARA DESCONTARSE
            if ($producto->descontado == 1) {
                $producto->descontar($detalle->cantidad);
                $producto->save();
                AuditoriaInventario::write_descuento($id_factura, $producto->id_producto, $detalle->cantidad, session('id_licencia'));
            }

            //VALIDAMOS SI EL PRODUCTO SERA DESCONTADO POR SUS INGREDIENTES
            if ($producto->descontado_ingredientes == 1) {
                foreach ($producto->ingredientes as $item) {
                    $cantidad    = $item->cantidad;
                    $ingrediente = $item->ingrediente;
                    $ingrediente->descontar($cantidad);
                    $ingrediente->save();
                    AuditoriaInventario::write_descuento($id_factura, $ingrediente->id_producto, $cantidad, session('id_licencia'));
                }
            }
        }
    }

    public function ingresar_inventario_detalles($id_factura)
    {
        $factura = Factura::find($id_factura);
        foreach ($factura->detalles as $detalle) {
            $producto = $detalle->producto;
            //VALIDAMOS SI EL PRODUCTO ESTA HABILITADO PARA DESCONTARSE
            if ($producto->descontado == 1) {
                $producto->ingresar($detalle->cantidad);
                $producto->save();
                AuditoriaInventario::write_ingreso($id_factura, $detalle->id_producto, $detalle->cantidad, session('id_licencia'));
            }

            //VALIDAMOS SI EL PRODUCTO ES DESCONTADO POR SUS INGREDIENTES
            if ($producto->descontado_ingredientes == 1) {
                foreach ($producto->ingredientes as $item) {
                    $cantidad    = $item->cantidad;
                    $ingrediente = $item->ingrediente;
                    $ingrediente->ingresar($cantidad);
                    $ingrediente->save();
                    AuditoriaInventario::write_ingreso($id_factura, $ingrediente->id_producto, $cantidad, session('id_licencia'));
                }
            }
        }
    }

    public function anular(Request $request)
    {
        $post    = $request->all();
        $error   = true;
        $mensaje = "";
        if ($post) {
            $post = (object) $post;
            if ($post->motivo != "" and $post->motivo != null) {
                $factura = Factura::find($post->id_factura);
                if ($factura) {
                    $id_usuario = session('id_usuario');
                    $id_perfil  = session('id_perfil');
                    if ($factura->finalizada == 1) {
                        $id_permiso = 1;
                        if (Permiso::validar($id_perfil, $id_permiso)) {
                            //DEVOLVEMOS A UN PRODUCTO LA CANTIDAD VENDIDA
                            $this->ingresar_inventario_detalles($factura->id_factura);
                            $factura->estado           = 0;
                            $factura->id_usuario_anula = $id_usuario;
                            $factura->motivo_anulacion = $post->motivo;
                            $factura->save();
                            $mensaje = "Anulación exitosa";
                            $error   = false;
                            Log::write("Anulacion de factura", "El usuario [$id_usuario] anula factura [$factura->id_factura]");
                        } else {
                            $mensaje = "Usuario sin permisos para realizar esta operación";
                        }
                    } else {
                        $factura->estado           = 0;
                        $factura->id_usuario_anula = $id_usuario;
                        $factura->motivo_anulacion = $post->motivo;
                        $factura->save();
                        $mensaje = "Anulación exitosa";
                        $error   = false;
                        Log::write("Anulacion de factura", "El usuario [$id_usuario] anula factura [$factura->id_factura]");
                    }
                } else {
                    $mensaje = "Factura no valida";
                }
            } else {
                $mensaje = "El motivo de cancelacion es obligatorio";
            }
        } else {
            $mensaje = "No data valid";
        }

        return response()->json([
            'error'   => $error,
            'mensaje' => $mensaje,
        ]);
    }

    public function pedidos_pendientes()
    {
        $pedidos = Factura::where('id_licencia', session('id_licencia'))
            ->where('estado', 1)
            ->where('finalizada', 0)
            ->where('id_dominio_canal', 54)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('factura.pedidos_pendientes', compact(['pedidos']));
    }

    public function pagar_credito(Request $request)
    {
        $post    = $request->all();
        $error   = true;
        $mensaje = "";
        if ($post) {
            $post    = (object) $post;
            $factura = Factura::find($post->id_factura);
            if ($factura) {
                $id_usuario = session('id_usuario');
                $id_perfil  = session('id_perfil');

                //validamos si el usuario tiene caja abierta para facturar
                $caja = Caja::where('id_usuario', $id_usuario)
                    ->where('estado', 1)
                    ->where('fecha_cierre', null)
                    ->first();

                if ($caja) {
                    $facturacion = $this->facturar_pago_credito($factura, $caja->id_caja, $post->forma_pago, $post->observaciones);
                    $mensaje     = $facturacion->mensaje;
                    $error       = $facturacion->error;
                } else {
                    $mensaje = "Para realizar el pago debe tener caja abierta";
                }
            } else {
                $mensaje = "Factura no valida";
            }
        } else {
            $mensaje = "No data valid";
        }

        return response()->json([
            'error'   => $error,
            'mensaje' => $mensaje,
        ]);
    }

    public function facturar_pago_credito($factura_credito, $id_caja, $id_dominio_forma_pago, $observaciones)
    {
        //primero buscamos el consecutivo de la resolucion para la factura
        $id_usuario = session('id_usuario');
        $resolucion = ResolucionFactura::where('id_licencia', session('id_licencia'))->first();
        DB::beginTransaction();
        if ($resolucion) {
            $factura                          = new Factura;
            $factura->numero                  = $resolucion->prefijo_factura . "-" . ($resolucion->consecutivo_factura + 1);
            $factura->id_tercero              = $factura_credito->id_tercero;
            $factura->id_caja                 = $id_caja;
            $factura->valor                   = $factura_credito->valor;
            $factura->id_dominio_tipo_factura = Dominio::get('Factura de venta');
            $factura->observaciones           = $observaciones;
            $factura->id_usuario_registra     = session('id_usuario');
            $factura->id_licencia             = session('id_licencia');
            $factura->id_dominio_canal        = 49;
            $factura->finalizada              = 1;
            $factura->pagada                  = 1;
            $factura->id_factura_cruce        = $factura_credito->id_factura;
            if ($factura->save()) {
                //ahora aumentamos el consecutivo de la resolucion
                $resolucion->consecutivo_factura += 1;
                $resolucion->save();
                //Ahora registramos las formas de pago
                $forma_pago                        = new FormaPago;
                $forma_pago->id_factura            = $factura->id_factura;
                $forma_pago->id_dominio_forma_pago = $id_dominio_forma_pago;
                $forma_pago->valor                 = $factura->valor;
                $forma_pago->save();

                $factura->enviar_email();
                $mensaje = "Pago de credito registrado exitosamente";
                $error   = false;
                Log::write("Pago de credito", "El usuario [$id_usuario] pago credito de factura [$factura_credito->id_factura] generando factura [$factura->id_factura]");
                DB::commit();
            } else {
                DB::rollBack();
                $mensaje = "Error al registrar la factura";
                $errors  = $factura->errors;
            }
        } else {
            DB::rollBack();
            $mensaje = "No tiene resolucion activa";
        }

        return (object) [
            'error'   => $error,
            'mensaje' => $mensaje,
        ];
    }
}
