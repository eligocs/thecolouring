				<div class="row">
                    <div class="col-lg-12">
						@if (session()->has('message'))
							<div class="alert alert-success">
								{{ session('message') }}
							</div>
						@endif
						<div class="row">
						@if(!$files->isEmpty())
							@foreach ($files as $index => $files)
							<div class="col-lg-3 col-md-4">
								<div class="card">
								  @php echo html_entity_decode($files->file); @endphp
								  <div class="card-body">
									<h5 class="card-title">{{ $files->name }}</h5>
									<a href="{{ route('edit',$files->id) }}" class="btn btn-primary">Edit</a>
									@if($delete_file_id == $files->id)
										<button type="button" wire:click="destroy" class="btn btn-danger"><i class="far fa-trash-alt"></i> confirm</button>
									@else
										<button type="button" wire:click="confirm({{ $files->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i> delete</button>
									@endif
								  </div>
								</div>
							</div>
							@endforeach
						@else
							<h3>No Data Found</h3>
						@endif
						</div>
                    </div>
                </div>
