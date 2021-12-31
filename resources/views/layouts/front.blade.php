<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Tell the browser to be responsive to screen width -->

		@php 

			$logo = \App\Models\Logo::first();   

		@endphp

		<!-- <title> @if($pageTitle) {{ ($logo) ? $pageTitle.' | '.$logo->title : '' }} @else {{ ($logo) ? $logo->title.' | '.$logo->description : '' }} @endif </title> -->

		<!--title> @if($pageTitle) {{ ($logo) ? $pageTitle.' | '.$logo->title : '' }} @else {{ isset($seo->meta_description) ? $seo->meta_description : '' }}  @endif </title--> 

		<title> @if($pageTitle) {{ ($logo) ? $pageTitle.' | '.$logo->title : '' }} @else {{ isset($seo->meta_title) ? $seo->meta_title : '' }} @endif</title>

	

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="title" content="{{ isset($seo->meta_title) ? $seo->meta_title : '' }}">

		<meta name="description" content="{{ isset($seo->meta_description) ? $seo->meta_description : '' }}">

		<!-- <meta name="keyword" content="{{ isset($seo->meta_keyword) ? $seo->meta_keyword : '' }}">-->

		<!-- Favicon icon -->

		<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo.png') }}">

		<!-- Styles -->

        <link rel ="stylesheet" href="{{ asset('front/style/style.css') }}">

        <link rel ="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"

         integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

         @stack('css')

		 @livewireStyles


