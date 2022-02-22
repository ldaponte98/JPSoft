@php
    $licencia = \App\Licencia::find(session('id_licencia'));
@endphp
@extends('layout.main')
@section('menu')
@endsection

@section('content')
<style type="text/css">
    .btn{
        font-size: 14px !important;
    }   
    .select2-container .select2-selection--single{
        height: 39px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        top:6px !important;
    }
    .select2-selection__rendered{
        margin-top: 5px;
    } 
    .totales{
      text-align: center;
      padding-top:30px;
      padding-bottom: 30px;
      color: #327ad5;
    }
</style>
<div id="app">
    <div class="row">
        <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                           <div class="row">
                               <div class="col-sm-6">
                                   <img width="auto" height="45" src="{{ asset($licencia->get_imagen()) }}">
                               </div>
                               <div class="col-sm-6">
                                  <h2 class="pull-right"><b>{{ $accion }}</b></h2>
                               </div>
                           </div><br><br>
                           <div class="row">

                               <div class="col-sm-6">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <center>
                                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal1" onclick="deshabilitar_producto_nuevo()">Agregar producto registrado</button>&nbsp;&nbsp;
                                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal1" onclick="habilitar_producto_nuevo()">Agregar producto no registrado</button>
                                    </center>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-stripe">
                                            <thead>
                                                <tr>
                                                    <th><center>#</center></th>
                                                    <th><center>Producto</center></th>
                                                    <th><center>Descripción</center></th>
                                                    <th><center>Valor</center></th>
                                                    <th><center>Iva</center></th>
                                                    <th><center>Desc</center></th>
                                                    <th><center>Cantidad</center></th>
                                                    <th><center>Total</center></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla_carrito">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                                </div>
                               </div>

                               <div class="col-sm-6">
                                <div class="row">
                                  <div class="col-12">
                                     <center>
                                        <button class="btn btn-primary" class="btn btn-primary" data-toggle="modal" data-target="#modal2" >Agregar forma de pago</button>&nbsp;&nbsp;
                                        <button class="btn btn-primary" onclick="alert('Opcion en proceso de elaboración')">Agregar abono</button>
                                    </center>
                                  </div>
                                  <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-stripe">
                                            <thead>
                                                <tr>
                                                    <th class="serial"><center>#</center></th>
                                                    <th><center>Forma de pago</center></th>
                                                    <th><center>Valor pagado</center></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla_formas_pago">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                                </div>
                               </div>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 alert-info totales">
                               <h3>Saldo: <b id="total">0</b></h3>
                             </div>
                             <div class="col-sm-6 alert-info totales">
                               <h3>Total formas de pago: <b id="total_formas_pago">0</b></h3>
                             </div>
                           </div>
                           <hr>
                           <div class="row">
                               <div class="col-sm-12">
                                   <div class="form-group">
                                    <textarea v-model="observaciones" id="observaciones" rows="2" placeholder="Observaciones" class="form-control"></textarea>
                                </div>
                               </div>
                               <div class="col-sm-12">
                                   <button onclick="finalizar_factura()" style="width: 100%; font-size: 23px !important; padding-top: 30px; padding-bottom: 30px; opacity: 0.8;" class="btn btn-danger">Generar @if($tipo==16) factura @else cotización @endif </button>
                               </div>
                           </div>
                        </div>
                    </div>
                </div> 
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Agregar producto / servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
        <div class="row">
            
            <div class="col-sm-12">
              <div class="form-group">
                <div id="select_producto">

                   <select data-placeholder="Selecciona un producto / servicio" class="form-control select2" id="id_producto" onchange="buscar_producto(this.value)">
                    <option value="0" disabled selected>Producto / servicio</option>
                    @php
                        $productos = \App\Producto::all()->where('id_licencia', session('id_licencia'));
                    @endphp
                    @foreach($productos as $producto)
                       <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                    </select>
                    </div>
                  </div>
                  <input style="margin-bottom: 10px" id="nombre_producto" placeholder="producto / servicio" type="text" class="form-control" style="display: none;">

            </div>
            <div class="col-sm-12">
                  <div class="row" id="info_producto" style="display: none">
                   <div class="col-sm-12">
                       <div class="form-group">
                          <label for="cc-payment" class="control-label mb-1"><b>Descripción</b></label>
                          <textarea rows="2" id="descripcion" type="text" class="form-control" aria-required="true" readonly aria-invalid="false" ></textarea>
                      </div>
                  </div>
                  <div class="col-sm-12">
                       <div class="form-group">
                          <label for="cc-payment" class="control-label mb-1"><b>Valor</b></label>
                          <input id="precio" type="number" class="form-control">
                      </div>
                  </div>
                  <div class="col-sm-12">
                       <div class="form-group">
                          <label for="cc-payment" class="control-label mb-1"><b>Iva(%)</b></label>
                          <input id="iva_producto" type="number" value="0" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-check">
                      <div class="checkbox">
                          <label for="check_descuento" class="form-check-label ">
                              <input onclick="validar_descuento()" type="checkbox" id="check_descuento"  class="form-check-input" onchange="validar_descuento()">Aplicar descuento
                          </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="row" id="div_descuento" style="display: none">
                      <div class="col-sm-6">
                           <div class="form-group">
                              <label for="cc-payment" class="control-label mb-1"><b>Descuento</b></label>
                              <select class="form-control" id="descuento_porcentaje" onchange="calcular_porcentaje_descuento()">
                                 @php 
                                  for ($i=0; $i <= 100; $i++) { 
                                    @endphp
                                    <option value="{{ $i }}">{{ $i }}%</option>
                                    @php 
                                  }
                                 @endphp
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6" id="div_descuento_valor">
                           <div class="form-group">
                              <label for="cc-payment" class="control-label mb-1"><b>Descuento a aplicar</b></label>
                              <input type="number" id="descuento" class="form-control" value="0">
                          </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
      </div>
      </div>
      <div class="modal-footer">
        <button style="width: 50%" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button style="width: 50%" type="button" class="btn btn-primary" onclick="agregar_producto()">Agregar</button>
      </div>
    
  
