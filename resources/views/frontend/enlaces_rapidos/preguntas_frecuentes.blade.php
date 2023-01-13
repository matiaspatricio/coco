@extends('frontend.template.master')

@section('title', 'Preguntas frecuentes')

@section('contenido')
<div class="ps-page--single">
    <div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li>Preguntas frecuentes</li>
        </ul>
    </div>
    </div>
    <div class="ps-faqs">
    <div class="container">
        <div class="ps-section__header">
        <h1>Preguntas frecuentes</h1>
        </div>
        <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table--faqs">
            <tbody>
                <tr>
                <td class="heading" rowspan="3">
                    <h4>ENVÍOS</h4>
                </td>
                <td class="question"> ¿Qué métodos de envío están disponibles?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Envían internacionalmente?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Cuánto tiempo llevará obtener mi paquete?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="heading" rowspan="2">
                    <h4>PAGOS</h4>
                </td>
                <td class="question"> ¿Qué métodos de pago se aceptan?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Es seguro comprar en línea?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="heading" rowspan="5">
                    <h4>PEDIDOS Y DEVOLUCIONES</h4>
                </td>
                <td class="question"> ¿Cómo hago un pedido?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Cómo puedo cancelar o cambiar mi pedido?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Necesito una cuenta para hacer un pedido?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
                <tr>
                <td class="question">¿Cómo hago el seguimiento de mi pedido?</td>
                <td>Respuesta aquí .....................</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
    <div class="ps-call-to-action">
    <div class="container">
        <h3>Estamos aquí para ayudar !<a href="{{url('/contacto')}}"> Contactanos</a></h3>
    </div>
    </div>
</div>

@endsection

@section("js_code")

<script>
</script>

@endsection