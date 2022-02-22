<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Producto extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_producto',
        'nombre',
        'id_dominio_tipo_producto',
        'descripcion',
        'cantidad_minimo_alerta',
        'alerta',
        'cantidad_actual',
        'contenido',
        'descontado',
        'precio_compra',
        'precio_venta',
        'iva',
        'imagen',
        'id_dominio_presentacion',
        'estado',
        'id_usuario_registra',
        'id_licencia',
    ];

    public function licencia()
    {
        return $this->belongsTo(Licencia::class, 'id_licencia');
    }
    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo_producto');
    }
    public function presentacion()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_presentacion');
    }
    public function ingredientes()
    {
        return $this->hasMany(ProductoIngrediente::class, 'id_producto');
    }

    public function get_ingredientes()
    {
        $items = [];
        foreach ($this->ingredientes as $item) {
            $items[] = $item->ingrediente;
        }
        return $items;
    }

    public function get_imagen()
    {
        if ($this->imagen != null and $this->imagen != '') {
            return asset('imagenes/producto/' . $this->imagen);
        } else {
            return asset('plantilla/images/app/sinimagen.jpg');
        }
    }

    public function get_estado()
    {
        switch ($this->estado) {
            case 1:
                return "Activo";

            case 0:
                return "Inactivo";

            default:
                return "Indefinido";
                break;
        }
    }

    public function producto_categoria()
    {
        return $this->hasMany(ProductoCategoria::class, 'id_producto');
    }

    public function categorias()
    {
        $categorias = [];
        foreach ($this->producto_categoria as $item) {
            $categorias[] = $item->categoria;
        }
        return $categorias;
    }

    public function get_id_categorias()
    {
        $ids = [];
        foreach ($this->categorias() as $item) {
            $ids[] = $item->id_categoria;
        }
        return $ids;
    }

    public function descontar($cantidad = 1)
    {
        $this->cantidad_actual = $this->cantidad_actual - $cantidad;
        if ($this->alerta == 1) {
            if ($this->cantidad_actual <= $this->cantidad_minimo_alerta) {
                $this->notificar_alerta_inventario();
            }
        }
    }

    public function ingresar($cantidad = 1)
    {
        $this->cantidad_actual = $this->cantidad_actual + $cantidad;
        if ($this->alerta == 1) {
            if ($this->cantidad_actual <= $this->cantidad_minimo_alerta) {
                $this->notificar_alerta_inventario();
            }
        }
    }

    public function notificar_alerta_inventario()
    {
        $subject = "Zorax - Aviso de inventario";

        $emails = explode(",", $this->licencia->emails_reportes);

        foreach ($emails as $email) {
            $for  = str_replace(" ", "", $email);
            $data = array(
                'producto' => $this,
            );
            try {
                Mail::send('email.alerta_inventario', $data, function ($msj) use ($subject, $for) {
                    $msj->from(config('global.email_zorax'), "Zorax - Sistema de ventas");
                    $msj->subject($subject);
                    $msj->to($for);
                });
                $mensaje = "Envio exitoso";
            } catch (Exception $e) {
                $mensaje = "Error al enviar notificacion de inventario: " . $e->getMessage();
            }

            Log::write("Envio email de aviso de inventario", "Se envia email a [$for] con respuesta [$mensaje]");
        }
    }
}
