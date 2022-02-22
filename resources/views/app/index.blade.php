@foreach ($productos as $item)
  <div class="u-container-style u-list-item u-repeater-item u-white u-list-item-1 card-product">
    <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1" >
      <img onclick="ValidarEstadoProducto({{ $item->id_producto }})" alt="" class="u-expanded-width-xs u-image u-image-default u-image-1" src="{{ $item->get_imagen() }}">
      <div class="u-container-style u-expanded-width-xs u-group u-video-cover u-group-1">
        <div class="u-container-layout u-valign-middle-xs u-container-layout-2">
          <h3 onclick="ValidarEstadoProducto({{ $item->id_producto }})" class="u-custom-font u-font-oswald u-text u-text-2">{{ $item->nombre }}</h3>
          <p onclick="ValidarEstadoProducto({{ $item->id_producto }})" class="u-text u-text-3">{{ $item->descripcion }}</p>
          <br>
          <p onclick="ValidarEstadoProducto({{ $item->id_producto }})" class="u-text u-text-3"><b>Presentación: </b>{{ $item->presentacion->descripcion }}</p>
          <h6 onclick="ValidarEstadoProducto({{ $item->id_producto }})" class="mt-1 u-text u-text-palette-3-base u-text-4">
            ${{ number_format($item->precio_venta,0,'.','.') }}
          </h6>
          <div class="input-group group-quantity" id="acciones-{{ $item->id_producto }}" style="display: none;">
              <div class="input-group-btn">
                <a onclick="RestarProducto({{ $item->id_producto }})" class="btn btn-action">
                  <i class="fa fa-minus"></i>
                </a>
              </div>
              <input id="txt-cantidad-{{ $item->id_producto }}" readonly type="number" class="form-control">
              <div class="input-group-btn">
                <a onclick="SumarProducto({{ $item->id_producto }})" class="btn btn-action">
                  <i class="fa fa-plus"></i>
                </a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach

<section style="display: none;" class="section-detail-car">
  <div class="u-container-style u-list-item u-repeater-item u-white u-list-item-1">
    <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1" >
      <div class="u-container-style u-expanded-width-xs u-group u-video-cover">
        <div class="u-container-layout u-valign-middle-xs u-container-layout-2">
          <h3 class="u-custom-font u-font-oswald u-text u-text-2">Detalle de pedido</h3>
          <br>
          <div id="detail-car">
            
          </div>
          <br>
          <h4 class="u-custom-font u-font-oswald u-text u-text-2">Total - <b id="total-detail-car"></b></h4><br>
          <button id="btn-confirmar" class="btn btn-primary mb-2" onclick="ConfirmarPedido()"> <i></i> Confirmar pedido </button>
          <button class="btn btn-primary mb-2" onclick="VolverTienda()"> <i></i> Volver </button>         
          <br>
        </div>
      </div>
    </div>
  </div>
</section>

<section style="display: none;" class="section-checkout">
  <div class="u-container-style u-list-item u-repeater-item u-white u-list-item-1">
    <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1" >
      <div class="u-container-style u-expanded-width-xs u-group u-video-cover">
        <div class="u-container-layout u-valign-middle-xs u-container-layout-2">
          <h3 class="u-custom-font u-font-oswald u-text u-text-2">Información necesaria</h3>
          <br>
          <div class="form-group">
            <label for="company" class=" form-control-label">Nombre</label>
            <input type="text" id="nombre" placeholder="" class="form-control">
          </div>
          <div class="form-group">
            <label for="company" class=" form-control-label">Telefono</label>
            <input type="text" id="telefono" placeholder="" class="form-control">
          </div>
          <div class="form-group">
            <label for="company" class=" form-control-label">Identificación</label>
            <input type="text" id="identificacion" placeholder="" class="form-control">
          </div>
          <div class="form-group">
            <label for="company" class=" form-control-label">Direccion</label>
            <input type="text" id="direccion" placeholder="" class="form-control">
          </div>
          <div style="display: none" class="alert alert-danger" id="alert"><small id="msg-alert"></small></div>
          <br>
          <button id="btn-confirmar" class="btn btn-primary mb-2" onclick="ConfirmarChekOut()"> <i></i> Realizar pedido </button>
          <button class="btn btn-primary mb-2" onclick="VolverCarrito()"> <i></i> Volver </button>         
          <br>
        </div>
      </div>
    </div>
  </div>
</section>

