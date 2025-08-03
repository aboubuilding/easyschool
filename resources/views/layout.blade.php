<!DOCTYPE html>
<html lang="en" data-layout="horizontal">


<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/layout-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Apr 2025 21:56:23 GMT -->
<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('app')}}/assets/img/favicon.png">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('app')}}/assets/img/apple-touch-icon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/css/bootstrap.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/css/bootstrap-datetimepicker.min.css">

	<!-- animation CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/css/animate.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/select2/css/select2.min.css">

	<!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('app')}}/assets/css/dataTables.bootstrap5.min.css">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/daterangepicker/daterangepicker.css">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/tabler-icons/tabler-icons.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/fontawesome/css/all.min.css">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/plugins/%40simonwep/pickr/themes/nano.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{asset('app')}}/assets/css/style.css">
	<link rel="stylesheet" href="{{asset('app')}}/assets/css/mystyle.css">
        
        
        
        @yield('js')

</head>

<body class="menu-horizontal">

    <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

    @include('components.header')
    @include('components.sidebar')

		<div class="page-wrapper">


			@yield('contenu')

			@include('components.footer')

		</div>

	</div>
	<!-- /Main Wrapper -->



	<!-- jQuery -->
	<script src="{{asset('app')}}/assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>

    <!-- jQuery Validation plugin via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Feather Icon JS -->
	<script src="{{asset('app')}}/assets/js/feather.min.js" type="text/javascript"></script>

	<!-- Slimscroll JS -->
	<script src="{{asset('app')}}/assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{asset('app')}}/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

	<!-- Daterangepikcer JS -->
	<script src="{{asset('app')}}/assets/js/moment.min.js" type="text/javascript"></script>
	<script src="{{asset('app')}}/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

	<!-- Chart JS -->
	<script src="{{asset('app')}}/assets/plugins/chartjs/chart.min.js" type="text/javascript"></script>
	<script src="{{asset('app')}}/assets/plugins/chartjs/chart-data.js" type="text/javascript"></script>

	<!-- Select2 JS -->
	<script src="{{asset('app')}}/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>

	<!-- Chart JS -->
	<script src="{{asset('app')}}/assets/plugins/apexchart/apexcharts.min.js" type="text/javascript"></script>
	<script src="{{asset('app')}}/assets/plugins/apexchart/chart-data.js" type="text/javascript"></script>

	<!-- Datatable JS -->
		<script src="{{asset('app')}}/assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="{{asset('app')}}/assets/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>


	<!-- Color Picker JS -->
	<script src="{{asset('app')}}/assets/plugins/%40simonwep/pickr/pickr.es5.min.js" type="text/javascript"></script>

	<!-- Custom JS -->
	<script src="{{asset('app')}}/assets/js/theme-colorpicker.js" type="text/javascript"></script>
	<script src="{{asset('app')}}/assets/js/script.js" type="text/javascript"></script>

    <script>
        console.log('jQuery:', typeof jQuery);
        console.log('Validator:', typeof $.validator);
    </script>

	@yield('js')


</body>


</html>
