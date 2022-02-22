@extends('layout.main')
@php
 $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('content')
<script>
    $(document).ready(()=>{
        document.getElementById("index").style.height = (screen.height - 340)+"px"
    })
</script>
    <div id="index"></div>
@endsection