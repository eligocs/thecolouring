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
		<!-- Favicon icon -->
		<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo.png') }}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
		<!-- Bootstrap Core CSS -->
		<link href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ URL::to('assets/plugins/html5-editor/bootstrap-wysihtml5.css') }}" rel="stylesheet" />
		<!--This page css - Morris CSS -->
		<link href="../assets/plugins/summernote/dist/summernote-bs4.css" rel="stylesheet" />
		<link href="{{ URL::to('assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">
		<!-- You can change the theme colors from here -->
		<link href="{{ URL::to('assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">
		<!-- You can change the theme colors from here -->
		<link href="{{ URL::to('assets/css/admin.css') }}" id="theme" rel="stylesheet">
		@stack('css')
        @livewireStyles
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
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
                    <a class="navbar-brand" href="{{ route('home') }}">
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
								<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('https://www.thecolouring.com/storage/app/public/'.Auth::user()->profile_photo_path) }}"
                                    class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{ asset('https://www.thecolouring.com/storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ route('profile.show') }}" class="btn btn-rounded btn-danger btn-sm">View
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
						<div class="profile-img"> <img src="{{ asset('https://www.thecolouring.com/storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" /> </div>
					@endif
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                                    class="hide-menu">Dashboard </span></a>
                        </li>
                        @if(Auth::user()->role == 'admin')
						<li> 
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-burst-mode"></i><span
                            class="hide-menu">Manage Media</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('svg.upload') }}">Media</a></li>
								<li><a href="{{ route('svg.category') }}">Category</a></li>
                            </ul>
                        </li>
						<li><a class="waves-effect waves-dark" href="{{ route('color') }}" aria-expanded="false"><i class="mdi mdi-water"></i><span
                                    class="hide-menu">Manage Color</span></a>
                        </li>
						<!--<li>
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-library-plus"></i><span
                            class="hide-menu">Manage Post</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ Url::to('blog/wp-admin/edit.php') }}">All Post</a></li>
                                 {{-- <li><a href="{{ route('editorpost') }}">Editor Post</a></li> --}}
								{{--<li><a href="{{ route('blog.category') }}">Category</a></li>--}}
								{{-- <li><a href="{{url('/cat_trashes')}}"><i class="fa fa-trash"></i>Trash</a></li>--}}
                            </ul>
                        </li>-->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-library-books"></i><span
                            class="hide-menu">Page Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('logo') }}">Logo</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('banner') }}">Banner Slider</a></li>
                            </ul>
                            {{-- <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('bannercard') }}">Banner Card</a></li>
                            </ul> --}}
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('welcome') }}">Welcome Section</a></li>
                            </ul>
                          
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('footer') }}">Footer</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('footericon') }}">Footer Icon</a></li>
                            </ul>   
                        </li>
						<li>
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-view-list"></i><span
                            class="hide-menu">Cms Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('about.page') }}">About</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('termsandcondition') }}">Terms & Conditions</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('privacyandpolicy') }}">Privacy & Policy</a></li>
                            </ul>
                        </li>
						<li><a class="waves-effect waves-dark" href="{{ route('users') }}" aria-expanded="false"><i class="mdi mdi-face-profile"></i><span
                                    class="hide-menu">Manage Users</span></a>
                        </li>
                        <!--<li><a class="waves-effect waves-dark" href="{{ route('editors') }}" aria-expanded="false"><i class="mdi mdi-marker"></i><span
                                    class="hide-menu">Manage Editors</span></a>
                        </li>-->
						<li><a class="waves-effect waves-dark" href="{{ route('contact-data') }}" aria-expanded="false"><i class="mdi mdi-message-processing"></i><span
                                    class="hide-menu">Contact Data</span></a>
                        </li>
                        <li>
                             <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span
                            class="hide-menu">SEO Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo-home') }}">Home</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo-about') }}">About</a></li>
                            </ul>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo-contact') }}">Contact</a></li>
                            </ul> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ Url::to('blog/wp-admin/edit.php') }}">Blog</a></li>
                            </ul> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo-sketches') }}">Sketches</a></li>
                            </ul> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo/termsandcondition') }}">Terms & Conditions</a></li>
                            </ul> 
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('seo/privacyandpolicy') }}">Privacy & Policy</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'editor')
                        {{-- <li> 
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-view-list"></i><span
                            class="hide-menu">Manage Media</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('svg.upload') }}">Media</a></li>
								<li><a href="{{ route('svg.category') }}">Category</a></li>
                            </ul>
                        </li>
						<li><a class="waves-effect waves-dark" href="{{ route('color') }}" aria-expanded="false"><i class="mdi mdi-broom"></i><span
                                    class="hide-menu">Manage Color</span></a>
                        </li> --}}
                        <li>
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-view-list"></i><span
                            class="hide-menu">Manage Post</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('show-post') }}">All Post</a></li>
								{{--<li><a href="{{ route('blog.category') }}">Category</a></li>--}}
                            </ul>
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
            <footer class="footer">
                © {{$logo->copyright}}
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
		<script src="{{ URL::to('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
		
        <script src="{{ URL::to('assets/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
        <script src="{{ URL::to('assets/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>
		<!-- ============================================================== -->
		<script>
			$(document).ready(function(){
			    
				setTimeout(function(){
				   $(".alert").remove();
				}, 3000 ); // 5 secs
				
					$('.viewPassword').on('click',function(){
				    var temp = $(this).closest('div').find('input').attr('type');
				    if(temp == 'password'){
				        $(this).closest('div').find('input').attr('type', 'text');
				    }else{
				        $(this).closest('div').find('input').attr('type', 'password');
				    }
				})

			});
		</script>
		@stack('js')
	</body>

</html>
