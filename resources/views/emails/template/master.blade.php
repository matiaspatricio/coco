<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') -  {{Config("app.name")}}</title>

	<style type="text/css">
		
		.btn:not(:disabled):not(.disabled) {
			cursor: pointer;
		}
		.demo .btn, .demo .progress {
			margin-bottom: 15px !important;
		}
		.btn-round {
			border-radius: 100px !important;
		}
		.btn-primary {
			background: #1572e8 !important;
			border-color: #1572e8 !important;
		}
		.btn {
			padding: .65rem 1.4rem;
			font-size: 14px;
			opacity: 1;
			border-radius: 3px;
		}
		.btn-primary {
			color: #fff;
			background-color: #007bff;
			border-color: #007bff;
		}
		.btn {
			display: inline-block;
			font-weight: 400;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
			padding: .375rem .75rem;
			font-size: 1rem;
			line-height: 1.5;
			border-radius: .25rem;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
	</style>
</head>
<body>

<div width="100%" style="height: 90px;">
	<table width="100%" >
		<tr>
			<td width="100%" >
				<img src="https://i.ibb.co/L8NDGfd/logo.png" height="80">
			</td>
		</tr>
	</table>
</div>
<div style="height: 5px;background-color: #37436c"></div>

@section("contenido")

@show


<div width="100%" style="background-color: #777;height: 40px;margin-top: 10px;padding-top: 10px;text-align: right;padding-right: 20px;">

	@if(trim(Config("app.faceboook_link")) != "")
	<a href="{{Config('app.faceboook_link')}}"><img src="https://i.ibb.co/G5KNyvm/facebook.png"></a>
	@endif

	@if(trim(Config("app.instagram_link")) != "")
	<a href="{{Config('app.instagram_link')}}"><img src="https://i.ibb.co/KXd15s4/instagram.png"></a>
	@endif
		
</div>

</body>
</html>