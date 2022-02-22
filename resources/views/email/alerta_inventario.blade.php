<!DOCTYPE html>
<html>
<head>
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
</head>
<body>
	<h1><b>Alerta inventario</b></h1>
	<p>El sistema <b>ZORAX</b> informa una alerta de inventario en el producto <b>{{ strtoupper($producto->nombre) }}</b>, debido a que la cantidad actual(<b>{{ $producto->cantidad_actual }}</b>) es igual o inferior a la cantidad minima de aviso configurada para el producto (<b>{{ $producto->cantidad_minimo_alerta }}</b>)</p>
</body>
</html>