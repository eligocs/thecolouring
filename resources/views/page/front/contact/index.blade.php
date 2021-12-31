<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
      <!--- top Section Start--->   
      <div class="top_image_blog" style="background : url({{ asset('userlogin/img/little-kid-colouring.jpg') }})">
         <!--<img src="" alt="images">-->
         <h1> Contact Us </h1>
      </div>
      <!--- top Section End---> 
      <div class="background-contact">
         <div class="container  pm-main-continer contact-form-container">
            <div class="inner-main-content-division">  
               <div class="row mx-auto d-flex align-items-start">
                  <div class="col-md-4 side-bar-icons">

                   <h3>Contact Us</h3>
                      <!-- icon section start -->
                  
                     <div class="icons-box style-2">		
                        <div class="icons-wrap">

                          {{--  <div class="icons-item">
                              <div class="item-box">
                                  <div class="item-box-img">
                                   <img src="{{ asset('userlogin/img/phone.png') }}" alt="Phone">
                                   </div>
                                   <div class="item-box-content">
                                 <h5 class="icons-box-title">
                                    <a href="#">Phone</a>
                                 </h5>
                                 <p> <a href="tel:+91989898761">{{ isset($template->phone) ? $template->phone : ''}}</a></p>
                                 </div>
                              </div>
                           </div> --}}
                        </div>

                     </div>
                  
                  <!-- icon section end -->
                   
                    <!-- icon section start -->
                    
                     <div class="icons-box style-2">		
                        <div class="icons-wrap">
{{-- 
                           <div class="icons-item">
                              <div class="item-box">
                                  <div class="item-box-img"> 
                                <img src="{{ asset('userlogin/img/email.png') }}" alt="Phone">
                                </div>
                                   <div class="item-box-content">
                                 <h5 class="icons-box-title">
                                    <a href="#">Email</a>
                                 </h5>
                                 <p><a href='no-reply@thecolouring.com'> {{ isset($template->email) ? $template->email : ''}}</a></p>
                                  </div>
                              </div>
                           </div> --}}
                        </div>

                     </div>
                  
                  <!-- icon section end -->
                   <!-- icon section start -->
                  @php   
			$social = \App\Models\Footersocial::get();        
			@endphp
                     <div class="icons-box style-2">		
                        <div class="icons-wrap">

                           <div class="icons-item">
                              <div class="item-box">
                                  <div class="item-box-img">
                                   <img src="{{ asset('userlogin/img/social.png') }}" alt="Phone">
                                   </div>
                                   <div class="item-box-content">
                                     <h5 class="icons-box-title">
                                        <p>Stay Connected</p>
                                     </h5>
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
                 
                  <!-- icon section end -->
                  </div>
                  <!--col-sm-4 side-bar-icons end  -->
                  <div class="col-md-8">
                     <!--- contact form start ---->
                     <div class="contact_divide_section">
                        <div class="container-fluid">
                           <div class="form-heading mb-10">
                              <h2>We Love To Hear From You</h2>
                           </div>
                                 @livewire('front.contact.index')
                              
                        </div>
                     </div>
                     <!--- contact form start--- ---->
                  </div>
                  <!-- col-sm-8 end -->
               </div>

               <!-- row -->
            </div>
            <!-- inner-main-content-division -->
         </div>
         <!-- pm-main-continer closed -->
      </div>
      <!-- background division closed -->
</x-front-layout>