@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <center>
            @if ($caja->fecha_cierre == null and $caja->id_usuario == session('id_usuario'))
                <button class="btn btn-primary" onclick="CerrarCaja()">Cerrar caja</button>
                <a href="{{ route('caja/documento/nuevo') }}" class="btn btn-primary">Crear documento</a>
            @endif
            <button class="btn btn-primary" onclick="VerDetalles()">Ver detalles</button>
        </center>
    </div>
</div><br>
<div class="row" id="div-detalles" style="display: none;">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <center>
                    <strong>Detalle de facturas caja #{{ $caja->id_caja }}</strong><br>
                    <label>{{ $caja->usuario->tercero->nombre_completo() }} - {{ $caja->fecha_apertura }}</label>
                </center>
            </div>
            @php
                $facturas = \App\Factura::where('estado', 1)
                                        ->where('id_caja', $caja->id_caja)
                                        ->orderBy('created_at')
                                        ->get();
            @endphp                     
            <div class="card-body">
                <div class="table-stats order-table ov-h">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="serial"><center><b>#</b></center></th>
                                <th><center><b>Numero</b></center></th>
                                <th><center><b>Cliente</b></center></th>
                                <th><center><b>Fecha</b></center></th>
                                <th><center><b>Tipo</b></center></th>
                                <th><center><b>Canal</b></center></th>
                                <th><center><b>Usu registro</b></center></th>
                                <th><center><b>Valor</b></center></th>
                                <th><center><b>Estado</b></center></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="bodytable">
                            @php $cont = 1; @endphp
                            @foreach($facturas as $factura)
                            <tr>
                                <td class="serial"><center>{{ $cont }}</center></td>
                                <td><center>{{ $factura->numero }}</center></td>
                                <td><center><a href="{{ route('tercero/view', $factura->id_tercero) }}">{{ $factura->tercero->nombre_completo() }}</a></center></td>
                                <td><center> {{ date('Y-m-d H:i' ,strtotime($factura->fecha)) }} </center></td>
                                <td><center> {{ $factura->tipo->nombre }} </center></td>
                                <td><center>{{ $factura->canal->nombre }} </center></td>
                                <td><center> {{ $factura->usuario_registra->tercero->nombre_completo() }} </center></td>
                                <td><center>${{ number_format($factura->valor, 0, '.', '.') }}</center></td>
                                <td><center>
                                    @if ($factura->estado == 1)
                                        <span class="badge badge-success">
                                            <b>{{ $factura->get_estado() }}</b>
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <b style="cursor: pointer;" title="{{ $factura->motivo_anulacion }}">{{ $factura->get_estado() }}</b>
                                        </span>
                                    @endif
                                    
                                </center></td>
                                <td>
                                    <center>
                                        <a href="{{ route('factura/imprimir', $factura->id_factura) }}" class="badge badge-info" target="_blank"> <i class="ti-printer icon" title="Imprimir factura formal"></i></a>
                                            
                                        <a href="{{ route('ticket/imprimir/factura', $factura->id_factura) }}" class="badge badge-info" target="_blank"> <i class="ti-ticket icon" title="Imprimir factura ticket"></i></a>
                                    </center>
                                </td>
                            </tr>
                            @php $cont++; @endphp
                            @endforeach

                            @if (count($facturas) == 0)
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            <br>
                                            <i>No hay registros para esta consulta</i>
                                            <br>
                                        </center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <center>
                    <strong>Detalle caja #{{ $caja->id_caja }}</strong><br>
                    <label>{{ $caja->usuario->tercero->nombre_completo() }} - <b>{{ $caja->fecha_apertura }} {{ $caja->fecha_cierre ? "- ".$caja->fecha_cierre : "" }}</b></label>
                </center>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4><span class="green"><b>+</b></span> <b>Valor Inicial</b></h4>
                    </div>
                    <div class="col-sm-6 text-right" >
                        <h4>${{ number_format($caja->valor_inicial, 0, '.', '.') }}</h4>
                    </div>
                </div>
                <hr>
                <h3><b>Canales de atención</b></h3>
                <hr>
                @foreach ($canales as $canal)
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><span class="green"><b>+</b></span> <b>{{ $canal->nombre }}</b></h4>
                        </div>
                        <div class="col-sm-6 text-right" >
                            <h4>${{ number_format($caja->total_por_canal($canal->id_dominio), 0, '.', '.') }}</h4>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <h3><b>Formas de pago</b></h3>
                <hr>
                @foreach ($formas_pago as $forma_pago)
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><span class="green"><b>+</b></span> <b>{{ $forma_pago->nombre }}</b></h4>
                        </div>
                        <div class="col-sm-6 text-right" >
                            <h4>${{ number_format($caja->total_por_forma_pago($forma_pago->id_dominio), 0, '.', '.') }}</h4>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row">
                    <div class="col-sm-6">
                        <h4><span class="red"><b>-</b></span> <b>Descuentos</b></h4>
                    </div>
                    <div class="col-sm-6 text-right" >
                        <h4>${{ number_format($caja->get_descuentos(), 0, '.', '.') }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h4><span class="red"><b>-</b></span> <b>Egresos</b></h4>
                    </div>
                    <div class="col-sm-6 text-right" >
                        <h4>${{ number_format($caja->get_egresos(), 0, '.', '.') }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h4><b>Total</b></h4>
                    </div>
                    <div class="col-sm-6 text-right" >
                        <h4><b>${{ number_format($caja->get_total(), 0, '.', '.') }}</b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function VerDetalles() {
        if ($("#div-detalles").css("display") == "none") {
            $("#div-detalles").fadeIn()
        }else{
            $("#div-detalles").fadeOut()
        }
    }

    function CerrarCaja() {
        let confirmacion = confirm('¿Seguro que desea cerrar esta caja?')
        if (confirmacion) {
            Loading(true, "Cerrando caja...")
            let url = "{{ route('caja/cerrar', $caja->id_caja) }}"
            $.get(url, (response) => {
                Loading(false)
                if (response.error == false) {
                    toastr.success(response.mensaje)
                    setTimeout(function() { location.reload() }, 1000);
                }else{
                    toastr.error(response.mensaje, "Error")
                }
            })
            .fail((error) => {
                Loading(false)
                toastr.error("Ocurrio un error", "Error");
            })
        }
    }
</script>
@endsection