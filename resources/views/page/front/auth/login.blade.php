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

                     <h2 class="title">Login Page</h2>

                     <h5>Please enter your Email and Password to colour thousands of popular sketches and your favorite cartoon characters.</h5>

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

				@if (session('error'))

                    <div class="alert alert-danger">

                        {{ session('error')}}

                        <form action="{{ url('resendemail')}}" method="post">

                            @csrf

                            <input type="hidden" name="verify_id" value="{{Session::get('data')}}">

                          <button type=" submit" class="btn btn-danger">Resend Link</a>

                        </form>

                </div>

                @endif

                @if (session('success'))

					<div class="alert alert-success">

						{{ session('success') }}

					</div>

				@endif



         <form class="account-form" method="POST" action="{{ route('login') }}">

            @csrf



             <div class="form-group">

                 <input type="email" placeholder="Email" name="email" required >

             </div>

             <div class="form-group">

                 <input type="password" placeholder="Password" name="password" required >

             </div>

             <div class="filter-tags">

                    <input id="check-a3" type="checkbox" name="check">

                    <label for="check-a3">Remember me</label>

              </div>

             <div class="form-group">

                 <div class="d-flex justify-content-between flex-wrap pt-sm-2">

                     <a href="{{ route('password.request') }}">Forget Password?</a>

                 </div>

             </div>

             <div class="form-group">

                 <button class="d-block custom-button"><span>Submit Now</span></button>

             </div>

         </form>

         
         <div class="account-bottom">

             <span class="d-block cate pt-10 account_">Don’t Have any Account?  <a href="{{ url('user/register') }}">Sign Up</a></span>

              {{--<span class="or"><span>or</span></span>

             <h5 class="subtitle">Login With Social Media</h5>

             <div class="social_icons_login">       

                 <a href="{{ url('auth/facebook') }}">  <i class="fab fa-facebook-f"></i></a>

                 <a href="{{ url('auth/google') }}"> <i class="fab fa-google-plus-g"></i></a>

                 {{-- <a href="#"> <i class="fab fa-twitter"></i></a>

                 <a href="#"> <i class="fab fa-instagram"></i></a>

              </div> --}}

         </div>

            </div>

            <!-- coloumn 6 end -->

                

            

        <!--</div>-->

    </div>

</div>

</div>

</x-front-layout>