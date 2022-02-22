<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Factura extends Model
{
    protected $table      = 'factura';
    protected $primaryKey = 'id_factura';

    protected $fillable = [
        'id_tercero',
        'id_dominio_tipo_factura',
        'numero',
        'valor',
        'id_caja',
    ];

    public function licencia()
    {
        return $this->belongsTo(Licencia::class, 'id_licencia');
    }

    public function tercero()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero');
    }

    public function usuario_registra()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registra');
    }

    public function tipo()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_tipo_factura');
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa');
    }

    public function canal()
    {
        return $this->belongsTo(Dominio::class, 'id_dominio_canal');
    }

    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class, 'id_factura');
    }

    public function formas_pago()
    {
        return $this->hasMany(FormaPago::class, 'id_factura');
    }

    public function get_estado()
    {
        switch ($this->estado) {
            case 1:
                return "Activa";

            case 0:
                return "Anulada";

            default:
                return "Indefinido";
                break;
        }
    }

    public function get_formas_pago()
    {
        $items = [];
        foreach ($this->formas_pago as $item) {
            $items[] = $item->id_dominio_forma_pago;
        }
        return $items;
    }

    public function get_cruce()
    {
        return Factura::where('id_factura_cruce', $this->id_factura)->first();
    }

    public function enviar_email()
    {
        $mensaje = "";
        $error   = true;
        $factura = $this;
        $tercero = Tercero::find($factura->id_tercero);
        //ahora enviamos email con la factura al cliente
        $subject = $factura->tipo->nombre . ' ' . $factura->licencia->nombre;
        $for     = $tercero->email;

        $data_email = array(
            'factura'         => $factura,
            'imagen_licencia' => $factura->licencia->get_imagen_email(),
            'tipo_factura'    => $factura->tipo->nombre,
            'id_factura'      => $factura->id_factura,
        );
        if ($for) {
            try {
                Mail::send('email.factura', $data_email, function ($msj) use ($subject, $for) {
                    $msj->from(config('global.email_zorax'), session('nombre_licencia'));
                    $msj->subject($subject);
                    $msj->to($for);
                });
                $error   = false;
                $mensaje = "OK";
            } catch (Exception $e) {
                $mensaje = "Error en envio email: " . $e->getMessage();
            }
            Log::write("Envio email de factura", "Envio de email para factura [$factura->id_factura] con respuesta [$mensaje]");
        }
        return $error;
    }
}
