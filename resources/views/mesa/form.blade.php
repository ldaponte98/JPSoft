@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Datos de la mesa</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        {{ Form::open(array('method' => 'post')) }}
                            <div class="card-title">
                                <h3 class="text-center">@if($mesa->id_mesa == null) Crear mesa @else Modificar mesa @endif</h3>
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                            </div><hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><b>*Numero</b></label>
                                        <input name="numero" type="text" class="form-control" aria-required="true" required aria-invalid="false" value="{{ $mesa->numero }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Estado</b></label>
                                        <select name="estado" class="form-control" required>
                                            <option @if($mesa->estado == 0) selected @endif value="0">Inactiva</option>
                                            <option @if($mesa->estado == 1 || $mesa->id_mesa == null) selected @endif value="1">Activa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4"><br>
                                    <button class="btn btn-primary mt-1"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection