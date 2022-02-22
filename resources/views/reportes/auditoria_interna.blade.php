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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9" style="padding-top: 7px;">
                        <strong>Informe de Auditoria Interna de inventario</strong>
                    </div>
                    <div class="col-sm-3" style="text-align: right !important;">
                        <input id="filtro" type="text" class="form-control" placeholder="Consulte aqui..." autocomplete="on">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <i>Este informe permite ver los movimientos internos que el sistema realiza con los productos asociados al inventario, tanto descuentos como ingresos nuevamente en caso de anulaciones. </i>
                <br><br>
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
                                    <label class="input-group-text" for="canales">Productos</label>
                                </div>
                                <select id="productos" name="productos[]" data-placeholder="Todos los productos" multiple class="standardSelect form-control">
                                    <option value="" label="default"></option>
                                    @foreach($_productos as $item)
                                        <option @if(in_array($item->id_producto, $productos)) selected @endif 
                                            value="{{ $item->id_producto }}">{{ $item->nombre }}</option>
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
                                        <th><center><b>Imagen</b></center></th>
                                        <th><center><b>Producto</b></center></th>
                                        <th><center><b>Cantidad</b></center></th>
                                        <th><center><b>Presentación</b></center></th>
                                        <th><center><b>Factura Asociada</b></center></th>
                                        <th><center><b>Fecha</b></center></th>
                                        <th><center><b>Movimiento</b></center></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="bodytable">
                                    @php $cont = 1; @endphp
                                    @foreach($auditorias as $item)
                                    <tr>
                                        <td class="serial"><center>{{ $cont }}</center></td>
                                        <td>
                                            <center>
                                                <img class="rounded-circle" src="{{ $item->producto->get_imagen() }}" width="45" height="45" alt="tercero">
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ route('producto/view', $item->id_producto) }}" target="_blank"> 
                                                    {{ $item->producto->nombre }} 
                                                </a>
                                            </center>
                                        </td>
                                        <td><center>{{ $item->cantidad }}</center></td>
                                        <td><center>{{ $item->producto->presentacion->descripcion }}</center></td>
                                        <td>
                                            <center>
                                                <a href="{{ route('ticket/imprimir/factura', $item->id_factura) }}" target="_blank"> 
                                                    {{ $item->factura->numero }} 
                                                </a>
                                            </center>
                                        </td>
                                        <td><center>{{date('Y-m-d H:i' ,strtotime($item->created_at))}}</center></td>
                                        <td>
                                            <center>
                                            @if ($item->id_dominio_tipo_movimiento == 52)
                                                <span class="badge badge-danger"><b>Ingreso</b></span>
                                            @else
                                                <span class="badge badge-success"><b>Descuento</b></span>
                                            @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @php $cont++; @endphp
                                    @endforeach

                                    @if (count($auditorias) == 0)
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
        <td colspan='6' rowspan='2'>
            <center>
                <b>INFORME DE AUDITORIA INTERNA INVENTARIO</b>
            </center>
        </td>
    </tr>
    <tr></tr>
     @if($fechas != "")
        <tr>
            <td colspan='6'><center><b>Fechas: </b>{{ $fechas }}</center></td>            
        </tr>
    @endif
    
    <tr>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Producto</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Cantidad</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Presentacion</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Factura Asociada</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Fecha</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Movimiento</b></td>
    </tr>
    <tbody id="bodytable_excel">
        @php
            $total = 0;
        @endphp
            @foreach($auditorias as $item)
             <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->producto->presentacion->descripcion }} </td>
                <td>{{ $item->factura->numero }} </td>
                <td>{{ date('Y-m-d H:i' ,strtotime($item->created_at)) }} </td>
                <td>{{ $item->id_dominio_tipo_movimiento == 52 ? "Ingreso" : "Descuento" }}</td>
            </tr>
            @endforeach
    </tbody>    
</table>



<script type="text/javascript">
    function exportar_excel() {
        tableToExcel('tabla_excel', 'Informe Auditoria Inventario Zorax')
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
</script>
@endsection