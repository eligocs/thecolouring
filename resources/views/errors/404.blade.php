<x-front-layout>
		<!-- ============================================================== -->
		<!-- Main wrapper - style you can find in pages.scss -->
		<!--<section id="wrapper" class="login-register login-sidebar" style=<section id="wrapper" class="error-page">-->
		<!--	<div class="error-box">-->
		<!--		<div class="error-body text-center">-->
		<!--			<h1 class="text-info">404</h1>-->
		<!--			<h3 class="text-uppercase">Page Not Found !</h3>-->
		<!--			<p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>-->
		<!--			<a href="{{ URL::to('/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>-->
		<!--		<footer class="footer text-center">© 2018 Material Pro.</footer>-->
		<!--	</div>-->
		<!--</section>-->
		<section id="wrapper" class="login-register login-sidebar error-page">
		    <div class="container">
		    <div class="row">
		        <div class="col-md-6">
        			<div class="error-box">
        				<div class="error-body text-center">
        					<h1 class="error-404">40<span>4</span></h1>
        					<h3 class="text-uppercase">Page Not Found !</h3>
        					<p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
        					<a href="{{ URL::to('/') }}" class=" btn-color btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        				<!--<footer class="footer text-center">© 2018 Material Pro.</footer>-->
        			</div>
    			</div>
    			<div class="col-md-6">
    			    <div class="error-img">
    			        <img style="width:100%;" src="{{ asset('userlogin/img/penguin.png') }}" alt="images">
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