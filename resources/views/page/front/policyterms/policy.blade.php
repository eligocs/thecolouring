<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
      <!--- top Section Start--->    
	     <div class="top_image_blog" style="background : url({{ asset('userlogin/img/kid-sketching.jpg') }})">   
		   <!--<img src="{{ asset('userlogin/img/1920x730_slide2.jpg') }}" alt="images">-->
		   <h1> Privacy & Policies </h1>
		    
		   </div>
<!---OUR MISSION Section Start---> 

   <div class="background">
      <div class="continer container-width pm-main-continer contact-form-container">
          <div class="inner-main-content-division">
            <div class="row">
                  <div class="mission_text">
                     <h3>{{ isset($policy->title) ? $policy->title : '' }}</h3>
                     <p>{!! isset($policy->description) ? $policy->description : '' !!}</p>
                  </div>               
            </div>
            </div>
         </div>
      </div>
	<!---OUR MISSION Section Start---> 
</x-front-layout>