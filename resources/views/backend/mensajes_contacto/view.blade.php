@extends('backend.template.master')

@section('title', $title_page)

@section('style')
<style>
.ck-editor__editable {
    min-height: 400px;
}
</style>
@endsection

@section('contenido')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$title_page}}</h4>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ $link_controlador }}" class="{{$config_buttons['go_back']['class']}}">
                        <i class="{{$config_buttons['go_back']['icon']}}"></i> {{$config_buttons['go_back']['title']}}
                    </a>
                </div>
                <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre y Apellido</label>
                                        <p>{{$row_obj->nombre}} {{$row_obj->apellido}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Asunto</label>
                                        <p>{{$row_obj->asunto}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mensaje:</label>
                                        <p>{{$row_obj->mensaje}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

		</div>
    </div>
</div>

@endsection

@section("js_code")

<script type="text/javascript">


$(document).ready(function(){
    
    
});

@endsection