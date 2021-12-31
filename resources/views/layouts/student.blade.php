<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

	@php 

			$logo = \App\Models\Logo::first();         

		@endphp

        <title>{{ ($logo) ? $logo->title.' | '.$logo->description : '' }}</title>



        <!-- Fonts -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

		<!-- Favicon icon -->

		<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo.png') }}">

        <!-- Styles -->

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

		<link rel ="stylesheet" href="{{ asset('front/style/style.css') }}">

		<!-- Bootstrap Core CSS -->

		<link href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

		<!--This page css - Morris CSS -->

		<link href="{{ URL::to('assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">

		<!-- Custom CSS -->

		<link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

		<!-- You can change the theme colors from here -->

        <link href="{{ URL::to('assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">

        <!-- Custom css for child -->

		<link href="{{ URL::to('assets/css/colors/child.css') }}" rel="stylesheet">

        @livewireStyles

        <!-- Scripts -->

        <script src="{{ mix('js/app.js') }}" defer></script>

        @stack('css')

    </head>

	 
    <body class="fix-header fix-sidebar card-no-border">

	<!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->

    <!-- ============================================================== -->

    <div class="preloader">

        <svg class="circular" viewBox="25 25 50 50">

            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

    </div>

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <div id="main-wrapper">

        <!-- ============================================================== -->

        <!-- Topbar header - style you can find in pages.scss -->

        <!-- ============================================================== -->

        <header class="topbar">

            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <!-- ============================================================== -->

                <!-- Logo -->

                <!-- ============================================================== -->

                <div class="navbar-header">

                    <a class="navbar-brand" href="/">

                        <!-- Logo icon --><b>

                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                            <!-- Dark Logo icon -->

                            <img src="{{ asset('upload/cms/'.$logo->logo) }}" alt="homepage" style="height:70px;width:100%" class="dark-logo" />

                            <!-- Light Logo icon -->

                            <img src="{{ asset('upload/cms/'.$logo->logo) }}" alt="homepage" style="height:70px;width:100%" class="light-logo" />

                        </b>

                        <!--End Logo icon -->

                        <!-- Logo text -->

                    </a>

                </div>

                <!-- ============================================================== -->

                <!-- End Logo -->

                <!-- ============================================================== -->

                <div class="navbar-collapse">

                    <!-- ============================================================== -->

                    <!-- toggle and nav items -->

                    <!-- ============================================================== -->

                    <ul class="navbar-nav mr-auto mt-md-0">

                        <!-- This is  -->

                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"

                                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>

                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"

                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                        <!-- ============================================================== -->

                    </ul>

                    <!-- ============================================================== -->

                    <!-- User profile and search -->

                    <!-- ============================================================== -->

                    <ul class="navbar-nav my-lg-0">

                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- Profile -->

                        <!-- ============================================================== -->

                        <li class="nav-item dropdown">

                             @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

								{{-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown"

                                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('public/storage/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}"

                                    class="profile-pic" /></a> --}}

                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown"

                                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('https://www.thecolouring.com/storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}"

                                    class="profile-pic" /></a>

                            <div class="dropdown-menu dropdown-menu-right scale-up">

                                <ul class="dropdown-user">

                                    <li>

                                        <div class="dw-user-box">

                                            <div class="u-img"><img src="{{ asset('https://www.thecolouring.com/storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="user"></div>
											 
                                            <div class="u-text">

                                                <h4>{{ Auth::user()->name }}</h4>

                                                <p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ route('my-profile') }}" class="btn btn-rounded btn-danger btn-sm">View

                                                    Profile</a>

                                            </div>
										 

                                        </div>

                                    </li>

                                    <li>

										<!-- Authentication -->

										<form method="POST" action="{{ route('logout') }}">

											@csrf

											<a href="{{ route('logout') }}" onclick="event.preventDefault();

																			this.closest('form').submit();"><i class="fa fa-power-off"></i> Logout</a>

										</form>

									</li>

                                </ul>

                            </div>

							@endif

                        </li>

                    </ul>

                </div>

            </nav>

        </header>

        <!-- ============================================================== -->

        <!-- End Topbar header -->

        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <!-- ============================================================== -->

        <aside class="left-sidebar">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                <!-- User profile -->

                <div class="user-profile" style="background: url(../assets/images/background/user-info.jpg) no-repeat;">

                    <!-- User profile image -->

					@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

						<div class="profile-img"> <img src="{{ asset('public/storage/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" /> </div>

					@endif

                </div>

                <!-- End User profile text-->

                <!-- Sidebar navigation-->

                <nav class="sidebar-nav">

                    <ul id="sidebarnav">
						@php $guest = Session::get('guest_id'); @endphp
						@if(!empty($guest))
						<li><a class="waves-effect waves-dark" href="{{ route('drawings') }}" aria-expanded="false"><i class="mdi mdi-marker"></i><span 
							class="hide-menu">Draw Images</span></a> 
						</li>
						@else

						
						<li><a class="waves-effect waves-dark" href="{{ route('my-drawings') }}" aria-expanded="false"><i class="mdi mdi-burst-mode"></i><span

                                    class="hide-menu">My Drawings</span></a>

                        </li>
						<li><a class="waves-effect waves-dark" href="{{ route('drawings') }}" aria-expanded="false"><i class="mdi mdi-marker"></i><span

                                    class="hide-menu">Draw Images</span></a>

                        </li>

						<li><a class="waves-effect waves-dark" href="{{ route('my-profile') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span

                                    class="hide-menu">My Profile</span></a>

                        </li>

						<li><a class="waves-effect waves-dark" href="{{ route('change-password') }}" aria-expanded="false"><i class="mdi mdi-lock"></i><span

                                    class="hide-menu">Change Password</span></a>

                        </li>

						<li>

							<!-- Authentication -->

										<form method="POST" action="{{ route('logout') }}">

											@csrf

											<a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();

																			this.closest('form').submit();"><i style="font-size:21px" class="mdi mdi-power"></i> <span

                                    class="hide-menu">Logout</span></a>

										</form>

                        </li>

						@endif

                    </ul>

                </nav>

                <!-- End Sidebar navigation -->

            </div>

            <!-- End Sidebar scroll-->

        </aside>

        <!-- ============================================================== -->

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

			{{ $slot }}

			<!-- footer -->

            <!-- ============================================================== -->

            <footer class="footer child-footer">

                <p>© {{$logo->copyright}}</p>

            </footer>

            <!-- ============================================================== -->

            <!-- End footer -->

            <!-- ============================================================== -->

		</div>

		@stack('modals')



		@livewireScripts

		<!-- ============================================================== -->

		<!-- End Wrapper -->

		<!-- ============================================================== -->

		<!-- ============================================================== -->

		<!-- All Jquery -->

		<!-- ============================================================== -->

		<script src="{{ URL::to('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap tether Core JavaScript -->

		<script src="{{ URL::to('assets/plugins/popper/popper.min.js') }}"></script>

		<script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- slimscrollbar scrollbar JavaScript -->

		<script src="{{ URL::to('assets/js/jquery.slimscroll.js') }}"></script>

		<!--Wave Effects -->

		<script src="{{ URL::to('assets/js/waves.js') }}"></script>

		<!--Menu sidebar -->

		<script src="{{ URL::to('assets/js/sidebarmenu.js') }}"></script>

		<!--stickey kit -->

		<script src="{{ URL::to('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

		<script src="{{ URL::to('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

		<!--Custom JavaScript -->

		<script src="{{ URL::to('assets/js/custom.min.js') }}"></script>

		<!-- ============================================================== -->

		<script>

			$(document).ready(function(){

			    
			 
					
				 

			 

				 
				

				setTimeout(function(){

				   $(".alert").remove();

				}, 3000 ); // 5 secs



			});

			$('.viewPassword').on('click',function(){

				    var temp = $(this).closest('div').find('input').attr('type');

				    if(temp == 'password'){

				        $(this).closest('div').find('input').attr('type', 'text');

				    }else{

				        $(this).closest('div').find('input').attr('type', 'password');

				    }

				})

		</script>

				  <script>

			 $(document).ready(function () {

			     

			     

		         $('.categorySelcted').on('change',function(){

			    	var id = $(this).val(); 

			    	window.location.href = '{{url("/drawings?id=")}}'+id;

				}); 

				

				

				

				

				

				 var itemsMainDiv = ('.MultiCarousel');

				 var itemsDiv = ('.MultiCarousel-inner');

				 var itemWidth = "";

			 

				 $('.leftLst, .rightLst').click(function () {

					 var condition = $(this).hasClass("leftLst");

					 if (condition)

						 click(0, this);

					 else

						 click(1, this)

				 });

			 

				 ResCarouselSize();

			 

			 

			 

			 

				 $(window).resize(function () {

					 ResCarouselSize();

				 });

			 

				 //this function define the size of the items

				 function ResCarouselSize() {

					 var incno = 0;

					 var dataItems = ("data-items");

					 var itemClass = ('.item');

					 var id = 0;

					 var btnParentSb = '';

					 var itemsSplit = '';

					 var sampwidth = $(itemsMainDiv).width();

					 var bodyWidth = $('body').width();

					 $(itemsDiv).each(function () {

						 id = id + 1;

						 var itemNumbers = $(this).find(itemClass).length;

						 btnParentSb = $(this).parent().attr(dataItems);

						 itemsSplit = btnParentSb.split(',');

						 $(this).parent().attr("id", "MultiCarousel" + id);

			 

			 

						 if (bodyWidth >= 1200) {

							 incno = itemsSplit[1];

							 itemWidth = sampwidth / incno;

						 }

						 else if (bodyWidth >= 992) {

							 incno = itemsSplit[2];

							 itemWidth = sampwidth / incno;

						 }

						 else if (bodyWidth >= 768) {

							 incno = itemsSplit[1];

							 itemWidth = sampwidth / incno;

						 }

						 else {

							 incno = itemsSplit[0];

							 itemWidth = sampwidth / incno;

						 }

						 $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });

						 $(this).find(itemClass).each(function () {

							 $(this).outerWidth(itemWidth);

						 });

			 

						 $(".leftLst").addClass("over");

						 $(".rightLst").removeClass("over");

			 

					 });

				 }

			 

			 

				 //this function used to move the items

				 function ResCarousel(e, el, s) {

					 var leftBtn = ('.leftLst');

					 var rightBtn = ('.rightLst');

					 var translateXval = '';

					 var divStyle = $(el + ' ' + itemsDiv).css('transform');

					 var values = divStyle.match(/-?[\d\.]+/g);

					 var xds = Math.abs(values[4]);

					 if (e == 0) {

						 translateXval = parseInt(xds) - parseInt(itemWidth * s);

						 $(el + ' ' + rightBtn).removeClass("over");

			 

						 if (translateXval <= itemWidth / 2) {

							 translateXval = 0;

							 $(el + ' ' + leftBtn).addClass("over");

						 }

					 }

					 else if (e == 1) {

						 var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();

						 translateXval = parseInt(xds) + parseInt(itemWidth * s);

						 $(el + ' ' + leftBtn).removeClass("over");

			 

						 if (translateXval >= itemsCondition - itemWidth / 2) {

							 translateXval = itemsCondition;

							 $(el + ' ' + rightBtn).addClass("over");

						 }

					 }

					 $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');

				 }

			 

				 //It is used to get some elements from btn

				 function click(ell, ee) {

					 var Parent = "#" + $(ee).parent().attr("id");

					 var slide = $(Parent).attr("data-slide");

					 ResCarousel(ell, Parent, slide);

				 }

			 

			 });

		  </script>

		@stack('js')

	</body>



</html>

