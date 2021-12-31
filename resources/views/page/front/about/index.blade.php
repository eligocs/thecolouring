<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
      <!--- top Section Start--->    
	     <div class="top_image_blog" style="background : url({{ asset('userlogin/img/kid-sketching.jpg') }})">   
		   <!--<img src="{{ asset('userlogin/img/1920x730_slide2.jpg') }}" alt="images">-->
		   <h1> About Us </h1>
		    
		   </div>
<!---OUR MISSION Section Start---> 

   <div class="background">
      <div class="continer container-width pm-main-continer contact-form-container">
          <div class="inner-main-content-division">
            <div class="row">
               <div class="col-md-6">
                  <div class="mission_image">
                      <img src="{{ asset('storage/app/' . $content ->photo) }}" alt="">
                     {{-- <img src="{{ asset('public/storage/' . $content ->photo) }}" alt=""> --}}
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mission_text">
                     <h3>{{ $content ->title }}</h3>
                     <p>{!! $content->description !!}</p>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
	<!---OUR MISSION Section Start---> 
</x-front-layout>