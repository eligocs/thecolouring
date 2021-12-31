@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	form.account-form {
    margin-top: 20px;
}
	.signup_form.form_d_none {
    background: #ffeb8952;
    padding: 14px;
}
	.login_form.form_d_none {
    background: #1e88e529;
    padding: 14px;
}
	a.login_register {
    color: #b3b3b3;
}
.spinner-border { 
	width: 20px;
	height: 20px;
}
.term_policy{
	opacity: 1;
}
.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
button.btn.btn-primary.open_login.darkcolor {
    background: #a1370f;
}
 
button.btn.google_bg {
    background: #f05a21;
    color: white;
}
button.btn.open_signup.email_bg {
    background: #1ea5e5;
    color: white;
}
span.text-red {
    color: #ff5555;
}

/* .export {

   cursor: url('https://img.icons8.com/emoji/40/000000/pencil-emoji.png'), pointer;            

} */

body.fix-header.fix-sidebar.card-no-border {

    background: url(" {{ asset('assets/watermark.png') }}");

    background-repeat: repeat-x;

    width: 100%;

    background-size: cover ;

	height: 100%;

}

@media print {

  html, body {-webkit-print-color-adjust: exact; height:100%;background-repeat:no-repeat}

}

/* @page {

	size:A4 portrait;

    margin-left: 0px;

    margin-right: 0px;

    margin-top: 0px;

    margin-bottom: 0px;

    margin: 0;

    -webkit-print-color-adjust: exact;

} */



@media(max-width:767px){

    .ab_main_row {

    flex-direction: column-reverse;

    margin-top: 20px;

}



}

</style>

@endpush

