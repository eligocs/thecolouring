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
										<form class="needs-validation" novalidate @if($meta_title) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif>
											<div class="form-group">
												<label>Meta Title</label>
												<input type="text" class="form-control form-control-line" wire:model.defer="meta_title">	
												@error('meta_title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-group">
												<label>Meta Description</label>
												<input type="text" class="form-control form-control-line" wire:model.defer="meta_description">	
												@error('meta_description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-group">
												<label>Meta Keyword</label>
												<input type="text" class="form-control form-control-line" wire:model.defer="meta_keyword">	
												@error('meta_keyword') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-success">@if($meta_title) Update @else Save @endif</button>
											</div>
										</form>
									</div>
								</div>
							</div>
                </div>
