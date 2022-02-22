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
    $productos = \App\Producto::all()->where('id_licencia', session('id_licencia'))
                                 ->where('id_dominio_tipo_producto' ,'<>', 37)
                                 ->where('descontado_ingredientes' ,'<>', 1);
@endphp
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">@if($inventario->id_inventario == null) Nuevo movimiento de inventario @else Modificar movimiento de inventario @endif</strong>
            </div>
            <div class="card-body">
                <div id="pay-invoice">
                    <div class="card-body">
                        {{ Form::open(array('method' => 'post' ,'files' => true, 'id' => 'form-inventario')) }}
                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                    @foreach($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                                @endif
                                <div class="alert alert-info" id="alert-info">
                                    Los movimientos de entrada generaran un comprobante de egreso para tener el registro contable del movimiento <strong>(Caja abierta necesaria)</strong>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Tipo de movimiento</b></label>
                                            @php
                                                $tipos_movimiento = \App\Dominio::all()->where('id_padre', 39);
                                            @endphp
                                            <select name="id_dominio_tipo_movimiento" class="form-control" onchange="validar_tipo(this.value)">
                                                @foreach($tipos_movimiento as $tipo)
                                                    <option @if($inventario->id_dominio_tipo_movimiento == $tipo->id_dominio) selected @endif value="{{ $tipo->id_dominio }}">{{ $tipo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>*Fecha</b></label>
                                            <input id="fecha" name="fecha" type="date" class="form-control" aria-required="true" required aria-invalid="false" value="{{ $inventario->fecha }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                         <div class="form-group">
                                            @php
                                                $items = \App\Tercero::all()->where('id_dominio_tipo_tercero', 42)
                                                                            ->where('id_licencia', session('id_licencia'));
                                            @endphp
                                            <label for="cc-payment" class="control-label mb-1"><b>Proveedor</b></label>
                                            <select name="id_tercero_proveedor" id="id_tercero_proveedor" data-placeholder="Consulta aqui por nombre o identificacion..." class="form-control select2">
                                                <option value="" label="default"></option>
                                                @foreach($items as $item)
                                                <option value="{{ $item->id_tercero }}">{{ $item->nombre_completo() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><b>Observaciones</b></label>
                                            <textarea name="observaciones" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $inventario->observaciones }}">{{ $inventario->observaciones }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="detalles" name="detalles">
                        {{ Form::close() }}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-info"><b>Productos</b></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1"><b>Producto</b></label>
                                    <select id="select-producto" onchange="validar_presentacion(this.value)" data-placeholder="Consulta aqui por nombre..." class="form-control select2">
                                        <option value="" label="default"></option>
                                        
                                        @foreach($productos as $item)
                                            <option value="{{ $item->id_producto }}">{{ strtoupper($item->nombre) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1"><b>Cantidad</b></label>
                                    <div class="input-group mb-3">
                                        <input name="cantidad" id="cantidad" type="number" class="form-control" aria-required="true" aria-invalid="false" >
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="presentacion" id="presentacion">Unidades</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1"><b>Precio</b></label>
                                        <input name="precio" id="precio" type="number" class="form-control" aria-required="true" aria-invalid="false" value="0" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <center><br>
                                    <button class="btn btn-info mt-1 w-100" onclick="agregar_detalle()"><b>+</b>Agregar</button>
                                </center>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-stats order-table ov-h table-responsive">
                                    <table class="table" id="table-detalles">
                                        <thead>
                                            <tr>
                                                <th class="serial"><center><i class="fa fa-laptop"></i></center></th>
                                                <th><center><b>Producto</b></center></th>
                                                <th><center><b>Presentación</b></center></th>
                                                <th><center><b>Existencia</b></center></th>
                                                <th><center><b>Cantidad</b></center></th>
                                                <th><center><b>Precio</b></center></th>
                                                <th><center><b>Total</b></center></th>
                                                <th><center><b>Acciones</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8"><center><i>No hay productos registrados</i></center></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="alert alert-warning pull-right">
                                    <strong id="total_inventario">Total: $0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var productos = []
    var detalles = []

    function llenar_productos(){
        @foreach ($productos as $item)
            productos.push({
                'id' : {{ $item->id_producto }},
                'nombre': '{{ $item->nombre }}',
                'existencia': '{{ $item->cantidad_actual }}',
                'precio': '{{ $item->precio_compra }}',
                'presentacion' : '{{ ucfirst(strtolower($item->presentacion->nombre)) }}',
                'imagen' : '{{ $item->get_imagen() }}'
            })
        @endforeach
    }

    function llenar_detalles(){
        @foreach ($inventario->detalles as $item)
            detalles.push({
                'id' : {{ $item->id_producto }},
                'nombre': '{{ $item->nombre_producto }}',
                'existencia': '{{ $item->producto->cantidad_actual }}',
                'precio': '{{ $item->precio_compra }}',
                'presentacion' : '{{ ucfirst(strtolower($item->producto->presentacion->nombre)) }}',
                'imagen' : '{{ $item->get_imagen() }}',
                'cantidad' : {{ $item->cantidad }}
            })
        @endforeach
    }
    function validar_presentacion(id_producto) {
        let producto = this.productos.find(item => item.id == id_producto)
        if (producto) $("#presentacion").html(producto.presentacion)
        if (producto) $("#precio").val(producto.precio)
    }

    function validar_tipo(tipo) {
        if (tipo == 40) { //ENTRADA
            $("#id_tercero_proveedor").prop("disabled", false)
            $("#alert-info").fadeIn()
        }else{
            $("#id_tercero_proveedor").prop("disabled", true)
            $("#alert-info").fadeOut()
        }
    }

    function agregar_detalle() {
        let id_producto = $("#select-producto").val()
        let cantidad = $("#cantidad").val()
        let precio = $("#precio").val()

        if (precio.trim() == "") precio = 0
        if (id_producto == "") {
            toastr.error("Debe escoger un producto valido", "Error")
            return;
        }
        if (id_producto == "") {
            toastr.error("Debe escoger un producto valido", "Error")
            return;
        }
        if (cantidad.trim() == "" || cantidad < 0) {
            toastr.error("Debe establecer una cantidad valida", "Error")
            return;
        }

        if (precio < 0) {
            toastr.error("Debe establecer un precio del producto valido", "Error")
            return;
        }


        let producto = this.productos.find(item => item.id == id_producto)
        let detalle = {
            'id' : id_producto,
            'nombre': producto.nombre,
            'existencia': producto.existencia,
            'precio': precio,
            'presentacion' : producto.presentacion,
            'imagen' : producto.imagen,
            'cantidad' : cantidad
        }

        let busqueda = this.detalles.find(item => item.id == id_producto)

        if (busqueda) {
            let cont = 0
            this.detalles.forEach((item) => {
                if (item.id == id_producto) this.detalles.splice(cont, 1, detalle)
                cont++
            })
        }else{
            this.detalles.push(detalle)
        }

        $("#cantidad").val(0)
        actualizar_productos()
    }

    function eliminar_detalle(id_producto) {
        resp = confirm("¿Seguro que desea eliminar este producto del movimiento de inventario?")
        if (resp) {
            let cont = 0
            this.detalles.forEach((item) => {
                if (item.id == id_producto) this.detalles.splice(cont, 1)
                cont++
            })
            actualizar_productos()
        }
    }

    function actualizar_productos(){
        let tabla = ""
        let total = 0
        if (this.detalles.length <= 0) {
            tabla = `<tr>
                        <td colspan="8"><center><i>No hay productos registrados</i></center></td>
                    </tr>`
        }else{
            this.detalles.forEach((item) => {
                tabla += `  <tr>
                                <td><center><img class="rounded-circle" src="${item.imagen}" width="45" height="45"></center></td>
                                <td><center>${item.nombre.toUpperCase()}</center></td>
                                <td><center>${item.presentacion}</center></td>
                                <td><center>${format(item.existencia)}</center></td>
                                <td><center>${item.cantidad} ${item.presentacion}</center></td>
                                <td><center>$${format(item.precio)}</center></td>
                                <td><center>$${format(item.precio * item.cantidad)}</center></td>
                                <td>
                                <center>
                                    <button type="button" onclick="eliminar_detalle(${item.id})" class="btn btn-danger">
                                        <b><i class="fa fa-trash"></i></b>
                                    </button>
                                </center>
                                </td>
                            </tr>`
                total += item.precio * item.cantidad
            })
        }
        $("#total_inventario").html(`Total: $${format(total)}`)
        $("#table-detalles tbody").html(tabla)
    }


    function guardar() {
        if (this.detalles.length > 0) {
           let json_detalles = JSON.stringify(this.detalles)
            $("#detalles").val(json_detalles)
            if ($('#form-inventario').validate()) {
                Loading(true, "Registrando movimiento...")
                $('#form-inventario').submit()
            } 
        }else{
            toastr.error("Debe agregar por lo menos un producto al movimiento de inventario", "Error")
        }        
    }
    
    $(document).ready(() => {
        llenar_productos()
        llenar_detalles()
    })
</script>
@endsection