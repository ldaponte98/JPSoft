<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
  	<title>{{ $licencia->nombre }}</title>
	<link rel="apple-touch-icon" href="{{ $licencia->get_imagen() }}">
    <link rel="shortcut icon" href="{{ $licencia->get_imagen() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Menu">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <link rel="stylesheet" href="{{ asset('plantilla_menu/nicepage.css') }}" media="screen">
	  <link rel="stylesheet" href="{{ asset('plantilla_menu/Menu.css') }}" media="screen">
    <script class="u-script" type="text/javascript" src="{{ asset('plantilla_menu/nicepage.js') }}" defer=""></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700">
    <link id="u-page-google-font" rel="stylesheet" href="{{ asset('css-general.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script src="{{ asset('TableToExcel.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('blockUI.js') }}"></script>
    <script src="{{ asset('js-general.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css-general.css') }}">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Menu">
    <meta property="og:type" content="website">
    <style>
    	.u-section-1 .u-list-1 {
  		    margin-top: 20px !important;
  		}
  		.u-section-1 .u-text-1 {
  		    margin: 1px auto 0;
  		}
      .fab-container {
          top: 40px !important;
          right: 20px !important;
      }
      .u-text-4{
        bottom: 0px;
        position: absolute;
      }
      .btn-action{
        background: {{ $licencia->color_principal ? $licencia->color_principal : "#000000" }} !important;
        color: black;
        border-radius: 0px;
      }

      .group-quantity{
        width: 70% !important;
        align-self: center;
      }

      .u-text-palette-3-base, a.u-button-style.u-text-palette-3-base, a.u-button-style.u-text-palette-3-base[class*="u-border-"]{
        color: {{ $licencia->color_principal ? $licencia->color_principal : "#000000" }} !important;
      }

      .fab{
        background: {{ $licencia->color_principal ? $licencia->color_principal : "#000000" }} !important;
      }

      .fab-icon-holder i{
        color: {{ $licencia->color_letras ? $licencia->color_letras : "#000000" }} !important;
      }

      @media (max-width: 600px) {
        .group-quantity {
            width: 50% !important;
            align-self: center;
        }
        .blockMsg {
          width: 100% !important;
          top: 30% !important;
          left: 0% !important;          
        }
      }

      .mt-0{
        margin-top: 0px !important;
      }

      .detail-car table{
        width: 100%;
      }

      .btn-primary{
        background-color: {{ $licencia->color_principal ? $licencia->color_principal : "#000000" }} !important;
        border-color: {{ $licencia->color_principal ? $licencia->color_principal : "#000000" }} !important;
        color: {{ $licencia->color_letras ? $licencia->color_letras : "#000000" }} !important;
        font-weight: 600;
      }

      .blockUI h1{
        font-size: 1.75rem;
      }
    </style>

  </head>
  <div class="fab-container">
      <div class="fab fab-icon-holder" id="fab-car" onclick="VerCarrito()">
          <i class="ti-shopping-cart"></i>
      </div>
  </div>
  <body class="u-body">
    <section class="u-align-center u-clearfix u-grey-10 u-section-1" id="carousel_0c4f">
      <div class="u-clearfix u-sheet u-sheet-1">
      	<img width="100" src="{{ $licencia->get_imagen() }}" style="margin-top: 20px;">
        <h1 class="u-custom-font u-font-oswald u-text u-text-default u-text-palette-3-base u-text-1">Menu</h1>
        <div class="u-expanded-width-xs u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            {{ view('app.index', compact(['productos', 'licencia'])) }}
          </div>
        </div>
      </div>
    </section>


    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-b881"><div class="u-clearfix u-sheet u-sheet-1">
    	<label></label>
        <p class="u-small-text u-text u-text-variant u-text-1">
        	<b>{{ $licencia->nombre }}</b><br>
        	Desarrollado por Zorax
        </p>
      </div>
  	</footer>
    
  </body>
</html>
