			
			<div>
				@if (session()->has('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if (session()->has('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
					<form wire:submit.prevent="create">
					<div class="c_form_container">	
						<div class="form-group">
							<!-- <label for="name">Name</label> -->
							<input type="text" class="form-control" id="name" wire:model.defer="name" placeholder="name">
							@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
						</div>
						<div class="form-group">
							<!-- <label for="exampleInputEmail1">Email address</label> -->
							<input type="email" class="form-control" id="exampleInputEmail1" wire:model.defer="email" aria-describedby="emailHelp" placeholder="Enter email">
							@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
						</div> 
						{{-- <div class="form-group">
							<!-- <label for="phone">Phone</label> -->
							<input type="text" class="form-control" id="phone" wire:model.defer="phone" maxlength="12" minlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" placeholder="phone">
							@error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
						</div> --}}
					</div>
						
						<div class="form-group">
							<!-- <label for="exampleInputEmail1">Email address</label> -->
							<input type="text" class="form-control" id="exampleInputSubject" wire:model.defer="subject"  placeholder="Enter Subject">
							@error('subject') <span class="error text-danger">{{ $message }}</span> @enderror
						</div>
					  <div class="form-group">
						<!-- <label for="exampleFormControlTextarea1">Message</label> -->
						<textarea class="form-control" id="exampleFormControlTextarea1" wire:model.defer="message" rows="3"></textarea>
						@error('message') <span class="error text-danger">{{ $message }}</span> @enderror
					  </div>
					  <x-jet-button wire:loading.attr="disabled" wire:target="create" class="btn btn-primary btn_crouser2_btn">
                            {{ __('Submit') }}
                        </x-jet-button>
					</form>
				</div>