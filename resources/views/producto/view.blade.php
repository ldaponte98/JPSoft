@extends('layout.main')
@section('menu')
	<div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href='/producto/editar/{{ $producto->id_producto }}'">
                <span class="fab-label">Modificar</span>
                <div class="fab-icon-holder">
                    <i class="ti-pencil"></i>
                </div>
            </li>
            <li onclick="location.href = '/producto/crear'">
                <span class="fab-label"><b>Nuevo</b> producto / servicio / ingrediente</span>
                <div class="fab-icon-holder">
                    <i class="fa fa-laptop"></i>
                </div>
            </li>
        </ul>
    </div>
@endsection
@section('content')
<h4><b>Datos del producto / servicio</b></h4><br>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	    <div class="card">
	        <img class="card-img-top" width="300" height="300" src="{{ $producto->get_imagen() }}" alt="Card image cap">
	        <div class="card-body">
	            <center><h4 class="card-title "><b>{{ strtoupper($producto->nombre) }}</b></h4></center>
	            <center><p class="card-text" style="font-size: 12px;">{{ $producto->descripcion }}</p></center>
	            <hr>
	        </div>

	        <div class="row">
	        	<div class="col-sm-6">
	        		<center>
	        			<h4><b>Precio de venta</b></h4><p>${{ number_format($producto->precio_venta,0,'\'','.') }}</p>
	        		</center>
	        	</div>
	        	<div class="col-sm-6">
	        		<center>
	        			<h4><b>Iva</b></h4><p>%{{ $producto->iva }}</p>
	        		</center>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-sm-6">
	        		<center>
	        			<h4><b>Precio de compra o utilidad</b></h4><p>${{ number_format($producto->precio_compra,0,'\'','.') }}</p>
	        		</center>
	        	</div>
	        	<div class="col-sm-6">
	        		<center>
	        			<h4><b>Presentación</b></h4><p>{{ $producto->presentacion->descripcion }}</p>
	        		</center>
	        	</div>
	        </div>
	        @if($producto->descontado == 1)

	        <div class="row">
	        	<div class="col-sm-6">
	        		<center>
	        			<h5><b>Contenido por producto / servicio</b></h5><p>{{ number_format($producto->contenido,0,'\'','.') }} {{ $producto->presentacion->descripcion }}</p>
	        		</center>
	        	</div>
	        	<div class="col-sm-6">
	        		<center>
	        			<h4><b>Cantidad de alerta</b></h4><p>{{ number_format($producto->cantidad_minimo_alerta,0,'\'','.') }} {{ $producto->presentacion->descripcion }}</p>
	        		</center>
	        	</div>
	        </div>

	        <div class="row">
	        	<div class="col-sm-12">
	        		<center>
	        			<h1><b>{{ number_format($producto->cantidad_actual,0,'\'','.') }}</b></h1>{{ $producto->presentacion->descripcion }}
	        			<h5><b>Cantidad actual</b></h5><br>
	        		</center>
	        	</div>
	        </div>
	        @endif
	    </div>
	</div>
	<div class="col-md-3"></div>
</div>

<div class="row" id="div-ingredientes" @if ($producto->descontado_ingredientes == 0) style="display: none;" @endif>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Ingredientes del producto</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-stats order-table ov-h table-responsive">
                                    <table class="table" id="table-ingredientes">
                                        <thead>
                                            <tr>
                                                <th class="serial"><center><i class="fa fa-laptop"></i></center></th>
                                                <th><center><b>Ingrediente</b></center></th>
                                                <th><center><b>Cantidad</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@if (count($producto->ingredientes) == 0) 
                                        		<tr>
	                                                <td colspan="4"><center><i>No hay ingredientes registrados</i></center></td>
	                                            </tr>
	                                        @else
	                                        	@foreach ($producto->ingredientes as $intersecto)
	                                        	<tr>
	                                        		<td>
	                                        			<center>
	                                        				<img class="rounded-circle" src="{{ $intersecto->ingrediente->get_imagen() }}" width="45" height="45">
	                                        			</center>
	                                        		</td>
					                                <td><center>{{ strtoupper($intersecto->ingrediente->nombre) }}</center></td>
					                                <td><center>{{ $intersecto->cantidad }} {{ $intersecto->ingrediente->presentacion->nombre }}</center></td>
					                            </tr>
	                                        	@endforeach
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
    </div>
</div>
@endsection