<div class="row ab_main_row">

                    <div class="col-lg-8">

						@if (session()->has('message'))

							<div class="alert alert-success">

								{{ session('message') }}

							</div>

						@endif

						<div class="row el-element-overlay test">

								@foreach ($files as $index => $row)

								<div class="col-lg-12 col-md-12 p-1">

									<div class="card export" id="printableArea" style="cursor:pointer">

										@php echo html_entity_decode($row->file); @endphp

									</div>

								</div>

								@endforeach

						</div>

						

						<div class="row">

							<div class="main-cartoon-caontainer child-dash-slide">

							  <!--- Famous cartoon end--->    

							  <!--- Famous cartoon slider start ---> 

							  <div class="container">

								 <div class="row">

									<div class="MultiCarousel" data-items="1,3" data-slide="1" id="MultiCarousel1" data-interval="1000">

									   <div class="MultiCarousel-inner crousel-cartoon-cl" style="transform: translateX(0px);">

									       @foreach($other as $ot)

										  <div class="item" style="width: 190px;">

											 <div class="pad15">

											    @php echo html_entity_decode($ot->file); @endphp

												<a href="{{ url('draw/'.$ot->id) }}" ><p class="lead">{{ $ot->name }}</p></a>

											 </div>

										  </div>

										  @endforeach 

									  

									   </div>

									   <button class="btn  leftLst over"><i class="fa fa-angle-left" aria-hidden="true"></i></button>

									   <button class="btn  rightLst"><i class="fa fa-angle-right" aria-hidden="true"></i></button>

									</div>

								 </div>

							  </div>

							 </div>

						</div>

                    </div>

					<div class="col-lg-4">

					        

						    <button class="btn btn-primary" type="button" onclick="un()"><span class="mdi mdi-undo"></span> Undo</button>

                            <button class="btn btn-primary" type="button" onclick="re()"><span class="mdi mdi-redo"></span> Redo</button>

						<div class="row pl-lg-2 pt-1">

							<div class="card pallet-card">

								<div class="card-body p-b-0">

									<h4 class="card-title text-center">Color Palette</h4>

								</div>

								<!-- Nav tabs -->

								<ul class="nav nav-tabs customtab" role="tablist">

									<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Primary Color</span></a> </li>

									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Custom Color</span></a> </li>

								</ul>

								<!-- Tab panes -->

								<div class="tab-content">

									<div class="tab-pane active pallets-dots" id="home2" role="tabpanel">

										@foreach ($color as $index => $color)

												<div class=" color m-1 color-pallet" style='background-color:{{ $color->code }};cursor: pointer;' data-color='{{ $color->code }}'></div>

										@endforeach

									</div>

									<div class="tab-pane  p-20" id="profile2" role="tabpanel">

										<h4>Pick Color</h4>

										<input type="color" class="form-control" id="color-pallate-picker" placeholder="---">

									</div>

								</div>

							</div>

						</div>

						

						<div class="row mb-5 pl-lg-2 ">
							@php $guest = Session::get('guest_id'); @endphp
							@if(empty($guest))
						    <a style="color:white" onclick="printDiv('printableArea')" class="btn btn-primary"><span class="mdi mdi-printer"></span> Print</a>
							@endif
							{{-- <button class="btn btn-primary convert" type="button"><span class="mdi mdi-printer"></span></button> --}}
							@if(empty($guest))
								<button class="btn btn-primary ml-3 consave" type="button"><span class="mdi mdi-content-save"></span> Save</button>
							@else
								<button class="btn btn-primary ml-3 register_before_save" data-toggle='modal' data-target='#register_signup'  type="button"><span class="mdi mdi-content-save"></span> Save</button>
							@endif

						</div>

                    </div>

                </div>

				<div id="register_signup" class="modal fade" role="dialog">
					<div class="modal-dialog"> 
					   
					  <div class="modal-content">
						<div class="modal-header"> 
							<h4 class="modal-title text-left">
								Guest user detected, Register/Login to save your image...
							</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<h2><a href='#' class='login_register' style='color:#1e88e5' data-target='signup_form'>Register</a> / <a href='#' class='login_register' data-target='login_form'>Login</a></h2>
							<br>
							
							<div class='signup_form form_d_none'> 
								 <h4 class="modal-title text-left">
									 {{-- <button class='btn  open_signup email_bg'> Email</button> &nbsp; --}}
									  
								 {{-- 	<button class='btn btn-primary open_login'> Login</button>  --}}
								 </h4>
								 <br>
								<input type="hidden" class='form-control' value="{{$this->name}}" name="svg_name" required > 
									<div class="form-group"> 
										<input type="text" class='form-control' autocomplete="off" placeholder="Name" value="" name="name" > 
									</div> 
									<div class="form-group"> 
										<input type="email" style="display: none;"> 
										<input type="email" class='form-control' autocomplete="off" placeholder="Email" value="" name="email" > 
									</div> 
									<div class="form-group"> 
										<input type="password" style="display: none;"> 
										<input type="password" class='form-control' autocomplete="off"  placeholder="Password" name="password"> 
										<i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i> 
									</div> 
									<div class="form-group"> 
										<input type="password" class='form-control' autocomplete="off" placeholder="Confirm Password" name="password_confirmation" > 
										<i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i> 
									</div> 
									<div class="ter"> 
										<input type="checkbox"  name="terms" value="terms check term_policy"  >&nbsp;I Accept The <a href="{{ url('termsconditions') }}">T&C</a> And <a href="{{ url('policies') }}">Privacy Policy</a>. 
									</div> 
								 
									<div class="form-group"> 
										<button class="d-block custom-button btn btn-info register_new_user"><span class='xchange'>
											Sign up</span>
										</button>  
									</div> 
										<br>
									<div class="form-group"> 
										<button class='btn   google_bg hide_registerform google_login'> <i class="fa fa-google" aria-hidden="true"></i> oogle </button>  &nbsp;
										<button class='btn btn-info  hide_registerform facebook_login'> <i class='fa fa-facebook'></i> acebook</button> &nbsp;
									</div> 
								 
							 
							 </div>

							 <div class='login_form form_d_none' style='display:none;'>
								<form class="account-form"   action="#"> 
									@csrf 
									<input type="hidden" class='form-control' value="{{$this->name}}" name="svg_name" required > 
									 <div class="form-group"> 
										 <input type="email" class='form-control' placeholder="Email" id='loginemail' name="email" required > 
										</div> 
									 <div class="form-group"> 
										 <input type="password" class='form-control' placeholder="Password" id='loginpassword' name="password" required > 
									 </div> 
									 <div class="filter-tags"> 
										 <input id="check-a3" class='form-control' type="checkbox" name="check"> 
											<label for="check-a3">Remember me</label> 
									  </div> 
									  <div class="form-group"> 
										 {{-- <div class="d-flex justify-content-between flex-wrap pt-sm-2"> 
											 <a href="{{ route('password.request') }}">Reset</a> 
										 </div>  --}}
										</div> 
									 <div class="form-group"> 
										 <button class="d-block custom-button btn btn-primary Login-button"><span>Log in </span></button> 
									</div> 
									<br>
									<div class="form-group"> 
										<button class='btn   google_bg hide_registerform google_login'> <i class="fa fa-google" aria-hidden="true"></i> oogle </button>  &nbsp;
										<button class='btn btn-info  hide_registerform facebook_login'> <i class='fa fa-facebook'></i> acebook</button> &nbsp;
									</div> 
									</form>
								</div>
								
								
								
							</div>
						<div class="modal-footer">
							
						</div>
					  </div>
				  
					</div>
				  </div>

                @push('js')
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">


					$(document).ready(function(){


						$('.login_register').click(function(){ 
							var id = $(this).data('target');
							$('.login_register').css({'color':'#b3b3b3'});
							$(this).css({'color':'#1e88e5'});
							$('.form_d_none').hide();
							$('.'+id).show();
						});


						$('.hide_registerfo rm').click(function(){  
							$('.login_form').hide();
							$('.signup_form').hide();
							$('.loader_form').show();
						});
						$('.open_login').click(function(){ 
							$('.login_form').show();
							$('.signup_form').hide();
						});
						$('.open_signup').click(function(){ 
							$('.xchange').html('Sign up');
							$('.login_form').hide();
							$('.signup_form').show();
							$('.loader_form').hide();
						});
						

						$('.google_login').click(function(e){ 
							e.preventDefault();
							$('.google_login').html('<div class="spinner-border" role="status"><span class="sr-only"></span></div>');
							var svg_name = $('input[name="svg_name"]').val();
							var svg = $('.export').html(); 
							if(svg && svg){
									$.ajax({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										type: 'POST',
										url: '{{url("student/guest_svg_session")}}',
										data: {svg_name:svg_name,svg:svg}, 
										success: function(response){
											if(response.status == 1){ 
												 window.location.href = "{{url('auth/google')}}";
											}  
											$('.google_login').html('<i class="fa fa-google" aria-hidden="true"></i> oogle');
										},
										error: function(xhr, textStatus, errorThrown) {
											console.log('error');
										}
									});
								}
						});
						$('.facebook_login').click(function(e){ 
							e.preventDefault();
							$('.facebook_login').html('<div class="spinner-border" role="status"><span class="sr-only"></span></div>');
							var svg_name = $('input[name="svg_name"]').val();
							var svg = $('.export').html(); 
							if(svg && svg){
									$.ajax({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										type: 'POST',
										url: '{{url("student/guest_svg_session")}}',
										data: {svg_name:svg_name,svg:svg}, 
										success: function(response){
											if(response.status == 1){ 
												 window.location.href = "{{url('auth/facebook')}}";
											}  
											$('.facebook_login').html('<i class="fa fa-facebook" aria-hidden="true"></i> acebook');
										},
										error: function(xhr, textStatus, errorThrown) {
											console.log('error');
										}
									});
								}
						});
						
						
						$('.register_before_save').click(function(){
							$('input[name="email"]').val('');
						});

						$('input').keyup(function(){
							$('.text-red').remove();
						});
							 
						$('.Login-button').click(function(){ 
							var main_this = $(this);
						
							var email = $('#loginemail').val();
							var password = $('#loginpassword').val();
							var svg_name = $('input[name="svg_name"]').val();
							var err = 0;  
							if(!email){
								$('#loginemail').parent().before('<span class="text-red">Required</span>');
								err = 1;
							}
							if(!password){
								$('#loginpassword').parent().before('<span class="text-red">Required</span>');
								err = 1;
							} 
							var svg = $('.export').html(); 
							console.log(err);
							if(err == 0){
								$('.Login-button').html('<div class="spinner-border" role="status"><span class="sr-only"></span></div>');
								main_this.attr('disabled',true);
								$.ajax({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										type: 'POST',
										url: '{{url("student/login_guest")}}',
										data: {email:email,password:password,svg_name:svg_name,svg:svg}, 
										success: function(response){
											$('.Login-button').html('Log In'); 
											main_this.attr('disabled',false);
											if(response.status == 1){ 
												$('.loader_form').hide();
												@this.file = $('.export').html(); 
												@this.uid = response.user_id; 
												//Livewire.emit('created');
												swal({
													title: "Image Saved Successfully", 
													icon: "success",
													button: "Ok",
												}).then((willDelete) => {
													if (willDelete) { 
														window.location.href = '{{url("my-drawings")}}';
													} 
												}); 
											}else if(response.status == 3){
												swal({
													title: "Credentials do not match our records,try again !!!", 
													icon: "warning",
													button: "Ok",
												}); 
											}
										},
										error: function(xhr, textStatus, errorThrown) {
											console.log('error');
										}
									});
							}
						});
						

						$('.register_new_user').click(function(e){
							e.preventDefault();
							
							/* $('.loader_form').show(); */
							var main_this = $(this);
							
							var name = $('input[name="name"]').val();
							var email = $('input[name="email"]').val();
							var password = $('input[name="password"]').val();
							var svg_name = $('input[name="svg_name"]').val();
							var password_confirmation = $('input[name="password_confirmation"]').val();
							var err = 0; 
							if(name == ''){
								$('input[name="name"]').parent().before('<span class="text-red">Required</span>');
								err = 1;
							}
							if(!email){
								$('input[name="email"]').parent().before('<span class="text-red">Required</span>');
								err = 1;
							}
							if(!password){
								$('input[name="password"]').parent().before('<span class="text-red">Required</span>');
								err = 1;
							}
							if(!password_confirmation){
								$('input[name="password_confirmation"]').parent().before('<span class="text-red">Required</span>');
								err = 1;
							}
							var svg = $('.export').html(); 
							if(err == 0){
								$('.xchange').html('<div class="spinner-border" role="status"><span class="sr-only"></span></div>');
								main_this.attr('disabled',true);
								if(password == password_confirmation){
									$.ajax({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										type: 'POST',
										url: '{{url("student/register_guest")}}',
										data: {name:name,email:email,password:password,password_confirmation:password_confirmation,svg_name:svg_name,svg:svg}, 
										success: function(response){
											$('.xchange').html('Sign up'); 
											if(response.status == 1){ 
												main_this.attr('disabled',false);
												$('.loader_form').hide();
												@this.file = $('.export').html(); 
												@this.uid = response.user_id; 
												//Livewire.emit('created');
												swal({
													title: "Account Registered Successfully, Verify your email before login", 
													icon: "success",
													button: "Ok",
												}).then((willDelete) => {
													if (willDelete) { 
														window.location.href='{{"/login"}}';
													} 
												}); 
											}else if(response.status == 3){
												swal({
													title: "Email account already exist !!!", 
													icon: "warning",
													button: "Ok",
												}); 
											}
										},
										error: function(xhr, textStatus, errorThrown) {
											console.log('error');
										}
									});
								}else{
									$('input[name="password_confirmation"]').before('<span class="text-red">Password mismatch</span>')
								} 
							}
						});
					});

				
						
					

                       {{-- document.addEventListener('DOMContentLoaded', function () {

    						$('.convert').on('click', function(){

    							@this.file = $('.export').html();

    						});

    						$('.consave').on('click', function(){

    							@this.file = $('.export').html();

    							Livewire.emit('created')

    						});

    					}) --}}

    					    document.addEventListener('DOMContentLoaded', function () {

    						$('.convert').on('click', function(){

    							@this.file = $('.export').html();

    						});

    						$('.consave').on('click', function(){

    							@this.file = $('.export').html();

    							Livewire.emit('created')

    						});

    					})



						function printDiv(divName) {

						var printContents = document.getElementById(divName).innerHTML;

						var originalContents = document.body.innerHTML;



						document.body.innerHTML = printContents;



					  	window.print();



						document.body.innerHTML = originalContents;

					}

			    	</script>

				@endpush