@extends('layout.main')
@section('menu')
    <div class="fab-container">
        <div class="fab fab-icon-holder" style="background: #23558a;">
            <i onclick="guardar()" class="fa fa-floppy-o"></i>
        </div>
    </div>
@endsection
@section('content')
@php
    $ingredientes = \App\Producto::all()->where('id_licencia', session('id_licencia'))
                ->where('id_dominio_tipo_producto', 38);        
@endphp
{{ Form::open(array('method' => 'post' ,'files' => true, 'id' => 'form-product')) }}
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">@if($producto->id_producto == null) Crear producto / servicio / ingrediente @else Modificar producto / servicio / ingrediente @endif</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <img src="@if($producto->imagen == null or $producto->imagen == '') {{ asset('plantilla/images/app/sinimagen.jpg') }} @else {{ asset('imagenes/producto/'.$producto->imagen) }} @endif" id="img_imagen" alt="image" class="img-thumbnail" width="100%" height="200">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*">
                                        <label class="custom-file-label" for="imagen" id="nombre_archivo">Examinar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Nombre</b></label>
                                            <input name="nombre" type="text" class="form-control" aria-required="true" required aria-invalid="false" value="{{ $producto->nombre }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Tipo</b></label>
                                            @php
                                                $tipos = \App\Dominio::all()->where('id_padre', 35);
                                            @endphp
                                            <select name="id_dominio_tipo_producto" class="form-control" onchange="validar_tipo_producto(this.value)" required>
                                                @foreach($tipos as $tipo)
                                                    <option @if($producto->id_dominio_tipo_producto == $tipo->id_dominio) selected @endif value="{{ $tipo->id_dominio }}">{{ $tipo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>Descripción</b></label>
                                            <textarea rows="2" name="descripcion" class="form-control" aria-required="true"  aria-invalid="false" value="{{ $producto->descripcion }}">{{ $producto->descripcion }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Precio venta (con iva)</b></label>
                                            <input name="precio_venta" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->precio_venta }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Precio de compra o utilidad</b></label>
                                            <input name="precio_compra" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->precio_compra }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>Iva(%)</b></label>
                                            <input name="iva" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->iva }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><b>*Presentación</b></label>
                                            @php
                                                $presentaciones = \App\Dominio::all()->where('id_padre', 24);
                                            @endphp
                                            <select name="id_dominio_presentacion" class="form-control" onchange="validar_presentacion()" required>
                                                @foreach($presentaciones as $tipo)
                                                    <option @if($producto->id_dominio_presentacion == $tipo->id_dominio) selected @endif value="{{ $tipo->id_dominio }}">{{ $tipo->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" id="div-categorias">
                                         <div class="form-group">
                                            <label class="control-label mb-1"><b>*Categorias</b></label>
                                            @php
                                                $_categorias = \App\Categoria::all()->where('id_licencia', session('id_licencia'))->where('estado', 1);
                                            @endphp
                                            <select name="categorias[]" data-placeholder="Escoje una o mas..." multiple class="standardSelect">
                                                <option value="" label="default"></option>
                                                @foreach($_categorias as $item)
                                                <option @if(in_array($item->id_categoria, $categorias)) selected @endif value="{{ $item->id_categoria }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                            <label class="control-label mb-1"><b>*Estado</b></label>
                                            <select name="estado" class="form-control" required>
                                                <option @if($producto->estado == 0) selected @endif value="0">Inactivo</option>
                                                <option @if($producto->estado == 1 || $producto->id_producto == null) selected @endif value="1">Activo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="margin-left: 18px;">
                                            <label for="descontado" class="form-check-label ">
                                                <input onclick="validar_inventario()" type="checkbox" id="descontado" name="descontado" @if($producto->descontado == 1) checked @endif class="form-check-input"><i>Deseo que este producto pueda descontarse del inventario al facturarlo.</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_inventario" @if($producto->descontado == 0) style="display: none;" @endif>
                                    <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1"><b>*Contenido por producto</b></label> <i class="fa fa-info-circle" title="Este campo es el contenido total del producto, si es por unidad el valor por defecto es 1."></i>
                                                <div class="input-group mb-3">
                                                    <input name="contenido" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->contenido }}" >
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="precio_compra" id="presentacion_contenido">Unidades</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1"><b>*Cantidad actual</b></label>
                                                <div class="input-group mb-3">
                                                    <input name="cantidad_actual" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->cantidad_actual }}" >
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="cantidad_actual" id="presentacion_cantidad_actual">Unidades</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="margin-left: 18px;">
                                            <label for="descontado_ingredientes" class="form-check-label ">
                                                <input onclick="validar_ingredientes()" type="checkbox" id="descontado_ingredientes" name="descontado_ingredientes" @if($producto->descontado_ingredientes == 1) checked @endif class="form-check-input"><i>Deseo que este producto sea descontado segun sus ingredientes.</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="margin-left: 18px;">
                                            <label for="alerta" class="form-check-label ">
                                                <input onclick="validar_aviso()" type="checkbox" id="alerta" name="alerta" @if($producto->alerta == 1) checked @endif class="form-check-input"><i>Deseo que el sistema me notifique cuando este por acabarse este producto.</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="div-alerta" @if($producto->alerta == 0) style="display: none;" @endif>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Cantidad minima de aviso </b></label> <i class="fa fa-info-circle" title="Este campo indica la cantidad minima para que el sistema informe faltantes en el inventario de este producto."></i>
                                            <div class="input-group mb-3">
                                                <input name="cantidad_minimo_alerta" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ $producto->cantidad_minimo_alerta }}">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="cantidad_minimo_alerta" id="presentacion_cantidad_alerta">Unidades</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="div-ingredientes" @if ($producto->descontado_ingredientes == 0) style="display: none;" @endif>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Ingredientes del producto</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right"><button type="button" onclick="modal_ingrediente(null)" class="btn btn-primary"><b><i class="fa fa-plus"></i></b></button></div>
                                <div class="table-stats order-table ov-h table-responsive">
                                    <table class="table" id="table-ingredientes">
                                        <thead>
                                            <tr>
                                                <th class="serial"><center><i class="fa fa-laptop"></i></center></th>
                                                <th><center><b>Ingrediente</b></center></th>
                                                <th><center><b>Cantidad</b></center></th>
                                                <th><center><b>Precio</b></center></th>
                                                <th><center><b>Acciones</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4"><center><i>No hay ingredientes registrados</i></center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning pull-right">Precio costo estimado: <strong id="precio-estimado">$0</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="ingredientes" name="ingredientes">
{{ Form::close() }}

