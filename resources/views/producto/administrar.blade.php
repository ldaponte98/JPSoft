@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/producto/crear'">
                <span class="fab-label"><b>Nuevo</b> producto / servicio / ingrediente</span>
                <div class="fab-icon-holder">
                    <i class="fa fa-laptop"></i>
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
                <strong class="card-title">Administrar productos / servicios / ingredientes</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @php $cont = 0; @endphp
                            @foreach ($tipos as $item)
                                <li class="nav-item">
                                    <a class="nav-link {{ $cont == 0 ? "active" : "" }}" 
                                       id="nav-tipo-{{ $item->id_dominio }}-tab" 
                                       data-toggle="pill" 
                                       href="#nav-tipo-{{ $item->id_dominio }}" 
                                       role="tab" 
                                       aria-controls="nav-tipo-{{ $item->id_dominio }}" 
                                       aria-selected="true">{{ $item->nombre }}</a>
                                </li>
                                @php $cont++; @endphp
                            @endforeach
                        </ul>
                        <hr>
                        <div class="tab-content" id="pills-tabContent">
                            @php $cont = 0; @endphp
                            @foreach ($tipos as $item)
                                <div class="tab-pane fade {{ $cont == 0 ? "show active" : "" }}" 
                                     id="nav-tipo-{{ $item->id_dominio }}" 
                                     role="tabpanel" 
                                     aria-labelledby="nav-tipo-{{ $item->id_dominio }}-tab">
                                     @php
                                         $productos = \App\Producto::all()->where('id_licencia', session('id_licencia'))
                                                        ->where('id_dominio_tipo_producto', $item->id_dominio);
                                     @endphp

                                     <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-sm-9"></div> 
                                                <div class="col-sm-3" style="text-align: right !important;">
                                                    <input id="filtro-productos-{{ $item->id_dominio }}" type="text" class="form-control" placeholder="Consulte aqui..." autocomplete="on">
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-stats order-table ov-h table-responsive">
                                                    <table class="table" id="table-productos-{{ $item->id_dominio }}">
                                                        <thead>
                                                            <tr>
                                                                <th class="serial"><center><i class="fa fa-laptop"></i></center></th>
                                                                <th><center><b>Producto</b></center></th>
                                                                <th><center><b>Descripción</b></center></th>
                                                                <th><center><b>Precio venta</b></center></th>
                                                                <th><center><b>Precio compra</b></center></th>
                                                                <th><center><b>Iva</b></center></th>
                                                                <th><center><b>Aplica inventario</b></center></th>
                                                                <th><center><b>Estado</b></center></th>
                                                                <th><center><b>Acciones</b></center></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $cont = 1; @endphp
                                                            @foreach($productos as $producto)
                                                            <tr>
                                                                <td><center><img class="rounded-circle" src="{{ $producto->get_imagen() }}" width="45" height="45" alt="tercero"></center></td>
                                                                <td><center>{{ $producto->nombre }}</center></td>
                                                                <td><center>{{ $producto->descripcion }}</center></td>
                                                                <td><center>${{ number_format($producto->precio_venta,0,'\'','.') }}</center></td>
                                                                <td><center>${{ number_format($producto->precio_compra,0,'\'','.') }}</center></td>
                                                                <td><center>%{{ $producto->iva }}</center></td>
                                                                <td><center>{{ $producto->descontado == 1 ? "Aplica" : "No aplica" }}</center>
                                                                </td>
                                                                <td><center>{{ $producto->get_estado() }}</center></td>
                                                                <td>
                                                                    <center>
                                                                    <a href="{{ route('producto/view', $producto->id_producto) }}">Ver</a>
                                                                    <a class="ml-3" href="{{ route('producto/editar', $producto->id_producto) }}">Editar</a>
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
                                @php $cont++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


<script type="text/javascript">
    
       
        @foreach ($tipos as $item)
            setFiltro('filtro-productos-{{ $item->id_dominio }}', 'table-productos-{{ $item->id_dominio }}')
        @endforeach

    
</script>
@endsection