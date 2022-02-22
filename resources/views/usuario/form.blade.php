@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Datos del usuario</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        {{ Form::open(array('method' => 'post')) }}
                            <div class="card-title">
                                <h3 class="text-center">@if($usuario->id_usuario == null) Crear usuario @else Modificar usuario @endif</h3>
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
                                        <label for="cc-payment" class="control-label mb-1"><b>*Empleado</b></label>
                                        <select id="select-empleado" name="id_tercero" data-placeholder="Seleccione un empleado" class="form-control select2" required>
                                            <option value="" label="default"></option>
                                            @foreach($empleados as $item)
                                                <option @if ($usuario->id_tercero == $item->id_tercero) selected @endif value="{{ $item->id_tercero }}">{{ strtoupper($item->nombre_completo()) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><b>*Perfil</b></label>
                                        <select id="select-perfil" name="id_perfil" data-placeholder="Seleccione un perfil" class="form-control select2" required>
                                            <option value="" label="default"></option>
                                            @foreach($perfiles as $item)
                                                <option @if ($usuario->id_perfil == $item->id_perfil) selected @endif value="{{ $item->id_perfil }}">{{ strtoupper($item->nombre) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Estado</b></label>
                                        <select name="estado" class="form-control" required>
                                            <option @if($usuario->estado == 0) selected @endif value="0">Inactivo</option>
                                            <option @if($usuario->estado == 1 || $usuario->id_usuario == null) selected @endif value="1">Activo</option>
                                        </select>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Usuario</b></label>
                                        <input autocomplete="off" name="usuario" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $usuario->usuario }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Contraseña</b></label>
                                        <input autocomplete="off" type="password" name="clave" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $usuario->clave }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label class="control-label mb-1"><b>*Confirmacion Contraseña</b></label>
                                        <input autocomplete="off" type="password" name="clave_confirmacion" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $usuario->clave_confirmacion }}" required>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <center>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                    </center>
                                    <br>
                                    <div class="alert alert-warning">
                                        <strong>La contraseña debe contener por lo menos 1 letra, 1 numero y minimo 8 caracteres</strong>
                                    </div>
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