<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
    <!--- image section End --->   
<!--- login section Start --->   
<div class ="login_form">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<div class="container  mx-auto form-container">
    <!--<div class="account-wrapper">-->
    <div class="row ">
        <div class="col-md-6 background-column ">
                <div class=" login-innercontent">    
                     <h3 class="title">Register Just in 2 Minutes!</h3>
                     <h4>Includes:</h4>
                     <ul class="register-bullets">
                         <li>100% free profile (No Cost Ever)</li>
                         <li>Colour Endless Drawings</li>
                         <li>Access your all Drawing in Dashboard</li>
                         <li>Send Coloured Pictures to Your Family and Friends</li>
                         <li>You can Take Print-outs of any Image</li>
                         <li>See your name and drawing appear in Homepage</li>
                         <li>Get Free E-book (as a Gift)</li>
                     </ul>
                     <h4>Keep on Colouring forever!!!</h4>
                </div>
                <!--<div class=" login-background register-image">-->
                <!--    <img src="{{ asset('userlogin/img/snow-bear.png') }}" alt="images">-->
                <!--</div>-->
            </div>
            <div class="col-md-6 form-wrapper">
               <x-jet-validation-errors class="mb-4" />
                <form class="account-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Name" value="{{ old('name') }}" name="name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" value="{{ old('email') }}" name="email" required>
                    </div>
                <div class="form-group">
                        <input type="password" required placeholder="Password" name="password">
                        <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" required>
                        <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
                    </div>
                    {{--<div class="filter-tags">
                                            <input id="check-a3" type="checkbox" name="check">
                                            <label for="check-a3">Remember me</label>
                                         </div> --}}
                    <div class="ter">
                        <input type="checkbox"  name="terms" value="terms check" required >&nbsp;I Accept The <a href="{{ url('termsconditions') }}">T&C</a> And <a href="{{ url('policies') }}">Privacy Policy</a>.
                    </div>
                    <div class="form-group">
                        <button class="d-block custom-button"><span>Get Started Now</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate account_">Are you a member? <a href="{{ url('user/login') }}">LogIn</a></span>
                   {{-- <span class="or"><span>or</span></span>
                    <h5 class="subtitle">Register With Social Media</h5>
                    <div class="social_icons_login">       
                       <a href="{{ url('auth/facebook') }}">  <i class="fab fa-facebook-f"></i></a>
                       <a href="{{ url('auth/google') }}"> <i class="fab fa-google-plus-g"></i></a>
                         <a href="#"> <i class="fab fa-twitter"></i></a>
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