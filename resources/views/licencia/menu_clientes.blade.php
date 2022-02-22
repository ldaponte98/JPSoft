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

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>Menu de clientes</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <h3><b>Codigo QR de enlace</b></h3><br>
                            <a title="DESCARGAR QR" href="https://api.qrserver.com/v1/create-qr-code/?data={{ route('menu', $licencia->token) }}" target="_blank">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ route('menu', $licencia->token) }}">
                            </a>
                            <br><br>
                            <b>Link </b><br>
                            <a href="{{ route('menu', $licencia->token) }}" target="_blank">{{ route('menu', $licencia->token) }}</a>
                        </center>

                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection