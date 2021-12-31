@push('css')

<style>

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

</style>

@endpush

@php   
	$guest = Session::get('registered_guest'); 
	if(!empty($guest)){
		/* $user = DB::table('users')->where('id',Auth::user()->id)->update([   
			'email_verified_at' => null, 
		]);  */
			Session::forget('registered_guest');  
            Auth::logout(); 
            $msg = 'Verification email sent to you email id, kindly verify before login.';
            return view('page.front.auth.login',compact('msg')); 
		} 
@endphp

				<div class="row">

                    <div class="col-lg-8">

						@if (session()->has('message'))

							<div class="alert alert-success">

								{{ session('message') }}

							</div>

						@endif

						<div class="row el-element-overlay">

								@foreach ($files as $index => $files)

								<div class="col-lg-12 col-md-12 p-1">

									<div class="card export" id="printableArea">

										@php echo html_entity_decode($files->file); @endphp

									</div>

								</div>

								@endforeach

						</div>

                    </div>

					<div class="col-lg-4">

					        <button class="btn btn-primary" type="button" onclick="un()"><span class="mdi mdi-undo"></span></button>

                            <button class="btn btn-primary" type="button" onclick="re()"><span class="mdi mdi-redo"></span></button>

						<div class="row pl-lg-2 pt-1">

							<div class="card pallet-card">

								<div class="card-body p-b-0">

									<h4 class="card-title text-center">Colour Palette</h4>

								</div>

								<!-- Nav tabs -->

								<ul class="nav nav-tabs customtab" role="tablist">

									<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Primary Colour</span></a> </li>

									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Custom Colour</span></a> </li>

								</ul>

								<!-- Tab panes -->

								<div class="tab-content">

									<div class="tab-pane active pallets-dots" id="home2" role="tabpanel">

										@foreach ($color as $index => $color)

												<div class=" color m-1 color-pallet" style='background-color:{{ $color->code }};cursor: pointer;' data-color='{{ $color->code }}'></div>

										@endforeach

									</div>

									<div class="tab-pane  p-20" id="profile2" role="tabpanel">

										<h4>Pick Colour</h4>

										<input type="color" class="form-control" id="color-pallate-picker" placeholder="---">

									</div>

								</div>

							</div>

						</div>

						<div class="row mb-5 pl-lg-2 ">

							<button class="btn btn-primary" onclick="printDiv('printableArea')" type="button"><span class="mdi mdi-printer"></span></button>

							<button class="btn btn-primary ml-3 consave" type="button"><span class="mdi mdi-content-save"></span></button>

						</div>

                    </div>

                </div>

				<script>

					document.addEventListener('livewire:load', function () {

						$('.convert').on('click', function(){

							@this.file = $('.export').html();

						});

						$('.consave').on('click', function(){

							@this.file = $('.export').html();

							Livewire.emit('updated')

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