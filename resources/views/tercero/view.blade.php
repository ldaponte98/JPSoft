@extends('layout.main')
@section('menu')
	<div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href='/factura/crear?tipo=16&id_tercero={{ $tercero->id_tercero }}'">
                <span class="fab-label">Facturar</span>
                <div class="fab-icon-holder">
                    <i class="ti-money"></i>
                </div>
            </li>
            <li onclick="location.href='/factura/crear?tipo=17&id_tercero={{ $tercero->id_tercero }}'">
                <span class="fab-label">Cotizar</span>
                <div class="fab-icon-holder">
                    <i class="ti-shopping-cart"></i>
                </div>
            </li>
            <li onclick="location.href='/tercero/editar/{{ $tercero->id_tercero }}'">
                <span class="fab-label">Modificar</span>
                <div class="fab-icon-holder">
                    <i class="ti-pencil"></i>
                </div>
            </li>
        </ul>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- Credit Card -->
                                <div id="pay-invoice">

                                    <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">

                                                    	<h4><b>Datos personales</b></h4><br>
                                                    	<center>
                                                        	<img src="@if($tercero->imagen == null or $tercero->imagen == '') {{ asset('plantilla/images/app/user.jpg') }} @else {{ asset('imagenes/tercero/'.$tercero->imagen) }} @endif" id="img_imagen" alt="image" class="rounded-circle" width="200" height="200">
                                                        	<br>
                                                        	<strong class="card-title span_tipo"><b>{{ $tercero->tipo->nombre }}</b></strong>
                                                    	</center>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Nombres: </b>{{ $tercero->nombres }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Apellidos: </b>{{ $tercero->apellidos }}</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="row">
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Tipo de identificación: </b>{{ $tercero->tipo_identificacion->nombre }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Identificación: </b>{{ $tercero->identificacion }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Correo electrónico: </b>{{ $tercero->email }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Genero: </b>{{ $tercero->sexo->nombre }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Tipo tercero: </b>{{ $tercero->tipo->nombre }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label class="control-label mb-1"><b>Estado: </b>{{ $tercero->get_estado() }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Telefono: </b>{{ $tercero->telefono }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                             <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1"><b>Dirección: </b>{{ $tercero->direccion }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    	<div class="col-sm-6">
                                                    	<div class="card text-white bg-flat-color-1">
								                            <div class="card-body">
								                                <div class="card-left pt-1 float-left">
								                                    <h3 class="mb-0 fw-r">
								                                        <span class="currency float-left mr-1">$</span>
								                                        <span class="count">{{ $tercero->get_total_compras() }}</span>
								                                    </h3>
								                                    <p class="text-light mt-1 m-0">Total de compras</p>
								                                </div><!-- /.card-left -->

								                                <div class="card-right float-right text-right">
								                                    <i class="icon fade-5 icon-lg pe-7s-cart"></i>
								                                </div><!-- /.card-right -->
								                            </div>
								                        </div>
								                        </div>
                                                    	<div class="col-sm-6">
                                                    		<div class="card text-white bg-flat-color-3">
									                            <div class="card-body">
									                                <div class="card-left pt-1 float-left">
									                                    <h3 class="mb-0 fw-r">
									                                        <span class="count">{{ $tercero->get_total_productos_adquiridos() }}</span>
									                                    </h3>
									                                    <p class="text-light mt-1 m-0">Productos adquiridos</p>
									                                </div><!-- /.card-left -->

									                                <div class="card-right float-right text-right">
									                                    <i class="icon fade-5 icon-lg pe-7s-portfolio"></i>
									                                </div><!-- /.card-right -->

									                            </div>

									                        </div>
                                                    	</div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="custom-tab">
		                                        <nav>
		                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
		                                                <a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Facturas</a>
		                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cotizaciones</a>
		                                            </div>
		                                        </nav>
		                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
		                                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        {{ view('tercero.lista_facturas',compact('tercero')) }}
		                                            </div>
		                                            
		                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		                                                {{ view('tercero.lista_cotizaciones',compact('tercero')) }}
		                                            </div>
                                                    <!--
		                                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
		                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
		                                            </div>
		                                        	-->
		                                        </div>

		                                    </div>
		                                    <br><br>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                        
        </div>
</div>
@endsection