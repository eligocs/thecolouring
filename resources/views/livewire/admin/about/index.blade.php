				<div class="row">
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
							<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<form class="needs-validation" novalidate @if($pageUid) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif>
											<div class="form-group">
												<label>Title</label>
												<input type="text" class="form-control form-control-line" wire:model.defer="title">	
												@error('title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-group" wire:ignore>
													<label>Description</label>
													<trix-editor x-data
        x-on:trix-change="$dispatch('input', event.target.value)" wire:model.debounce.365ms="description" class="wysiwyg-content"></trix-editor>
													@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-group">
											  <label for="validationCustom10">Image</label>
											  <input type="file" class="form-control" accept=".jpg,.png" id="validationCustom10" wire:model="photo" placeholder="---" required>
											   @error('photo') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											@if ($photo)
        Photo Preview:
        <img src="{{ $photo->temporaryUrl() }}" style="width:100px;height:100px">
    @elseif($old)
        Photo:
        <img src="{{ asset('storage/app/' . $old) }}" style="width:100px;height:100px">
        {{-- <img src="{{ asset('public/storage/' . $old) }}" style="width:100px;height:100px"> --}}
    @endif
											<div class="form-actions">
												<button type="submit" class="btn btn-success">@if($pageUid) Update @else Save @endif</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="preloader wire-preloader" wire:loading wire:target="photo">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="update">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                </div>