@php  
 if (isset($_COOKIE['isGuest']) && !empty(Session::get('guest_id'))){
	if(time() - Session::get('lastActivityTime') >= 7200){ //guest session for 2hr
		$guest = Session::get('guest_id');
		if(!empty($guest)){
			DB::table('users')->where('email',$guest)->delete();
			Session::forget('lastActivityTime'); 
			Session::forget('guest_id'); 
		}
		 Auth::logout();  
	} 	
	 if(time() - Session::get('lastActivityTime') >= 86400){ //guest cookie for 1 day
		\Cookie::queue(\Cookie::forget('isGuest'));
	 } 
}
@endphp
        <!-- Scripts -->

        @php if($logo->headerscript){echo $logo->headerscript; } @endphp

	</head>

	

	<body>

		@php if($logo->footerscript){echo $logo->footerscript; } @endphp 

		     <div class="top-bar">

				 <div class="container header-container">

				  <nav class="navbar navbar-expand-lg navbar-light align-items-center">

					 <div class="logo_img"> 

					 <a class="navbar-brand" href="/">   @if($logo) <img src="{{ asset('upload/cms/'.$logo->logo) }}" alt="Online Coloring">@endif </a>

						  </div>

				 

				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

					 <span class="navbar-toggler-icon"></span>

				  </button>

				   <div class="collapse navbar-collapse" id="navbarNav">

						 <ul class="navbar-nav mx-auto">

							<li class="nav-item">

							<a href="/" class="nav-item nav-link home-link">Home</a>

							</li>

							<li class="nav-item">

							<a href="{{ route('about') }}" class="nav-item nav-link">About</a>

							</li>

							<li class="nav-item">

							<a href="/blog" class="nav-item nav-link">Blog</a>

							</li>

							<li class="nav-item">

							<a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>

							</li>

						 </ul>

						 @if(\Auth::user())

						 @if(Session::get('lastActivityTime') && Request::segment(2) !='register')
							<span class="navbar-text">

								<a href="{{ route('user.register') }}" class="nav-item nav-link slash"> <i class="fa fa-address-card" aria-hidden="true"></i> Register </a>

							</span>
						 @endif

						 <span class="navbar-text">

							 <a href="{{ (Auth::user()->role == 'student') ? route('my-drawings') : route('dashboard') }}" class="nav-item nav-link"> <i class="fa fa-address-card" aria-hidden="true"></i>My Dashboard </a>

						 </span>


						 @else

						 <span class="navbar-text">

							 <a href="{{ route('user.register') }}" class="nav-item nav-link slash"> <i class="fa fa-address-card" aria-hidden="true"></i> Register </a>

						 </span>

						 <span class="navbar-text">

							 <a href="{{ route('user.login') }}" class="nav-item nav-link slash"><i class="fa fa-user" aria-hidden="true"></i> Login </a>

						 </span>

						 <span class="navbar-text">

							 <a href="{{ route('user.guest') }}" class="nav-item nav-link"><i class="fa fa-user" aria-hidden="true"></i> Guest </a>

						 </span>

						 @endif

				  </div>

				</nav>

				</div>

			   </div>

            {{ $slot }}

			@php 

			$footer = \App\Models\Footer::first();    

			$social = \App\Models\Footersocial::get();        

			@endphp

			<div class="footer">

				<div class="footer_icons_section">

				   <div class="container">

				  <div class="row">

						{{-- <div class="col-md-6">

							<div class="footer-contact icons">

								<i class="fas fa-mobile-alt"> </i><p>{{ isset($footer->phone) ? $footer->phone : ''}}<br> <a class="mail" href="mailto:#" class="link-text">{{ isset($footer->email) ? $footer->email : ''}} </a></p>

							</div>

						</div> --}}

						<div class="col-md-12">

							<div class="footer-contact icons">

								<i class="fas fa-share-alt"></i> 

								<div class="social_icons_footer">     

								@foreach($social as $row)

								    @if($row->social_id ==1)

								        <a href="{{ $row->link }}" target="_blank">  <i class="fab fa-facebook-f"></i></a>

								    @endif

								    @if($row->social_id ==2)

								        <a href="{{ $row->link }}" target="_blank"> <i class="fab fa-google-plus-g"></i></a>

								    @endif

								    @if($row->social_id ==3)

								        <a href="{{ $row->link }}" target="_blank"> <i class="fab fa-twitter"></i></a>

								   @endif

								   @if($row->social_id ==4)

								        <a href="{{ $row->link }}" target="_blank"> <i class="fab fa-instagram"></i></a>

								   @endif

								@endforeach

								</div>

							</div>

						</div>

					 </div>

				   </div>

				</div>

				<div class="images_border"> </div>

				<div class="container-fluid">

				   <div class="row">

					  <div class="col-md-12">

						 <div class="footer_nav">

							{{-- <a href="{{ Url::to('/') }}"> Home </a> <a href="{{ route('about') }}">About </a> <a href="{{ route('contact') }}"> Contact  Us </a> <a href="{{ route('blog') }}"> Blog </a> --}}

							<a href="{{ url('termsconditions') }}"> Terms & Conditions </a> <a href="{{ url('policies') }}"> Privacy </a> <a href="{{ url('sitemap.xml') }}"> Sitemap </a>

							<p class='footer_text'>TheColouring.com - is a super entertaining website for all age group: kids and adults, for girls and boys, toddlers and teenagers, preschoolers or older children at school. Select a colouring page that you would like to colour from a selection of 1000 images or sketches. You can find here free printable coloring pages for your kids or for any school activity. Here you will find smooth and detailed patterns of every image. We have advanced drawings of all categories such as vegetables, fruits, animals, cars, cartoons and lots more. In short, it's a simple, free but effective colouring book which can be used for illustrations and you can also take print-outs (printable pictures). Bring your child mind to a new degree of realism!</p>

							<p class="copywrite"> © {{$logo->copyright}} All Rights Reserved </p>

						 </div>

					  </div>

				   </div>

				</div>

			 </div>

			 <style>p.footer_text {

    margin: 30px 50px;

    font-size: 12px; }</style>

		<!-- ============================================================== -->

		<!-- All Jquery -->

			@stack('modals')



			@livewireScripts

		  <script src="https://use.fontawesome.com/87d3e2c6f7.js"></script>

		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		  <script>

		   $('.viewPassword').on('click',function(){

				    var temp = $(this).closest('div').find('input').attr('type');

				    if(temp == 'password'){

				        $(this).closest('div').find('input').attr('type', 'text');

				    }else{

				        $(this).closest('div').find('input').attr('type', 'password');

				    }

				})

			 $(document).ready(function () {

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

			 $(function(){

				var current = location.pathname;

				$('#navbarNav li a').each(function(){

					if(current == '/'){

						$('.home-link').addClass('active');

					}else{

						var $this = $(this);

						// if the current path is like this link, make it active

						if($this.attr('href').indexOf(current) !== -1){

							$this.addClass('active');

						}

					}

				})

			})

		  </script>

		                         <script>

                        $('#carouselExample').on('slide.bs.carousel', function (e) {

                        var $e = $(e.relatedTarget);

                        var idx = $e.index();

                        var itemsPerSlide = 4;

                        var totalItems = $('.carousel-item-new').length;

                        if (idx >= totalItems-(itemsPerSlide-1)) {

                        var it = itemsPerSlide - (totalItems - idx);

                        for (var i=0; i<it; i++) {

                        // append slides to end

                        if (e.direction=="left") {

                        $('.carousel-item-new').eq(i).appendTo('.carousel-inner');

                        }

                        else {

                        $('.carousel-item-new').eq(0).appendTo('.carousel-inner');

                        }

                        }

                        }

                        });

                        $('#carouselExample').carousel({ 

                        interval: 2000

                        });

                        $(document).ready(function() {

                        /* show lightbox when clicking a thumbnail */

                        $('a.thumb').click(function(event){

                        event.preventDefault();

                        var content = $('.modal-body');

                        content.empty();

                        var title = $(this).attr("title");

                        $('.modal-title').html(title);        

                        content.html($(this).html());

                        $(".modal-profile").modal({show:true});

                        });

                        });

                        </script>

                        <script>

                           var slideIndex = 1;

                           showSlides(slideIndex);

                           

                           function plusSlides(n) {

                              showSlides(slideIndex += n);

                           }

                           

                           function currentSlide(n) {

                              showSlides(slideIndex = n);

                           }

                           

                           function showSlides(n) {

                              var i;

                              var slides = document.getElementsByClassName("mySlides");

                              var dots = document.getElementsByClassName("dot");

                              if (n > slides.length) {slideIndex = 1}    

                              if (n < 1) {slideIndex = slides.length}

                              for (i = 0; i < slides.length; i++) {

                                 slides[i].style.display = "none";  

                              }

                              for (i = 0; i < dots.length; i++) {

                                 dots[i].className = dots[i].className.replace(" active", "");

                              }

                              slides[slideIndex-1].style.display = "block";  

                              

                           }

                        </script>

		  @stack('js')

	</body>



</html>