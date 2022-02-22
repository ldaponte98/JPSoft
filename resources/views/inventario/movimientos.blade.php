@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/inventario/crear'">
                <span class="fab-label">Nuevo movimiento de inventario</span>
                <div class="fab-icon-holder">
                    <i class="ti-plus"></i>
                </div>
            </li>
        </ul>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9" style="padding-top: 7px;">
                        <strong class="card-title">Administrar movimientos de inventario</strong>
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
                                    <input required name="fechas" id="fechas" type="text" class="form-control" placeholder="Escoja un rango de tiempo de consulta" autocomplete="off" value="{{ $fechas }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Consultar</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div><br><br>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-stats order-table ov-h table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial"><center><i class="fa fa-user"></i></center></th>
                                            <th><center><b>Movimiento</b></center></th>
                                            <th><center><b>Fecha</b></center></th>
                                            <th><center><b>Hora</b></center></th>
                                            <th><center><b>Factura</b></center></th>
                                            <th><center><b>Usuario</b></center></th>
                                            <th><center><b>Estado</b></center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytable">
                                        @php $cont = 1; @endphp
                                        @foreach($inventarios as $item)
                                        <tr>
                                            <td><center><img class="rounded-circle" src="{{ $item->usuario_registra->tercero->get_imagen() }}" width="45" height="45" alt="tercero"></center></td>
                                            <td><center>{{ $item->tipo_movimiento->nombre }}</center></td>
                                            <td><center>{{ date('d/m/Y', strtotime($item->created_at)) }}</center></td>
                                            <td><center>{{ date('H:i', strtotime($item->created_at)) }}</center></td>
                                            <td><center>
                                                @if ($item->id_factura)
                                                    <a target="_blank" href="{{ route('factura/imprimir', $item->id_factura) }}">{{ $item->factura->numero }}</a>
                                                @else
                                                    No registra
                                                @endif
                                            </center></td>
                                            <td><center>{{ $item->usuario_registra->tercero->nombre_completo() }}</center></td>
                                            <td><center>{{ $item->estado == 1 ? "Activa" : "Anulada" }}</center></td>
                                            <td>
                                                <center>
                                                    <a href="{{ route('inventario/vista', $item->id_inventario) }}">Ver</a>
                                                </center>
                                            </td>
                                        </tr>
                                        @php $cont++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function exportar_excel() {
        tableToExcel('tabla_excel', 'Reporte_de_facturas')
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
          

        $('#fechas').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD HH:mm') + ' - ' + picker.endDate.format('YYYY/MM/DD HH:mm'));
        });

        $('#fechas').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        
    })
</script>
@endsection