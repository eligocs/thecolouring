<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
		<link rel ="stylesheet" href="{{ asset('front/style/style.css') }}">
		<link rel ="stylesheet" href="{{ asset('front/style/search.css') }}">
		<style>
			.activeclass{
				background-color: #ffbd0a;
                padding: 5px 20px;
                border-radius: 5px;
                color: #fff;
				}
				.unique-svg-container {
                    width: 100%;
                       max-width: 700px;
                    text-align: center;
                    margin: 0 auto;
                    }
                    .top-bar:before{
                    position: absolute;
                    height: 4px;
                    width: 100%;
                    top: 0;
                    background-repeat: no-repeat;
                    content: "";
                    display: block;
                    background: url("{{ asset('front/img/rainbowstripe.jpg') }}") repeat-x;
                }
               .unique-svg-btn{
                   margin: 0px auto 20px !important;
               }
            </style>
	@endpush
		<!-- hero section start -->
		<div class="top_image_blog" style="background: url({{ asset('userlogin/img/1920x730_slide2.jpg') }})">   
		   <h1>{{ isset($image->name) ? $image->name : ''}}</h1>
		</div>
		<div class="background pt-5">
      <div class="container container-width pm-main-continer">
         <div class="inner-main-content-division">
		    
    		<!-- hero section end -->
    		<div class="container container-width sketches-container">
        		<div class="row">
                   <div class="unique-svg-container">
                       <div class="img-fluid mx-auto d-block svg-shadow" >
                            @php if($image){ echo html_entity_decode($image->file); }  @endphp
                        </div>
                        
						     @if(\Auth::check())
    						    @if(\Auth::user()->role != 'admin')
        						 <div class="unique-svg-btn">
        						     <a href="{{ url('draw/'.$image->id) }}">Fill Colour</a>
        						 </div>
        						 @endif
    						 @else
							 <p>{{ isset($image->image_description) ? $image->image_description : ''}}</p> 
							 <h5 class='descStyle'>To fill Colour on this Image you need to Login or Register first</h5>
								 <div class="  btn-wrap"> 
									<div class="unique-svg-btn" style="max-width:150px; width:100%;">
									<a href="https://thecolouring.com/user/register" class="nav-item nav-link slash"> <i class="fa fa-address-card" aria-hidden="true"></i> Register </a>
									</div>
									<div class="unique-svg-btn"  style="max-width:150px; width:100%;">
									<a href="https://thecolouring.com/user/login" class="nav-item nav-link"><i class="fa fa-user" aria-hidden="true"></i> Login </a>
									</div>
								</div>
								
						    @endif 
						    
                   </div>
        		</div>
    		</div>
		</div>

     </div>
        </div>
</div>

</x-front-layout>