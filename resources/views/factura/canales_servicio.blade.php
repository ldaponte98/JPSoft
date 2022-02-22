@php
    $licencia = \App\Licencia::find(session('id_licencia'));
@endphp
@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ route('factura/facturador') }}'">
                <span class="fab-label">Nueva Venta Rapida</span>
                <div class="fab-icon-holder">
                    <i class="ti-shopping-cart-full"></i>
                </div>
            </li> 

            @foreach ($canales as $canal)
                @if ($canal->id_dominio != App\Dominio::get('Mesa'))
                    <li onclick="location.href = '{{ route('factura/facturador') }}?canal={{ $canal->id_dominio }}'">
                        <span class="fab-label">Nueva pedido por {{ $canal->nombre }}</span>
                        <div class="fab-icon-holder">
                            <i class="ti-shopping-cart-full"></i>
                        </div>
                    </li>
                @endif
            @endforeach           
        </ul>
    </div>
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('scroll-tabs/jquery.scrolling-tabs.css') }}" />
<link rel="stylesheet" href="{{ asset('scroll-tabs/st-demo.css') }}" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
	.d-flex{
		align-items: center;
	}
    .hide{
        display: none !important;
    }
	.lb-flex{
		width: 100%;
		margin-bottom: 0px;
	}
	.green{
		color: #28a745;
	}
	.red{
		color: #dc3545;
	}
	.card-items{
		min-height: 810px;
	}
    .box-quantity{
        box-shadow: 0 0 20px rgb(0 0 0 / 8%);
        border: 0;
        padding: 10px;
        border-radius: 5px;
    }
    .search{
        padding: .75rem .95rem;
        height: auto;
        border: none;
        border-radius: 30px;
        box-shadow: 0 0 20px rgb(0 0 0 / 8%);
    }
    .dropdown-search{
        width: 100%;
        box-shadow: 0 0 20px rgb(0 0 0 / 8%);
        border-radius: 5px;
    }
    .btn-erase{
        background: transparent;
        margin-bottom: 7px;
    }
    .chosen-container{
        width: 107% !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-items">
            <div class="card-header">
                <i class="fa fa-cutlery"></i><strong class="card-title pl-2">Canales de servicio</strong>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @php $cont = 0; @endphp
                    @foreach ($canales as $item)
                        <li class="nav-item">
                            <a class="nav-link {{ $cont == 0 ? "active" : "" }}" 
                               id="nav-canal-{{ $item->id_dominio }}-tab" 
                               data-toggle="pill" 
                               href="#nav-canal-{{ $item->id_dominio }}" 
                               role="tab" 
                               aria-controls="nav-canal-{{ $item->id_dominio }}" 
                               aria-selected="true">{{ $item->nombre }}</a>
                        </li>
                        @php $cont++; @endphp
                    @endforeach
                </ul>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                    @php $cont = 0; @endphp
                    @foreach ($canales as $item)
                        <div class="tab-pane fade {{ $cont == 0 ? "show active" : "" }}" 
                             id="nav-canal-{{ $item->id_dominio }}" 
                             role="tabpanel" 
                             aria-labelledby="nav-canal-{{ $item->id_dominio }}-tab">

                             <div class="row">
                                 <div class="col-sm-12">
                                    <b><i>Ultima actualización: {{ date('Y-m-d H:i') }}</i></b> <span class="badge badge-primary ml-1"> <a href="" title="Refrescar tiempos" class="ti-reload text-white"></a> </span>
                                 </div>
                             </div><br>
                            <div class="row">
                                @if ($item->id_dominio == App\Dominio::get('Mesa'))
                                    <!-- PANEL TABLES -->
                                    @if (count($mesas) > 0)
                                        @foreach ($mesas as $mesa)
                                        @php
                                            $ruta = route('factura/facturador'). "?mesa=" . $mesa->id_mesa;
                                            $ocupada = $mesa->ocupada();
                                            $minutos = 0;
                                            if ($ocupada) {
                                                $factura = $mesa->get_factura_ocupada();
                                                $ruta = route('factura/facturador'). "?factura=" . $factura->id_factura;
                                                $fecha_creacion = date('Y-m-d H:i', strtotime($factura->created_at));
                                                $fecha_actual = date('Y-m-d H:i');
                                                $fecha_oportuna = date('Y-m-d H:i', strtotime($fecha_creacion . "+" .$factura->minutos_duracion." minutes" ));
                                                $signo = $fecha_actual > $fecha_oportuna ? -1 : 1;
                                                $date1 = new DateTime($fecha_actual);
                                                $date2 = new DateTime($fecha_oportuna);
                                                $diff = $date1->diff($date2);
                                                $minutos = ($diff->days * 24 ) + ( $diff->h * 60 ) + ( $diff->i );
                                                $minutos = $minutos * $signo;
                                            }
                                        @endphp
                                        <div class="col-sm-2">
                                            <div class="card pointer {{ $ocupada ? "card-alert-info" : "" }}" onclick="
                                            location.href = '{{ $ruta }}' ">
                                                <div class="card-body" >
                                                    <div class="mx-auto d-block">
                                                        <img width="64" height="64"  class="mx-auto d-block" src="{{  $item->get_imagen() }}" alt="Mesa">
                                                        <h5 class="text-center mt-2 mb-1">Mesa #{{ $mesa->numero }}</h5>
                                                        @if ($ocupada)
                                                                @if ($minutos > 0)
                                                                <h4 class="text-center green">
                                                                    <b>{{ $minutos }} </b> <small>minutos para entrega oportuna</small>
                                                                </h4> 
                                                                @else
                                                                <h4 class="text-center red">
                                                                   <small>Retrasado </small><b>{{ $minutos * -1 }} </b> <small>minutos </small> 
                                                                </h4> 
                                                                @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                     @else
                                     <div class="col-sm-12">
                                         <center>
                                            <img width="350" height="350" src="{{ asset('plantilla/images/empty_product.svg') }}">
                                            <h3>No hay mesas registradas en el sistema</h3>
                                         </center>
                                     </div> 
                                     @endif

                                    @else
                                    <!-- PANEL DELIVERY CHANNEL -->
                                    @php
                                        $cont = 0;
                                    @endphp
                                    @foreach ($facturas as $factura)
                                        @if ($factura->id_dominio_canal == $item->id_dominio)
                                            <div class="col-sm-2">
                                                <div class="card pointer" onclick="
                                                location.href = '{{ route('factura/facturador'). "?factura=" . $factura->id_factura }}' ">
                                                    <div class="card-body" >
                                                        <div class="mx-auto d-block">
                                                            <img width="64" height="64"  class="mx-auto d-block" src="{{ $item->get_imagen() }}" alt="Pedido">
                                                            <h5 class="text-center mt-2">{{ $factura->tercero->nombre_completo() }}</h5>
                                                            <center>
                                                                @php
                                                                    $fecha_factura = date("Y-m-d", strtotime($factura->fecha));
                                                                    $hora_factura = date("H:i", strtotime($factura->fecha));
                                                                    $fecha = $fecha_factura. " a las ". $hora_factura;
                                                                    if ($fecha_factura == date('Y-m-d')) {
                                                                        $fecha = "Hoy a las ". $hora_factura;
                                                                    }

                                                                    if ($fecha_factura == date('Y-m-d', strtotime(date('Y-m-d'). " -1 days"))) {
                                                                        $fecha = "Ayer a las ". $hora_factura;
                                                                    }
                                                                @endphp
                                                                <small class="text-center bold-primary">{{ $fecha }}</small>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $cont++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($cont == 0)
                                        <div class="col-sm-12">
                                             <center>
                                                <br>
                                                <img width="350" height="350" src="{{ asset('plantilla/images/exito.png') }}"><br><br>
                                                <h3>No hay nada pendiente en este canal</h3>
                                             </center>
                                         </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @php $cont++; @endphp
                    @endforeach
                </div>
            </div>
        </div>        
    </div>
</div>
<script>
    $(document).ready(()=>{
         $('body').addClass("open")
    })
</script>
<script src="{{ asset('scroll-tabs/jquery.scrolling-tabs.js') }}"></script>
<script src="{{ asset('scroll-tabs/st-demo.js') }}"></script>
@endsection