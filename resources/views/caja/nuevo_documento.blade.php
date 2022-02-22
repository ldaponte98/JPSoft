@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Datos del documento</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        {{ Form::open(array('method' => 'post')) }}
                            <div class="card-title">
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        @php
                                            $tipos = \App\Dominio::where('id_padre', 15)
                                                                 ->where('id_dominio' ,'<>', 16)
                                                                 ->where('id_dominio' ,'<>', 17)
                                                                 ->get();
                                        @endphp
                                        <label for="cc-payment" class="control-label mb-1"><b>*Tipo</b></label>
                                        <select name="id_dominio_tipo_factura" class="form-control" required>
                                            @foreach ($tipos as $item)
                                                <option @if ($item->id_dominio == $factura->id_dominio_tipo_factura)
                                                    selected 
                                                @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><b>Valor</b></label>
                                        <input name="valor" type="number" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $factura->valor }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group">
                                        @php
                                        $items = \App\Tercero::all()->where('id_licencia', session('id_licencia'));
                                        @endphp
                                        <label for="cc-payment" class="control-label mb-1"><b>Tercero</b></label>
                                        <select name="id_tercero" id="id_tercero" data-placeholder="Consulta aqui por nombre o identificacion..." class="form-control select2" required>
                                            <option value="" label="default"></option>
                                            @foreach($items as $item)
                                            <option @if ($item->id_tercero == $factura->id_tercero)
                                                selected 
                                            @endif value="{{ $item->id_tercero }}">{{ $item->nombre_completo() }} ({{ $item->identificacion }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="cc-payment" class="control-label mb-1"><b>Observaciones</b></label>
                                    <textarea rows="2" name="observaciones" class="form-control" aria-required="true"  aria-invalid="false">
                                        {{ $factura->observaciones }}
                                    </textarea>
                                </div>
                            </div>

                            <br>
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