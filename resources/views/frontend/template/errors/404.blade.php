@extends('frontend.template.master')

@section('title', 'Error 404')

@section('contenido')


<div class="container-fluid">

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-6" style="text-align:center;">
            
            <div class="card">
                <div class="card-header">
                    <h2>¿Por qué está viendo esta página?</h2>
                </div>
                <div class="card-body">
                    <p>La página a la que está solicitando ingresar, no existe.</p>
                    <p>Puede volver al inicio haciendo <a href="{{ url('/') }}">Click Aquí</a></p>
                </div>
            </div>

        </div>
    </div>
</div>
			
@endsection