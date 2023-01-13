@extends('frontend.template.master')

@section('title', 'Iniciar Sesion')


@section('contenido')


    
@endsection

@section("js_code")
<script src="http://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script>
    Mercadopago.setPublishableKey("TEST-03019103-f3f9-48fe-8b4a-c5f4d5c228f8");
</script>
@endsection

