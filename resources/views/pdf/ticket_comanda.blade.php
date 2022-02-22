<!DOCTYPE html>
<html>
<head>
	<title>Comanda #{{ $factura->numero }}</title>
	<style>
		*{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			margin: 5px;
		}	
	</style>
</head>
<body>
	@if ($factura->licencia->get_imagen_public())
		<center>
			<img src="{{ $factura->licencia->get_imagen_public() }}" width="90" height="65">
		</center>
	@endif
	<center>
		<label><b style="font-size: 16px;">Comanda #{{ $factura->numero }}</b></label><br>
		@if ($factura->canal->id_dominio == App\Dominio::get('Mesa'))
			<label>Mesa {{ $factura->mesa->numero }}</label>
		@else
			<label>{{ $factura->canal->nombre }}</label>
		@endif
	</center><br>
	<table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
		<thead>
			<tr>
				<th style="text-align: center; width: 10%;">Cant</th>
				<th style="text-align: left; padding-left: 10px;">Producto</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($factura->detalles as $item)
				<tr>
					<td style="text-align: center;">{{ $item->cantidad }}</td>
					<td style="text-align: left; padding: 3px 3px 3px 10px; margin-bottom: 5px;">{{ ucfirst(strtolower(deleteTilds($item->nombre_producto))) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<label><b>Observaciones</b></label><br>
	<label>{{ $factura->observaciones != "" ? $factura->observaciones : "Ninguna" }}</label>
</body>
</html>

@php
	function deleteTilds($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", "Ñ", "ñ");
        $permitidas    = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "Ñ", "N");
        $texto         = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }
@endphp