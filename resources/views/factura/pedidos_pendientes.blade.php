@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Pedidos pendientes</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <i>En este apartado podras observar todos los pedidos pendientes realizados por el menu digital</i>
                    </div>
                </div><br>
                <div class="row">
                    @foreach ($pedidos as $item)
                    <div class="col-sm-2">
                        <div class="card pointer" >
                            <div class="card-body" >
                                <div class="mx-auto d-block" onclick=" location.href = '{{ route('factura/facturador') }}?factura={{ $item->id_factura }}' ">
                                    <img class="mx-auto d-block" src="{{  $item->canal->get_imagen() }}" alt="Pedido" >
                                    <h5 class="text-center mt-2">{{ strtoupper($item->tercero->nombre_completo() )}}</h5>
                                    <center>
                                        @php
                                            $fecha_factura = date("Y-m-d", strtotime($item->fecha));
                                            $hora_factura = date("H:i", strtotime($item->fecha));
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
                                <center><a target="_blank" href="https://api.whatsapp.com/send?phone=57{{ $item->tercero->telefono }}" class="badge badge-success"><b>Contactar</b></a></center>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection