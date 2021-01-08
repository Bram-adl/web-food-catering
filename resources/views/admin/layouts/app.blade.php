<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Dashboard | Senjani Kitchen</title>

	<!-- FAVICON -->
    <link rel="icon" href="img/logo-100.jpg" type="image/jpg">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- IonIcons -->
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('front-end-admin/css/adminlte.min.css') }}">
    
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper" id="app">
		@include('admin.layouts.partials.nav')

		@include('admin.layouts.partials.sidebar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
                    @yield('content-header')
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					@yield('main-content')
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		@include('admin.layouts.partials.footer')
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('front-end-admin/plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('front-end-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE -->
    <script src="{{ asset('front-end-admin/js/adminlte.js') }}"></script>
	<!-- Axios -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    
    @stack('scripts')
</body>
</html>