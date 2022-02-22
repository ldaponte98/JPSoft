@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/usuario/crear'">
                <span class="fab-label">Nuevo usuario</span>
                <div class="fab-icon-holder">
                    <i class="fa fa-user"></i>
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
                <strong class="card-title">Administrar usuarios</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            
                            <div class="col-sm-4">
                                
                            </div>
                            <div class="col-sm-5">
                            </div>
                            <div class="col-sm-3" style="text-align: right !important;">
                                <input id="filtro" type="text" class="form-control" placeholder="Consulte aqui..." autocomplete="on">
                            </div>
                        </div>
                    </div><br><br>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th><center><b>#</b></center></th>
                                            <th><center><b>Tercero</b></center></th>
                                            <th><center><b>Peril</b></center></th>
                                            <th><center><b>Nombre de usuario</b></center></th>
                                            <th><center><b>Estado</b></center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytable">
                                        @php $cont = 1; @endphp
                                        @foreach($usuarios as $usuario)
                                        <tr>
                                            <td><center>{{ $cont }}</center></td>
                                            <td><center>{{ $usuario->tercero->nombre_completo() }}</center></td>
                                            <td><center>{{ $usuario->perfil->nombre }}</center></td>
                                            <td><center>{{ $usuario->estado == 1 ? "Activo" : "Inactivo" }}</center></td>
                                            <td><center><a href="{{ route('usuario/editar', $usuario->id_usuario) }}">Editar</a>
                                            </center></td>
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
@endsection