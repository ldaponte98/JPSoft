@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/inventario/movimientos'">
                <span class="fab-label">Ver movimientos de inventario</span>
                <div class="fab-icon-holder">
                    <i class="ti-list"></i>
                </div>
            </li>
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
                <strong class="card-title">Detalle de movimiento de inventario #{{ $inventario->id_inventario }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <td width="30%"><b>Tipo de movimiento</b></td>
                                <td>{{ $inventario->tipo_movimiento->nombre }}</td>
                            </tr>
                            <tr>
                                <td><b>Fecha</b></td>
                                <td>{{ $inventario->fecha }}</td>
                            </tr>
                            @if ($inventario->id_dominio_tipo_movimiento == 40)
                            <tr>
                                <td><b>Proveedor</b></td>
                                <td>{{ $inventario->proveedor ? $inventario->proveedor->nombre_completo() : "No definido" }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><b>Creación</b></td>
                                <td>{{ date('Y-m-d H:i', strtotime($inventario->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td><b>Usuario de creación</b></td>
                                <td>{{ $inventario->usuario_registra->tercero->nombre_completo() }}</td>
                            </tr>
                            <tr>
                                <td><b>Observaciones</b></td>
                                <td>{{ $inventario->observaciones != "" ? $inventario->observaciones : "Ninguna" }}</td>
                            </tr>
                            <tr>
                                <td><b>Factura</b></td>
                                <td>
                                    @if ($inventario->id_factura)
                                        <a target="_blank" href="{{ route('factura/imprimir', $inventario->id_factura) }}">{{ $inventario->factura->numero }}</a>
                                    @else
                                        No registra
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Estado</b></td>
                                <td>{{ $inventario->estado == 1 ? "Activo" : "Anulado" }}</td>
                            </tr>
                            <tr>
                                <td><b>Total en dinero</b></td>
                                <td>${{ number_format($inventario->total(), 0, '.', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-stats order-table ov-h table-responsive">
                            <table class="table" id="table-detalles">
                                <thead>
                                    <tr>
                                        <th class="serial"><center><i class="fa fa-laptop"></i></center></th>
                                        <th><center><b>Producto</b></center></th>
                                        <th><center><b>Presentación</b></center></th>
                                        <th><center><b>Cantidad</b></center></th>
                                        <th><center><b>Precio</b></center></th>
                                        <th><center><b>Total</b></center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventario->detalles as $detalle)
                                    @php
                                        $sub_total = $detalle->precio_producto * $detalle->cantidad;
                                    @endphp
                                    <tr>
                                        <td><center><img class="rounded-circle" src="{{ $detalle->producto->get_imagen() }}" width="45" height="45"></center></td>
                                        <td><center>{{ $detalle->nombre_producto }}</center></td>
                                        <td><center>{{ ucfirst(strtolower($detalle->presentacion_producto)) }}</center></td>
                                        <td><center>{{ $detalle->cantidad }}</center></td>
                                        <td><center>${{ number_format($detalle->precio_producto, 0, '.', '.') }}</center></td>
                                        <td><center>${{ number_format($sub_total, 0, '.', '.') }}</center></td>
                                    </tr>
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
@endsection