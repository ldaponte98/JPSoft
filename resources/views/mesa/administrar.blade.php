@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="fab-options">
            <li onclick="location.href = '{{ config('global.url_base') }}/mesa/crear'">
                <span class="fab-label">Nueva mesa</span>
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
                <strong class="card-title">Administrar mesas</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $canal = \App\Dominio::find(47);
                    @endphp
                    @foreach ($mesas as $mesa)
                    <div class="col-sm-2">
                        <div class="card pointer" onclick="
                        location.href = '{{ route('mesa/editar', $mesa->id_mesa) }}' ">
                            <div class="card-body" >
                                <div class="mx-auto d-block">
                                    <img width="64" height="64"  class="mx-auto d-block" src="{{  $canal->get_imagen() }}" alt="Mesa">
                                    <h5 class="text-center mt-2 mb-1">Mesa #{{ $mesa->numero }}</h5>
                                    @if ($mesa->estado == 1)
                                        <center><span class="badge badge-success"><b>Activa</b></span></center>
                                    @else
                                        <center><span class="badge badge-danger"><b>Inactiva</b></span></center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection