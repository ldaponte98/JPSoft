@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Datos de la categoria</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        {{ Form::open(array('method' => 'post')) }}
                            <div class="card-title">
                                <h3 class="text-center">@if($categoria->id_categoria == null) Crear categoria @else Modificar categoria @endif</h3>
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
                                        <label for="cc-payment" class="control-label mb-1"><b>*Nombre</b></label>
                                        <input name="nombre" type="text" class="form-control" aria-required="true" required aria-invalid="false" value="{{ $categoria->nombre }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><b>Descripción</b></label>
                                        <input name="descripcion" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $categoria->descripcion }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Estado</b></label>
                                        <select name="estado" class="form-control" required>
                                            <option @if($categoria->estado == 0) selected @endif value="0">Inactiva</option>
                                            <option @if($categoria->estado == 1 || $categoria->id_categoria == null) selected @endif value="1">Activa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <center>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                    </center>
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