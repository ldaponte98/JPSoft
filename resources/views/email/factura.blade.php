<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<style type="text/css">
	*{
		font-family: Arial, Helvetica, sans-serif;
	}
	.fondo{
		background-color: #ffffff;
		text-align: center;
		padding-top: 20px;
		padding-bottom: 20px;
		width: 100% !important;
	}
	.fondo h1{
		color: #ffffff;
	}
</style>
<body>
	<!--
	<div class="fondo">
		<center>
		<img id="img" src="{{ $imagen_licencia }}">
		</center>
	</div>
	<p><b>Su {{ $tipo_factura }} fue realizada exitosamente.</b><br> Para consultar su documento de evidencia presione <a target="_blank" href="{{ route('factura/imprimir', $id_factura) }}">aqui</a></p>
	-->
	@php
		$btn_descargar = true;
	@endphp
	{{ view('pdf.factura', compact('factura', 'btn_descargar')) }}

	

	</body>
	

</html>