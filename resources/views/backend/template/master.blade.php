<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="robots" content="noindex" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="<?php echo csrf_token() ?>">
	<title>@yield("title") - {{Config("app.name")}}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/admin/assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('/admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo  asset('/admin/assets/css/fonts.min.css')?>']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/admin/assets/css/atlantis.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('/admin/assets/css/demo.css') }}">

	<!-- CSS COLOR PICKER -->
	<link rel="stylesheet" href="{{ asset('/admin/assets/js/plugin/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') }}">

	@section("style")
	@show
</head>
<body>
	<div class="wrapper">
	@include("backend.template.navbar")

	@include("backend.template.sidebar")

	@section("contenido")
	@show

	<!--   Core JS Files   -->
	<script src="{{ asset('/admin/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('/admin/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('/admin/assets/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('/admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/admin/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('/admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('/admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('/admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('/admin/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('/admin/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('/admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('/admin/assets/js/atlantis.min.js') }}"></script>

	<!-- COLOR PICKER JS -->
	<script src="{{ asset('/admin/assets/js/plugin/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>

	
	
	@section("modals")
	@show

	@include("backend.template.my_loading_modal")
	@include("backend.template.my_modals_sweet")

	<script>
    	// FIX MODALS BOOTSTRAP 4
		$(document).on('hidden.bs.modal', function (event) {
		if ($('.modal:visible').length) {
			$('body').addClass('modal-open');
		}
		});

		$(document).ready(function(){
			$('.colorpicker').colorpicker();
			$('.colorpicker').attr("readonly",true);
		});
		// END FIX
	</script>

	@section("js_code")
	@show
</body>
</html>