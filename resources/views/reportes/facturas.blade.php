@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="exportar_excel()">
                <span class="fab-label">Exportar a excel</span>
                <div class="fab-icon-holder">
                    <i class="ti-agenda"></i>
                </div>
            </li>
        </ul>
    </div>
@endsection
@section('content')
<style>
    .chosen-container{
        width: 83% !important;
    }
    .chosen-container-multi .chosen-choices {
        padding: .3rem .75rem;
        border-radius: .25rem;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7s-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text">${{ number_format($total_ventas_fecha, 0, '.', '.') }}</div>
                            <div class="stat-heading">@if($fechas=="") Ventas de hoy @else Total ventas @endif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">{{ $total_facturas_ventas }}</span></div>
                            <div class="stat-heading">Facturas de venta</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="pe-7s-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text">${{ number_format($total_egresos, 0, '.', '.') }}</div>
                            <div class="stat-heading">Egresos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9" style="padding-top: 7px;">
                        <strong>Reporte de facturas</strong>
                    </div>
                    <div class="col-sm-3" style="text-align: right !important;">
                        <input id="filtro" type="text" class="form-control" placeholder="Consulte aqui..." autocomplete="on">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        {{ Form::open(array('method' => 'post')) }}
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="fechas">Fechas</label>
                                </div>
                                    <input required name="fechas" id="fechas" type="text" class="form-control" placeholder="Lapso de tiempo de la factura" autocomplete="off" value="{{ $fechas }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3 " style="display: -webkit-inline-box;">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="canales">Canales</label>
                                </div>

                                @php
                                    $_canales = \App\Dominio::get_canales(session('id_licencia'));
                                @endphp
                                    <select id="canales" name="canales[]" data-placeholder="Todos los canales" multiple class="standardSelect form-control">
                                        <option value="" label="default"></option>
                                        @foreach($_canales as $item)
                                            <option @if(in_array($item->id_dominio, $canales)) selected @endif 
                                                value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Consultar</button>
                            </div>                            
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-12">
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
                                                @if ($permiso_anular)
                                                    <a onclick="ModalAnulacion({{ $factura->id_factura }})" class="badge badge-danger text-white pointer" > <i class="ti-close icon" title="Anular factura"></i></a>
                                                @endif
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
        </div> <!-- .card -->
    </div>
</div>

<table border="1" id="tabla_excel" style="display: none">
    <tr>
        <td colspan='9' rowspan='2'>
            <center>
                <b>REPORTE DE FACTURAS</b>
            </center>
        </td>
    </tr>
    <tr></tr>
     @if($fechas != "")
        <tr>
            <td colspan='9'><center><b>Fechas: </b>{{ $fechas }}</center></td>            
        </tr>
    @endif
    
    <tr>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Numero</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Cliente</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Fecha</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Tipo</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Canal</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Cantidad de productos</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Usu registro</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Estado</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Valor</b></td>
        
    </tr>
    <tbody id="bodytable_excel">
        @php
            $total = 0;
        @endphp
            @foreach($facturas as $factura)
             <tr>
                <td>{{ $factura->numero }}</td>
                <td>{{ $factura->tercero->nombre_completo() }}</td>
                <td>{{ date('Y-m-d H:i' ,strtotime($factura->fecha)) }} </td>
                <td>{{ $factura->tipo->nombre }} </td>
                <td>{{ $factura->canal->nombre }} </td>
                <td>{{ count($factura->detalles) }} </td>
                <td>{{ $factura->usuario_registra->tercero->nombre_completo() }} </td>
                <td><center>{{ $factura->get_estado() }}</center></td>
                <td>{{ $factura->valor }}</td>
                
            </tr>
            @php
            if($factura->id_dominio_tipo_factura == 16){
                $total += $factura->valor;
            }
            @endphp
            @endforeach
            <tr>
                <td colspan="8"><b>Total</b></td>
                <td colspan="1" style="text-align: right;"><b>{{ $total }}</b></td>
            </tr>
    </tbody>    
</table>

@if ($permiso_anular)
    <div class="modal fade" id="modal-anulacion" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Cancelación de pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>*Motivo</label>
                        <textarea rows="3" id="modal-motivo-anulacion" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="Anular()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endif


<script type="text/javascript">
    var id_factura = null;
    function exportar_excel() {
        tableToExcel('tabla_excel', 'Informe Facturas Zorax')
    }
    $(document).ready(function() {
        $('#fechas').daterangepicker({
            timePicker: true,
            timePicker24Hour : true,
            autoApply: true,
            autoUpdateInput: true,
            locale: {
                format: 'YYYY/MM/DD HH:mm',
                cancelLabel: 'Limpiar',
                applyLabel: 'Establecer'
            }
        });
        $('#fechas').val('{{ $fechas }}');

        $('#fechas').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD HH:mm') + ' - ' + picker.endDate.format('YYYY/MM/DD HH:mm'));
        });

        $('#fechas').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    })

@if ($permiso_anular)
    function ModalAnulacion(id_factura) {
        this.id_factura = id_factura; 
        $('#modal-anulacion').modal('show');
    }
    function Anular() {
        let motivo = $("#modal-motivo-anulacion").val()
        if (motivo.trim() == "") {
            toastr.error("Es necesario que suministre el motivo de la anulacion de la factura", "Error")
            return;
        }
        $("#modal-anulacion").modal("hide")

        let url = "{{ route('factura/anular') }}"
        Loading(true, "Anulando factura...")
        var _token = ""
        $("[name='_token']").each(function() { _token = this.value })
        let request = {
            '_token' : _token,
            'id_factura' : id_factura,
            'motivo' : motivo
        }
        $.post(url, request, (response) => {
            if (!response.error) {
                this.id_factura = null;
                toastr.success("Factura anulada exitosamente", "Proceso exitoso")
                location.reload()
            }else{
                Loading(false)
                toastr.error(response.mensaje, "Error")
            }
        })
        .fail((error) => {
            
            console.log(error)
            toastr.error("Ha ocurrido un error, por favor intentelo nuevamente", "Error")
        })           
    }
@endif
</script>
@endsection