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
												<input type="text" class="form-control form-control-line" wire:model="title">	
												@error('title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-group">
												<label>Description</label>
												<textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..." wire:model="description"></textarea>
												@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-success">@if($pageUid) Update @else Save @endif</button>
												<button type="button" class="btn btn-success" wire:click="cancel">Cancel</button>
											</div>
										</form>
									</div>
								</div>
							</div>
                </div>