</div>
</div>
</div>


<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Agregar forma de pago</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
        <div class="row">
            
            <div class="col-sm-12">
              <div class="form-group">
                <div id="select_producto">
                   <select class="form-control hasDatepicker form-control-line" id="id_forma_pago">
                    <option value="0" disabled selected>Forma de pago</option>
                    @php
                        $formas_pago = \App\Dominio::all()->where('id_padre', 19);
                    @endphp
                    @foreach($formas_pago as $forma)
                       <option value="{{ $forma->id_dominio }}">{{ $forma->nombre }}</option>
                    @endforeach
                    </select>
                    </div>
                  </div>
            </div>
            <div class="col-sm-12">
                 <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1"><b id="maximo_pagar">Valor * (Maximo 0)</b></label>
                    <input id="valor_forma_pago" type="text" class="form-control">
                </div>
            </div>
      </div>
      </div>
      <div class="modal-footer">
        <button style="width: 50%" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button style="width: 50%" type="button" class="btn btn-primary" onclick="agregar_forma_pago()">Agregar</button>
      </div>
    
  
</div>
</div>
</div>
@csrf

<script type="text/javascript">
    var carrito = []
    var formas_pago = []
    var total_carrito = 0
    var total_formas_pago = 0

    function agregar_producto() {
      if($("#iva_producto").val() < 0 || $("#iva_producto").val() > 100){
        alert("Iva invalido");
        return false
      }
      if($("#precio").val() < 0 || $("#precio").val().trim() == ""){
        alert("Valor invalido");
        return false
      }
	var iva = $("#precio").val() * ($("#iva_producto").val() / 100)
      let producto = {
        'id_producto' : $("#id_producto").val(),
        'nombre' : $("#nombre_producto").val(),
        'descripcion' : $("#descripcion").val(),
	      'precio' : $("#precio").val(),
        'precio_iva' : parseFloat($("#precio").val()) + parseFloat(iva),
        'descuento': $("#descuento").val(),
        'iva': $("#iva_producto").val(),
        'cantidad' : 1
      }
      carrito.push(producto)
      this.actualizar_tabla()
    }
    function agregar_forma_pago() {
      if((parseFloat($("#valor_forma_pago").val()) + total_formas_pago) > total_carrito){
        alert("Monto no valido")
        return false
      }
      if($("#id_forma_pago").val() == 0 || $("#id_forma_pago").val() == null){
        alert("Debe seleccionar una forma de pago")
        return false
      }
      if(parseFloat($("#valor_forma_pago").val()) <= 0 || $("#valor_forma_pago").val().trim() == ""){
        alert("Agregue un valor valido")
        return false
      }
      let forma_pago = {
        'id_dominio_forma_pago' : $("#id_forma_pago").val(),
        'nombre' : $("#id_forma_pago option:selected").text(),
        'valor' : $("#valor_forma_pago").val(),
      }
      formas_pago.push(forma_pago)
      this.actualizar_tabla()
    }

    function buscar_producto(id_producto) {

      let url = '/producto/buscar/'+$("#id_producto").val()
      $.get(url, (response) => {
        $("#info_producto").fadeIn()
        $("#nombre_producto").val(response.nombre)
        $("#descripcion").val(response.descripcion)
        $("#precio").val(response.precio_venta)
        $("#iva_producto").val(response.iva)
      }).fail((error)=>{
        console.log(error)
      })
    }

    function actualizar_tabla() {
      $("#modal1").modal('hide')
      $("#modal2").modal('hide')
      $("#info_producto").fadeOut()
      let tabla_carrito = ""
      let tabla_formas_pago = ""
      this.total_carrito = 0
      this.total_formas_pago = 0
      carrito.forEach((producto)=>{
        tabla_carrito += "<tr><td class='serial'>"+(carrito.indexOf(producto) + 1) +"</td>"+
                  "<td><span class='name'>"+producto.nombre+"</span></td>"+
                  "<td><span class='product'>"+producto.descripcion+"</span></td>"+
                  "<td><span class='count'>$"+new Intl.NumberFormat().format(producto.precio_iva)+"</span></td>"+
                  "<td><span class='count'>%"+producto.iva+"</span></td>"+
                  "<td><span class='count'>$"+new Intl.NumberFormat().format(producto.descuento)+"</span></td>"+
                  "<td><span class='count'>$"+new Intl.NumberFormat().format(parseFloat(producto.precio_iva) - parseFloat(producto.descuento))+"</span></td>"+
                  "<td><span class='count'>"+producto.cantidad+"</span></td>"+
                  "<td>"+
                      "<span onclick='eliminar_producto("+carrito.indexOf(producto)+")'><i class='fa fa-times-circle red-icon'></i></span>"+
                  "</td></tr>"
        this.total_carrito += parseFloat(producto.precio_iva) - parseFloat(producto.descuento);    
      })

      formas_pago.forEach((forma)=>{
        tabla_formas_pago += "<tr><td class='serial'>"+(formas_pago.indexOf(forma) + 1) +"</td>"+
                  "<td><span class='name'>"+forma.nombre+"</span></td>"+
                  "<td><span class='count'>$"+new Intl.NumberFormat().format(forma.valor)+"</span></td>"+
                  "<td>"+
                      "<span onclick='eliminar_forma_pago("+formas_pago.indexOf(forma)+")'><i class='fa fa-times-circle red-icon'></i></span>"+
                  "</td></tr>"
        total_formas_pago += parseFloat(forma.valor);    
      })
      $("#total").html(new Intl.NumberFormat().format(parseFloat(total_carrito) -  parseFloat(total_formas_pago)))
      $("#total_formas_pago").html(new Intl.NumberFormat().format(total_formas_pago))
      $("#tabla_carrito").html(tabla_carrito)
      $("#tabla_formas_pago").html(tabla_formas_pago)
      $("#maximo_pagar").html("Valor * (Maximo "+(new Intl.NumberFormat().format(parseFloat(total_carrito) -  parseFloat(total_formas_pago)))+")")
      $("#valor_forma_pago").val(parseFloat(total_carrito) -  parseFloat(total_formas_pago))
    }

    function eliminar_producto(posicion) {
      carrito.splice(posicion, 1);
      this.actualizar_tabla()
    }
    function eliminar_forma_pago(posicion) {
      formas_pago.splice(posicion, 1);
      this.actualizar_tabla()
    }

    function habilitar_producto_nuevo(){
      $("#info_producto").fadeIn()
      $("#id_producto").val(0)
      $("#select_producto").fadeOut()
      $("#nombre_producto").fadeIn()
      $("#descripcion").prop("readonly",false);
      $("#precio").prop("readonly",false);
      $("#iva_producto").prop("readonly",false);

      $("#nombre_producto").val("")
      $("#descripcion").val("")
      $("#precio").val("")
    }
    function deshabilitar_producto_nuevo(){
      $("#info_producto").fadeOut()
      $("#id_producto").val(0)
      $("#select_producto").fadeIn()
      $("#nombre_producto").fadeOut()
      $("#descripcion").prop("readonly",true);
      $("#precio").prop("readonly",false);
      $("#iva_producto").prop("readonly",true);
      $("#nombre_producto").val("")
      $("#descripcion").val("")
      $("#precio").val("")
    }

    function validar_descuento(){
       if($('#check_descuento').prop('checked')){
          $("#div_descuento").fadeIn()
       }else{
          $("#div_descuento").fadeOut()
       }
       $("#descuento").val(0)
    }

    function calcular_porcentaje_descuento() {
      let porcentaje = $("#descuento_porcentaje").val()
      let precio = parseFloat($("#precio").val())
      let descuento = precio * (porcentaje/100)
      $("#descuento").val(descuento)
    }


    function finalizar_factura() {
      var observaciones = $("#observaciones").val();
      var id_tercero = {{ $tercero->id_tercero }};
      var tipo_factura = {{ $tipo }};
      if(this.carrito.length <= 0){
        alert("Debe agregar productos para realizar la factura")
        return false
      }

      if(tipo_factura == 16 && this.formas_pago.length == 0){
        alert("Debe agregar la forma de pago de la factura")
        return false
      }

      if((this.total_carrito - this.total_formas_pago) < 0){
        alert("Error en la validacion del saldo")
        return false
      }

      if(tipo_factura == 16 && this.total_formas_pago < this.total_carrito){
        alert("La factura no se encuentra saldada")
        return false
      }

      var url = "/factura/finalizar_factura"

      var _token = ""
      $("[name='_token']").each(function() { _token = this.value }) 
      var data = {
        '_token' : _token,
        'id_tercero' : id_tercero,
        'tipo_factura' : tipo_factura,
        'observaciones' : observaciones,
        'total_carrito' : this.total_carrito,
        'total_formas_pago' : this.total_formas_pago,
        'carrito' : this.carrito,
        'formas_pago' : this.formas_pago
      }
      Loading(true, "Guardando documento...")
     
      $.post(url, data, (response) => {
        $.unblockUI();
        if(response.error == false){
          window.open(
               '/factura/imprimir/'+response.id_factura,
               '_blank' // <- This is what makes it open in a new window.
          );
          location.href = "{{ route('tercero/view', $tercero->id_tercero) }}"
        }else{
          Loading(false)
          toastr.error(response.mensaje, "Error")
        }
      })
      .fail((error) => {
        Loading(false)
        toastr.error("Ha ocurrido un error al realizar la factura ["+error.responseJSON.message+"]", "Error")
      })
    }


    $(document).ready(function() {
        $("#id_producto").select2({
            width : '100%',
        })
    });
</script>

@endsection