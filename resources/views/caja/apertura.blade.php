@extends('layout.main')
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
                <strong>Apertura de caja</strong>
            </div>
            <div class="card-body">
                @if (\App\Permiso::validar(2))
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open(array('method' => 'post')) }}
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select onchange="ValidarTipo(this.value)" name="tipo_apertura" class="form-control">
                                            <option value="apertura_0">Apertura en 0</option>
                                            <option value="apertura_valor">Apertura apartir de un valor inicial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="display: none;" id="div-apertua-valor">
                                    <div class="form-group">
                                        <input min="0" type="number" id="valor_inicial" class="form-control" placeholder="Valor inicial" name="valor_inicial">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-info"> Abrir caja </button>
                                </div>                            
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="alert alert-warning">
                                <strong>Usted no tiene permisos para abrir una caja de factuiración</strong>
                            </div>
                        </div>
                    </div>    
                @endif
                
            </div>
        </div>
    </div>
</div>

<script>
    function ValidarTipo(tipo) {
        if (tipo == "apertura_0") {
            $("#div-apertua-valor").fadeOut()
            $("#valor_inicial").prop('required', false)
        }else{
            $("#div-apertua-valor").fadeIn()
            $("#valor_inicial").prop('required', true)
        }
    }
</script>

@endsection