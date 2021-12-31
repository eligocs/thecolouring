<x-front-layout>
		<!-- ============================================================== -->
		<!-- Main wrapper - style you can find in pages.scss -->
		<section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/background/login-register.jpg);">
			<div class="login-box card">
				<div class="card-body">
				<x-jet-validation-errors class="mb-4" />

				@if (session('status'))
					<div class="mb-4 font-medium text-sm text-green-600">
						{{ session('status') }}
					</div>
				@endif
					<form class="form-horizontal form-material" method="POST" action="{{ route('register') }}">
						@csrf
						<a href="javascript:void(0)" class="text-center db"><img src="../assets/images/logo-icon.png" alt="Home" /><br/><img src="../assets/images/logo-text.png" alt="Home" /></a>
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Password"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<x-jet-button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
									{{ __('Register') }}
								</x-jet-button>
							</div>
						</div>
					</form>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
								<div class="social">
									<a href="{{ url('auth/facebook') }}"><button class="btn btn-facebook" data-toggle="tooltip" title="Register with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button></a>
									<a href="{{ url('auth/google') }}"><button class="btn btn-googleplus" data-toggle="tooltip" title="Register with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button></a>
								</div>
							</div>
						</div>
						<div class="form-group m-b-0">
							<div class="col-sm-12 text-center">
								Already have an account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a>
							</div>
						</div>
				</div>
			</div>
		</section>
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
</x-front-layout>