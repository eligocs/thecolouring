<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

	    @php 

			$logo = \App\Models\Logo::first();         

		@endphp

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Tell the browser to be responsive to screen width -->

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="description" content="">

		<meta name="author" content="">

		<title>{{ ($logo) ? $logo->title.' | '.$logo->description : '' }}</title>

		<!-- Favicon icon -->

		<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo.png') }}">

		<title>Thecolouring Login</title>

		<!-- Bootstrap Core CSS -->

		<link href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

		<!-- Custom CSS -->

		<link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

		<!-- You can change the theme colors from here -->

		<link href="{{ URL::to('assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>

		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

	<![endif]-->

	</head>

	

	<body>

		<!-- ============================================================== -->

		<!-- Preloader - style you can find in spinners.css -->

		<!-- ============================================================== -->

		<div class="preloader">

			<svg class="circular" viewBox="25 25 50 50">

				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

		</div>

		<!-- ============================================================== -->

		<!-- Main wrapper - style you can find in pages.scss -->

		<section id="wrapper" class="login-register login-sidebar" style="background-image:url({{ URL::to('userlogin/img/36596.jpg') }});">

			<div class="login-box card">

				<div class="card-body">

				<x-jet-validation-errors class="mb-4" />



				@if (session('status'))

					<div class="mb-4 font-medium text-sm text-green-600">

						{{ session('status') }}

					</div>

				@endif

				@if (!empty($msg)) 
					<div class="mb-4 font-medium text-sm text-green-600"> 
						{{ $msg }} 
					</div> 
				@endif

					<form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">

						@csrf

						<a href="javascript:void(0)" class="text-center db"><img src="{{ URL::to('userlogin/img/logo.jpg') }}" style="width:180px;height:120px" alt="Home" /></a>

						<div class="form-group m-t-40">

							<div class="col-xs-12">

								<x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="Username"/>

							</div>

						</div>

						<div class="form-group">

							<div class="col-xs-12">

								<x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>

							</div>

						</div>

						<div class="form-group text-center m-t-20">

							<div class="col-xs-12">
								
								<x-jet-button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
									
									{{ __('Log In') }}
									
								</x-jet-button>
								
							</div>
							
						</div>
						
					</form>

				



				</div>

			</div>

		</section>

		<!-- ============================================================== -->

		<!-- ============================================================== -->

		<!-- End Wrapper -->

		<!-- ============================================================== -->

<!-- ============================================================== -->

		<!-- All Jquery -->

		<!-- ============================================================== -->

		<script src="{{ URL::to('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap tether Core JavaScript -->

		<script src="{{ URL::to('assets/plugins/popper/popper.min.js') }} "></script>

		<script src="{{URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- slimscrollbar scrollbar JavaScript -->

		<script src="{{URL::to('assets/js/jquery.slimscroll.js') }}"></script>

		<!--Wave Effects -->

		<script src="{{URL::to('assets/js/waves.js') }}"></script>

		<!--Menu sidebar -->

		<script src="{{URL::to('assets/js/sidebarmenu.js') }}"></script>

		<!--stickey kit -->

		<script src="{{URL::to('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

		<script src="{{URL::to('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

		<!--Custom JavaScript -->

		<script src="{{URL::to('assets/js/custom.min.js') }}"></script>

		<!-- ============================================================== -->

		<!-- Style switcher -->

		<!-- ============================================================== -->

		<script src="{{URL::to('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

	</body>



</html>