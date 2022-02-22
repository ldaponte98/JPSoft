@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/categoria/crear'">
                <span class="fab-label">Nueva categoria</span>
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
                <strong class="card-title">Administrar categorias</strong>
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
                                            <th><center><b>Nombre</b></center></th>
                                            <th><center><b>Descripcion</b></center></th>
                                            <th><center><b>Estado</b></center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytable">
                                        @php $cont = 1; @endphp
                                        @foreach($categorias as $categoria)
                                        <tr>
                                            <td><center>{{ $cont }}</center></td>
                                            <td><center>{{ $categoria->nombre }}</center></td>
                                            <td><center>{{ $categoria->descripcion }}</center></td>
                                            <td><center>{{ $categoria->estado == 1 ? "Activa" : "Inactiva" }}</center></td>
                                            <td><center><a href="{{ route('categoria/editar', $categoria->id_categoria) }}">Editar</a>
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