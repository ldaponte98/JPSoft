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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9" style="padding-top: 7px;">
                        <strong>Reporte de caja</strong>
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
                                    <input required name="fechas" id="fechas" type="text" class="form-control" placeholder="Lapso de tiempo de la caja" autocomplete="off" value="{{ $fechas }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3 " style="display: -webkit-inline-box;">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="usuarios">Usuario</label>
                                </div>
                                @php
                                    $_usuarios = \App\Licencia::get_usuarios(session('id_licencia'));
                                @endphp
                                    <select id="usuarios" name="usuarios[]" data-placeholder="Todos los usuarios" multiple class="standardSelect form-control">
                                        <option value="" label="default"></option>
                                        @foreach($_usuarios as $item)
                                        
                                            <option @if(in_array($item->id_usuario, $usuarios)) selected @endif 
                                                value="{{ $item->id_usuario }}">{{ $item->tercero->nombre_completo() }}</option>
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
                                        <th><center><b>Usuario</b></center></th>
                                        <th><center><b>Fecha de apertura</b></center></th>
                                        <th><center><b>Fecha de cierre</b></center></th>
                                        <th><center><b>Valor inicial</b></center></th>
                                        @foreach ($formas_pago as $item)
                                        	<th><center><b>{{ $item->nombre }}</b></center></th>
                                        @endforeach
                                        <th><center><b>Descuentos</b></center></th>
                                        <th><center><b>Egresos</b></center></th>
                                        <th><center><b>Total</b></center></th>
                                        <th><center><b>Acciones</b></center></th>
                                    </tr>
                                </thead>
                                <tbody id="bodytable">
                                    @php 
                                    	$cont = 1; 
                                    	$total_formas_pago = [];
                                    	foreach ($formas_pago as $item) {
                                    		$total_formas_pago[$item->id_dominio] = 0;
                                    	}
                                    	$total_cajas = 0;
                                    	$total_valores_iniciales = 0;
                                        $total_descuentos = 0;
                                        $total_egresos = 0;
                                    @endphp
                                    @foreach($cajas as $caja)
                                    <tr>
                                        <td class="serial"><center>{{ $cont }}</center></td>
                                        <td><center>{{ $caja->usuario->tercero->nombre_completo() }}</center></td>
                                        <td><center>{{ $caja->fecha_apertura }}</center></td>
                                        <td><center>{{ $caja->fecha_cierre ? $caja->fecha_cierre : "Indefinida" }}</center></td>
                                        <td style="text-align: right;"> 
                                        	${{ number_format($caja->valor_inicial, 0, '.', '.') }} 
                                        </td>

                                        @foreach ($formas_pago as $item)
                                        	@php
                                        		$valor = $caja->total_por_forma_pago($item->id_dominio);
                                        	@endphp
                                        	<td style="text-align: right;">
                                        		${{ number_format($valor, 0, '.', '.') }}
                                        	</td>
                                        	@php
                                        		$total_formas_pago[$item->id_dominio] += $valor;
                                        	@endphp
                                        @endforeach

                                        <td style="text-align: right;">
                                        	${{ number_format($caja->get_descuentos(), 0, '.', '.') }}
                                        </td>
                                        <td style="text-align: right;">
                                            ${{ number_format($caja->get_egresos(), 0, '.', '.') }}
                                        </td>
                                        <td style="text-align: right;">
                                        	${{ number_format($caja->get_total(), 0, '.', '.') }}
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ route('caja/view', $caja->id_caja) }}" class="badge badge-info" target="_blank"> <i class="ti-search icon" title="IVer detalles caja"></i></a>
                                            </center>
                                        </td>

                                        @php
                                    		$total_cajas += $caja->get_total();
                                    		$total_valores_iniciales += $caja->valor_inicial;
                                            $total_descuentos += $caja->get_descuentos();
                                            $total_egresos += $caja->get_egresos();
                                    	@endphp
                                    </tr>
                                    @php $cont++; @endphp
                                    @endforeach

                                    @if (count($cajas) == 0)
                                        <tr>
                                            <td colspan="{{ 8 + count($formas_pago) }}">
                                                <center>
                                                    <br>
                                                    <i>No hay registros para esta consulta</i>
                                                    <br>
                                                </center>
                                            </td>
                                        </tr>
                                        @else
                                        <tr style="background: #e8e9ef;">
                                        	<td colspan="5"><b>Totales</b></td>
                                        	@foreach ($total_formas_pago as $key => $value)
	                                        	<td style="text-align: right;">
	                                        		<b>${{ number_format($value, 0, '.', '.') }}</b>
	                                        	</td>
	                                        @endforeach
	                                        <td style="text-align: right;">
                                        		<b>${{ number_format($total_descuentos, 0, '.', '.') }}</b>
                                        	</td>
                                             <td style="text-align: right;">
                                                <b>${{ number_format($total_egresos, 0, '.', '.') }}</b>
                                            </td>
                                        	<td style="text-align: right;">
                                        		<b>${{ number_format($total_cajas, 0, '.', '.') }}</b>
                                        	</td>
                                        	<td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<table border="1" id="tabla_excel" style="display: none">
    <tr>
        <td colspan='{{ 6 + count($formas_pago) }}' rowspan='2'>
            <center>
                <b>REPORTE DE CAJA</b>
            </center>
        </td>
    </tr>
    <tr></tr>
     @if($fechas != "")
        <tr>
            <td colspan='{{ 6 + count($formas_pago) }}'><center><b>Fechas: </b>{{ $fechas }}</center></td>            
        </tr>
    @endif
    
    <tr>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Usuario</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Fecha de apertura</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Fecha de cierre</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Valor inicial</b></td>
        @foreach ($formas_pago as $item)
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>{{ $item->nombre }}</b></td>
        @endforeach
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Descuentos</b></td>
        <td style="background-color: #094d96; color: #ffffff; width: 200px;"><b>Total</b></td>
        
    </tr>
    <tbody id="bodytable_excel">
        @php
            $total = 0;
        @endphp
            @foreach($cajas as $caja)
             <tr>
                <td>{{ $caja->usuario->tercero->nombre_completo() }}</td>
                <td>{{ $caja->fecha_apertura }}</td>
                <td>{{ $caja->fecha_cierre ? $caja->fecha_cierre : "Indefinida" }}</td>
                <td>{{ $caja->valor_inicial }}</td>
                
                @foreach ($formas_pago as $item)
                	<td>{{ $caja->total_por_forma_pago($item->id_dominio) }}</td>
                @endforeach
                <td>{{ $caja->get_descuentos() }}</td>
                <td>{{ $caja->get_total() }}</td>
            </tr>
            @endforeach

            <tr >
                <td style="background: #e8e9ef;" colspan="4"><b>Totales</b></td>
            	@foreach ($total_formas_pago as $key => $value)
                	<td style="text-align: right; background: #e8e9ef;">{{ $value }}</td>
                @endforeach
                <td style="text-align: right; background: #e8e9ef;">{{ $total_descuentos}}</td>
            	<td style="text-align: right; background: #e8e9ef;">{{ $total_cajas }}</td>
            </tr>
    </tbody>    
</table>

<script>
	function exportar_excel() {
        tableToExcel('tabla_excel', 'Reporte de caja Zorax')
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