<section style="display: none;" class="section-success">
  <div class="u-container-style u-list-item u-repeater-item u-white u-list-item-1">
    <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1" >
      <div class="u-container-style u-expanded-width-xs u-group u-video-cover">
        <div class="u-container-layout u-valign-middle-xs u-container-layout-2">
          <center>
            <h3 class="u-custom-font u-font-oswald u-text u-text-2 text-center">Pedido realizado exitosamente</h3>
            <br>
            <p class="u-text u-text-3">Tu pedido ha sido enviado exitosamente, por favor espera que nos comuniquemos contigo para terminar el proceso y saldar los productos adquiridos</p>
            <br><br>
            <button class="btn btn-primary mb-2" onclick="location.reload()"> <i></i> Volver a la tienda </button>
          </center>
      </div>
    </div>
  </div>
</section>

@csrf

<script>
  var productos = []
  var carrito = []

  function LlenarProductos() {
    @foreach ($productos as $item)
      this.productos.push({
        'id_producto' : {{ $item->id_producto }},
        'nombre' : `{{ $item->nombre }}`,
        'descripcion' : `{{ $item->descripcion }}`,
        'precio_venta' : {{ $item->precio_venta }},
        'presentacion' : `{{ $item->presentacion->nombre }}`,
        'cantidad' : 0
      });
    @endforeach
  }

  function ValidarEstadoProducto(id_producto) {
    let busqueda = this.carrito.find(item => item.id_producto == id_producto)
    if (busqueda) {
      $(`#txt-cantidad-${id_producto}`).val(busqueda.cantidad)
    }else{
      SumarProducto(id_producto)
      $(`#acciones-${id_producto}`).css('display', 'flex')
    }
  }

  function RestarProducto(id_producto) {
    let busqueda = this.carrito.find(item => item.id_producto == id_producto)
    if (busqueda) {
      let cantidad = busqueda.cantidad - 1
      $(`#txt-cantidad-${id_producto}`).val(cantidad)
      if (cantidad > 0) {
        busqueda.cantidad = cantidad
        let pos = this.carrito.indexOf(busqueda)
        this.carrito.splice(pos, 1, busqueda)
        ActualizarLocalStorage()
      }else{
        EliminarProducto(id_producto)
        $(`#acciones-${id_producto}`).css('display', 'none')
      }
    }
  }

  function SumarProducto(id_producto) {

    let busqueda = this.carrito.find(item => item.id_producto == id_producto)
    if (busqueda) {
      busqueda.cantidad++
      $(`#txt-cantidad-${id_producto}`).val(busqueda.cantidad)
      let pos = this.carrito.indexOf(busqueda)
      this.carrito.splice(pos, 1, busqueda)
      ActualizarLocalStorage()
    }else{
      $(`#txt-cantidad-${id_producto}`).val(1)
      AgregarProducto(id_producto)
    }
  }

  function EliminarProducto(id_producto) {
    let pos = 0
    this.carrito.forEach((item) => {
      if (item.id_producto == id_producto) {
        this.carrito.splice(pos, 1)
      }
      pos++
    })
    ActualizarLocalStorage()
  }

  function AgregarProducto(id_producto) {
    let busqueda = this.productos.find(item => item.id_producto == id_producto)
    if (busqueda) {
      busqueda.cantidad = 1
      this.carrito.push(busqueda)
    }
    ActualizarLocalStorage()
  }

  function ActualizarLocalStorage() {
    let data = JSON.stringify(this.carrito)
    localStorage.setItem('car', data)

    if (this.carrito.length > 0){
      $("#fab-car").addClass("btn-alert")
    }else{
      $("#fab-car").removeClass("btn-alert")
    }
  }

  function CargarCarritoLocalStorage() {
    let data = localStorage.getItem('car')
    this.carrito = data ? JSON.parse(data) : []

    if (this.carrito.length > 0){
      $("#fab-car").addClass("btn-alert")
    }else{
      $("#fab-car").removeClass("btn-alert")
    }

    this.carrito.forEach((item) => {
      let id_producto = item.id_producto
      $(`#txt-cantidad-${id_producto}`).val(item.cantidad)
      $(`#acciones-${id_producto}`).css('display', 'flex')
    })
  }

  function VerCarrito() {
      $("#fab-car").fadeOut()
      $(".card-product").fadeOut()
      $(".section-detail-car").fadeIn()
      let data = localStorage.getItem('car')
      let productos = JSON.parse(data)
      let detalles = ``
      let total = 0
      if (productos.length > 0) {
        detalles += `<table width="100%" border="0" cellspacing="0" cellpadding="0">`
        productos.forEach((item) => {
          let precio = item.precio_venta * item.cantidad
          total += precio
          let presentacion = item.presentacion != 'un' ? item.presentacion : ''
          detalles += `
              <tr>
                <td>
                  <p class="u-text u-text-3 mt-0"><b>${item.cantidad} ${presentacion}</b> - ${item.nombre}</p>
                </td>
                <td align="right"><p class="u-text u-text-3 mt-0">$${format(precio)}</p></td>
              </tr>
              <tr><td colspan="2"><hr></td></tr>`
        })
        detalles += `</table>`
        $("#btn-confirmar").fadeIn()
      }else{
        detalles += `<i>No tienes productos seleccionados</i>`
        $("#btn-confirmar").fadeOut()
      }
      $("#total-detail-car").html(`$${format(total)}`)
      $("#detail-car").html(detalles)


      ScrollTop()
  }

  function ConfirmarPedido() {
    $(".section-checkout").fadeIn()
    $("#fab-car").fadeOut()
    $(".section-detail-car").fadeOut()
    let data = localStorage.getItem('user')
    if (data) {
      let user = JSON.parse(data)
      $("#nombre").val(user.nombre)
      $("#telefono").val(user.telefono)
      $("#identificacion").val(user.identificacion)
      $("#direccion").val(user.direccion)
    }
  }

  function ConfirmarChekOut() {
    if (ValidarCamposChekOut()) {
      GuardarUsuarioLocalStorage()
      Loading(true, "Realizando pedido...")
      let total = 0
      this.carrito.forEach((item) => { total += item.cantidad * item.precio_venta })
      let factura = {
        id_licencia: {{ $licencia->id_licencia }},
        id_factura: null,
        cliente: {
          nombre: $("#nombre").val(),
          telefono: $("#telefono").val(),
          identificacion: $("#identificacion").val() 
        },
        id_dominio_canal : 54,
        id_mesa : null,
        domicilio : 0,
        observaciones : "",
        direccion : $("#direccion").val(),
        detalles : this.carrito,
        formas_pago : [],
        servicio_voluntario: 0,
        descuento: 0,
        total: total,
        finalizada : 0,
        minutos_duracion : {{ $licencia->minutos_duracion_promedio ? $licencia->minutos_duracion_promedio : 0 }}    
      }
      let url = "{{ route('factura/finalizar_factura_facturador') }}"
      var _token = ""
      $("[name='_token']").each(function() { _token = this.value })
      let request = {
          '_token' : _token,
          'factura' : factura
      }
      $.post(url, request, (response) => {
        Loading(false)
        if (response.error == false) {
          this.carrito = []
          $(".section-checkout").fadeOut()
          $(".section-success").fadeIn()
          ActualizarLocalStorage()
        }else{
          MostrarErrorCheckOut(response.mensaje)
        }
      })
      .fail((error) => {
        Loading(false)
        MostrarErrorCheckOut("Ocurrio un error inesperado por favor intentalo nuevamente")
      })
    }
  }

  function GuardarUsuarioLocalStorage() {
    let user = {
      'nombre' : $("#nombre").val(),
      'telefono' : $("#telefono").val(),
      'identificacion' : $("#identificacion").val(),
      'direccion' : $("#direccion").val()
    }
    localStorage.setItem('user', JSON.stringify(user))
  }

  function MostrarErrorCheckOut(mensaje) {
    $("#msg-alert").html(mensaje)
    $("#alert").fadeIn()
    setTimeout(function() {$("#alert").fadeOut()}, 5000);
  }

  function ValidarCamposChekOut() {
    if ($("#nombre").val().trim() == "") {
      MostrarErrorCheckOut("Debe suministrar un nombre")
      return false
    }

    if ($("#telefono").val().trim() == "") {
      MostrarErrorCheckOut("Debe suministrar un telefono")
      return false
    }

    if ($("#identificacion").val().trim() == "") {
      MostrarErrorCheckOut("Debe suministrar una identificacion")
      return false
    }

    if ($("#direccion").val().trim() == "") {
      MostrarErrorCheckOut("Debe suministrar una direccion")
      return false
    }
    return true;
  }

  function VolverTienda() {
    $("#fab-car").fadeIn()
    $(".section-detail-car").fadeOut()
    $(".section-success").fadeOut()
    $(".card-product").fadeIn()
    ScrollTop()
  }

  function VolverCarrito() {
    $("#fab-car").fadeOut()
    $(".section-checkout").fadeOut()
    $(".section-detail-car").fadeIn()
    ScrollTop()
  }

  function ScrollTop() {
    window.scroll({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
  }

  $(document).ready(() => {
    LlenarProductos()
    CargarCarritoLocalStorage()
  })
</script>