<div class="modal fade" id="modal" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Gestion de ingredientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1"><b>*Ingrediente</b></label>
                            <select id="modal-ingrediente" data-placeholder="Escoge uno..." onchange="validar_presentacion_modal(this.value)" class="form-control select2">
                                <option value="" label="default"></option>
                                @foreach($ingredientes as $item)
                                <option value="{{ $item->id_producto }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>                    
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1"><b>*Cantidad</b></label>
                            <div class="input-group mb-3">
                                <input id="modal-cantidad" type="number" class="form-control" aria-required="true" aria-invalid="false" >
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="modal-cantidad" id="presentacion_modal_cantidad">Unidades</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="agregar_ingrediente()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var ingredientes_para_elegir = []
    var ingredientes = []

    function llenar_ingredientes_para_elegir(){
        @foreach ($ingredientes as $item)
            ingredientes_para_elegir.push({
                'id' : {{ $item->id_producto }},
                'nombre': '{{ $item->nombre }}',
                'precio_compra': {{ $item->precio_compra }},
                'presentacion' : '{{ ucfirst(strtolower($item->presentacion->nombre)) }}',
                'imagen' : '{{ $item->get_imagen() }}'
            })
        @endforeach
        console.log(ingredientes_para_elegir)
    }

    function validar_presentacion_modal(id_producto) {
        let producto = this.ingredientes_para_elegir.find(item => item.id == id_producto)
        if (producto) {
            $("#presentacion_modal_cantidad").html(producto.presentacion)
        }
    }

    function agregar_ingrediente(){
        if ($("#modal-ingrediente").val() == "") {
            toastr.error("Escoge un ingrediente valido", "Error")
            return;
        }
        if ($("#modal-cantidad").val() <= 0 || $("#modal-cantidad").val() == "" ) {
            toastr.error("Debe digitar una cantidad valida", "Error")
            return;
        }
        $("#modal").modal('hide')
        let producto = this.ingredientes_para_elegir.find(item => item.id == $("#modal-ingrediente").val())
        let ingrediente = {
            'id' : producto.id,
            'cantidad' : $("#modal-cantidad").val(),
            'nombre' : producto.nombre,
            'precio_compra' : producto.precio_compra,
            'presentacion' : producto.presentacion,
            'imagen' : producto.imagen
        }
        if (this.id_ingrediente_editar == null) {
            this.ingredientes.push(ingrediente)
        }else{
            let cont = 0
            this.ingredientes.forEach((item) => {
                if (item.id == id_ingrediente_editar) this.ingredientes.splice(cont, 1, ingrediente)
                cont++
            })
        }
        actualizar_ingredientes()
    }

    function actualizar_ingredientes(){
        let tabla = ""
        let precio_estimado = 0
        if (this.ingredientes.length <= 0) {
            tabla = `<tr>
                        <td colspan="4"><center><i>No hay ingredientes registrados</i></center></td>
                    </tr>`
        }else{
            this.ingredientes.forEach((item) => {
                tabla += `  <tr>
                                <td><center><img class="rounded-circle" src="${item.imagen}" width="45" height="45"></center></td>
                                <td><center>${item.nombre.toUpperCase()}</center></td>
                                <td><center>${item.cantidad} ${item.presentacion}</center></td>
                                <td><center>$${Format(item.precio_compra)}</center></td>
                                <td>
                                <center>
                                    <button type="button" onclick="modal_ingrediente(${item.id})" class="btn btn-primary">
                                        <b><i class="fa fa-pencil"></i></b>
                                    </button>
                                    <button type="button" onclick="eliminar_ingrediente(${item.id})" class="btn btn-danger">
                                        <b><i class="fa fa-trash"></i></b>
                                    </button>
                                </center>
                                </td>
                            </tr>`
                precio_estimado += item.precio_compra * item.cantidad
            })
        }
        $("#precio-estimado").html(`$${Format(precio_estimado)}`)
        $("#table-ingredientes tbody").html(tabla)
    }

    function eliminar_ingrediente(id_ingrediente){
        let cont = 0
        this.ingredientes.forEach((item) => {
            if (item.id == id_ingrediente) this.ingredientes.splice(cont, 1)
            cont++
        })
        actualizar_ingredientes()
    }

    function validar_ingredientes() {
        if($("#descontado_ingredientes").prop('checked') == true){
            $("#div-ingredientes").fadeIn()
        }else{
            $("#div-ingredientes").fadeOut()
        }
    }

    function validar_aviso() {
        if($("#alerta").prop('checked') == true){
            $("#div-alerta").fadeIn()
        }else{
            $("#div-alerta").fadeOut()
        }
    }

    function validar_inventario() {
        if($("#descontado").prop('checked') == true){
            $("#div_inventario").fadeIn()
            $("#contenido").prop('required', true);
            $("#cantidad_actual").prop('required', true);
            $("#cantidad_minimo_alerta").prop('required', true);
        }else{
            $("#div_inventario").fadeOut()
            $("#contenido").prop('required', false);
            $("#cantidad_actual").prop('required', false);
            $("#cantidad_minimo_alerta").prop('required', false);
        }
    }

    function validar_presentacion() {
        let presentacion = $('select[name="id_dominio_presentacion"] option:selected').text()
        $("#presentacion_contenido").html(presentacion)
        $("#presentacion_cantidad_actual").html(presentacion)
        $("#presentacion_cantidad_alerta").html(presentacion)
    }

    function validar_tipo_producto(id_dominio_tipo) {
        if (id_dominio_tipo == 36) { //PRODUCTO
            $("#div-categorias").fadeIn()
            $("#descontado").prop("disabled", false)
            $("#descontado_ingredientes").prop("disabled", false)
            validar_inventario()
            validar_ingredientes()
            validar_aviso()
        }
        if (id_dominio_tipo == 37) { //SERVICIO
            $("#div-categorias").fadeOut()
            $("#descontado").prop("checked", false)
            $("#descontado").prop("disabled", true)
            $("#descontado_ingredientes").prop("checked", false)
            $("#descontado_ingredientes").prop("disabled", true)
            $("#alerta").prop("checked", false)
            $("#alerta").prop("disabled", true)
            validar_inventario()
            validar_ingredientes()
            validar_aviso()
        }
        if (id_dominio_tipo == 38) { //INGREDIENTE
            $("#div-categorias").fadeOut()
            $("#descontado").prop("checked", false)
            $("#descontado").prop("disabled", true)
            $("#descontado_ingredientes").prop("checked", false)
            $("#descontado_ingredientes").prop("disabled", true)
            $("#alerta").prop("checked", true)
            $("#alerta").prop("disabled", false)
            validar_inventario()
            validar_ingredientes()
            validar_aviso()
        }
    }

    var id_ingrediente_editar = null
    function modal_ingrediente(id_ingrediente) {
        if (id_ingrediente) {
            id_ingrediente_editar = id_ingrediente
            let ingrediente = this.ingredientes.find(item => item.id == id_ingrediente)
            $("#presentacion_modal_cantidad").html(ingrediente.presentacion)
            $("#modal-cantidad").val(ingrediente.cantidad)
            $("#modal-ingrediente").val(id_ingrediente).trigger('change');
        }
        $("#modal").modal('show')
    }

    function guardar(){
        let json_ingredientes = JSON.stringify(this.ingredientes)
        $("#ingredientes").val(json_ingredientes)
        if ($('#form-product').validate()) {
            $('#form-product').submit()
        }
        
    }

    function llenar_ingredientes_actuales(){
        @foreach ($producto->ingredientes as $intersecto)
            @php $ingrediente = $intersecto->ingrediente; @endphp
            this.ingredientes.push({
                'id' : {{ $ingrediente->id_producto }},
                'cantidad' : {{ $intersecto->cantidad }},
                'nombre' : '{{ $ingrediente->nombre }}',
                'precio_compra' : '{{ $ingrediente->precio_compra }}',
                'presentacion' : '{{ $ingrediente->presentacion->nombre }}',
                'imagen' : '{{ $ingrediente->get_imagen() }}'
            })
        @endforeach

        actualizar_ingredientes()
    }

    $(document).ready(function(){
        $('#form-product').validate()
        
        llenar_ingredientes_actuales()
        llenar_ingredientes_para_elegir()
        $('#imagen').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
             {
                var reader = new FileReader();
                reader.onload = function (e) {
                   $('#img_imagen').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
              alert("El archivo seleccionado debe ser una imagen")
              $('#img_imagen').attr('src', '{{ asset('imagenes/app/sinimagen.jpg') }}');
            }
            $('#nombre_archivo').html("Examinar")
        });

        validar_tipo_producto({{ $producto->id_dominio_tipo_producto }})
        validar_presentacion()
    })
</script>
@endsection