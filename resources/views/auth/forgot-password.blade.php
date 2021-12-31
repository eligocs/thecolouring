<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
    <!--- image section End --->   
<!--- login section Start --->   
<div class ="login_form">
    <div class="container  mx-auto form-container">
 <!--<div class="account-wrapper">-->
 <di
    <div class="row ">
        <div class="col-md-6 background-column ">
                <div class=" login-innercontent">    
                     <h2 class="title">Recover Password</h2>
                     <p>Enter your Email and instructions will be sent to you! </p>
                </div>
                <div class=" login-background">
                    <img src="{{ asset('userlogin/img/snow-bear.png') }}" alt="images">
                </div>
            </div>
            <div class="col-md-6 form-wrapper">
               
            	<x-jet-validation-errors class="mb-4" />
@if (session('status'))
					<div class="mb-4 font-medium text-sm text-green-600">
						{{ session('status') }}
					</div>
				@endif
         <form class="account-form" method="POST" action="{{ route('password.email') }}">
            @csrf

             <div class="form-group">
                 <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
             </div>
             <div class="form-group">
                 <button type="submit" class="d-block custom-button"><span>Reset</span></button>
             </div>
         </form>
            </div>
            <!-- coloumn 6 end -->
                
            
        <!--</div>-->
    </div>
</div>
</div>
</x-front-layout>