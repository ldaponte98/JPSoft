@php
 $usuario = \App\Usuario::find(session('id_usuario'));
 $licencia = $usuario->tercero->licencia;
@endphp

<!doctype html>
<html class="no-js" lang="es"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zorax - Sistema de facturacion</title>
    <meta name="description" content="Zorax - Sistema de facturacion">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('plantilla/images/app/zorax_small.png') }}">
    <link rel="shortcut icon" href="{{ asset('plantilla/images/app/zorax_small.png') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{ asset('plantilla/assets/js/main.js') }}"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="{{ asset('plantilla/assets/js/init/weather-init.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="{{ asset('plantilla/assets/js/init/fullcalendar-init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('plantilla/assets/css/style.css') }}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('plantilla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plantilla/assets/css/lib/chosen/chosen.min.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script src="{{ asset('TableToExcel.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('blockUI.js') }}"></script>
    <script src="{{ asset('js-general.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css-general.css') }}">

</head>

<body onclick="$('.dropdown-menu-util').fadeOut()">

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                @php
                    \App\Menu::loadMenu();
                @endphp
            </div>
        </nav>
    </aside>
    @yield('menu','')
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    
                    <a class="navbar-brand" style="text-align: center; margin-right: 0px;" href=""><img height="40" width="auto" src="{{ $licencia->get_imagen() }}" alt="{{ $licencia->nombre }}"></a>
                    <a class="navbar-brand hidden" href="" ><img src="{{ $licencia->get_imagen_small() }}" alt="{{ $licencia->nombre }}"></a>
                    <a id="menuToggle" class="menutoggle" style="width: 0px;"><i class="fa fa-bars"></i></a>
                    
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger" onclick="$('#caracteres').focus()"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input id="caracteres" class="form-control mr-sm-2" type="text" placeholder="Buscar tercero..." onkeyup="buscar(this.value)" aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                 <div class="dropdown-menu dropdown-menu-util" id="div_busqueda">
                                </div>
                            </form>
                            
                        </div>
                        @if (\App\Permiso::validar(4))
                            @php
                                $productos = \App\Producto::where('id_licencia', session('id_licencia'))
                                                          ->where('descontado', 1)
                                                          ->orWhere('alerta', 1)
                                                          ->where('cantidad_actual', '<=', 'cantidad_minimo_alerta')
                                                          ->orderBy('updated_at', 'desc')
                                                          ->get();
                                
                            @endphp
                            <div class="dropdown for-notification">
                                <button class="btn dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    @if (count($productos) > 0)
                                        <span class="count bg-danger">{{ count($productos) }}</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification">
                                    @if (count($productos) > 0)
                                        @foreach ($productos as $item)
                                            <a class="dropdown-item media" href="{{ route('inventario/stock_actual') }}">
                                                <i class="red fa fa-warning"></i>
                                                <p>El producto <b>{{ $item->nombre }}</b> esta por agotarse con <b>{{ $item->cantidad_actual }} {{ $item->presentacion->nombre }}</b> disponibles</p>
                                            </a>
                                        @endforeach
                                        
                                    @else
                                        <p>No tienes notificaciones</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="dropdown for-notification">
                            <a class="btn btn-secondary dropdown-toggle" href="{{ route('factura/facturador') }}" alt="Facturar">
                                <i class="fa fa-plus-square"></i>
                               <!-- <span class="count bg-danger">3</span> -->
                            </a>
                        </div>
                        @php
                            $caja = \App\Caja::where('id_usuario', session('id_usuario'))
                                             ->where('estado', 1)
                                             ->where('fecha_cierre', null)
                                             ->first();
                            $url_caja = route('caja/apertura');
                            $texto_caja = "Abrir caja";
                            if($caja) {
                                $url_caja = route('caja/view', $caja->id_caja);
                                $texto_caja = "$".number_format($caja->get_total());
                            }
                        @endphp   
                        @if (\App\Permiso::validar(2))
                            <div class="dropdown for-notification">
                                <a href="{{ $url_caja }}" class="btn btn-secondary dropdown-toggle open-box" type="button" id="caja" aria-expanded="false">
                                    <i class="fa fa-money"></i> <b>{{ $texto_caja }}</b>                               
                                </a>
                                <a href="{{ $url_caja }}" class="btn btn-secondary dropdown-toggle open-box-movil" type="button" id="caja" aria-expanded="false">
                                    <i class="fa fa-money"></i> <b style="font-size: 10px;">{{ $texto_caja }}</b>                              
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" height="40" width="46" src="{{ $usuario->tercero->get_imagen() }}" alt="{{ $usuario->tercero->nombre_completo() }}">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('tercero/editar', $usuario->id_tercero) }}"><i class="fa fa-user"></i>Configuracion de cuenta</a>

                            <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-power-off"></i>Cerrar sesion</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <div class="content">
            <div class="animated fadeIn">
                 @yield('content','')
            </div>
        </div>
        <div class="clearfix"></div>
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Zorax - Sistema de facturación 
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="ldaponte98@gmail.com">Luis Daniel Aponte Daza</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="{{ asset('plantilla/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            ValidarPedidosNuevos()
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
            $(".select2").select2({ width: "100%" })
            $('.nav-pills').scrollingTabs()
            
        });

        function ValidarPedidosNuevos() {
            setInterval(function() {
                let url = "{{ url('licencia/validar_pedidos_nuevos') }}"
                $.get(url, (response) => {
                    if (response.error == false) {
                        toastr.info("Tienes pedidos pendientes realizados por el menu digital", "Nuevo Pedido")
                    }
                })
                .fail((error) => {

                })
            }, 30000);
        }
    </script>
    
</body>
</html>
