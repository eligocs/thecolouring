				<div class="row">
                    <div @if($show) class="col-lg-8" @else class="col-lg-12" @endif>
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
						@if($show)
						<button type="button" wire:click="close" class="btn btn-danger">Close</button>
						@else
						<button type="button" wire:click="show" class="btn btn-danger">Add</button>
						@endif
						<div class="row mt-2">
							@foreach ($files as $index => $row)
							<div class="col-lg-3 col-md-4">
								<div class="card" style="height:350px">
								  @php echo html_entity_decode($row->file); @endphp
								  <div class="card-body">
									<h5 class="card-title">{{ $row->name }}</h5>
									<button type="button" wire:click="updateForm({{ $row->id }})" class="btn btn-success"><span class="mdi mdi-pencil"></span></button>
									@if(\Auth::user()->role == 'admin')
									<!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">
                                      <span class="mdi mdi-delete"></span>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h3 class="text-center">Are you sure want to delete this image ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" wire:click="destroy({{ $row->id }})" class="btn btn-primary" data-dismiss="modal">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
									@endif
									<button type="button" data-id="{{ $row->id }}" data-toggle="modal" data-target="#svgmodal-{{$row->id}}" class="btn btn-success"><span class="mdi mdi-eye"></span></button>
								  </div>
								</div>
							</div>
							@endforeach
						</div>
						{{ $files->links() }}
                    </div>
                    @if($show)
					<div class="col-lg-4">
						<div class="row mt-2">
							@if($file_id)
							<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Update</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="update">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom06">Name</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom06" wire:model.lazy="update_file_name" placeholder="---"  required>
											  @error('update_file_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
												<label>Slug</label>
												<input type="text" class="form-control form-control-line" value="{{ Str::slug($update_file_name) }}" readonly>
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom07">Category</label>
											  <select class="form-control" wire:model.defer="update_category" required>
												  <option value="">select</option>
												  @foreach($file_category as $row)
													<option value="{{ $row->id }}">{{ $row->name }}</option>
												  @endforeach
											  </select>
											   @error('update_category') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom08">Meta Title</label>
											  <input type="text" class="form-control" wire:model.defer="update_title" style="text-transform:capitalize" id="validationCustom08"  placeholder="---" required>
											   @error('update_title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom09">Meta Description</label>
											  <textarea type="text" class="form-control" wire:model.defer="update_description" id="validationCustom09"  placeholder="---" required></textarea>
											   @error('update_description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom10">Image</label>
											  <input type="file" class="form-control" accept=".svg" id="validationCustom10" wire:model="attach" placeholder="---" required>
											   @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom021">Image Description</label>
											  <textarea type="text" class="form-control" wire:model.defer="update_image_description" id="validationCustom21"  placeholder="---" required></textarea>
											   @error('update_image_description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
										  </div>
										  <button class="btn btn-primary" type="submit">Update</button>
										</form>
									</div>
								</div>
							</div>
							@else	
								<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Add</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="create" enctype="multipart/form-data">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom01">Name</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom01" wire:model.lazy="file_name" placeholder="---" required>
											   @error('file_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
												<label>Slug</label>
												<input type="text" class="form-control form-control-line" value="{{ Str::slug($file_name) }}" readonly>
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom02">Category</label>
											  <select class="form-control" wire:model.defer="category" required>
												  <option value="">select</option>
												  @foreach($file_category as $row)
													<option value="{{ $row->id }}">{{ $row->name }}</option>
												  @endforeach
											  </select>
											   @error('category') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom03">Meta Title</label>
											  <input type="text" class="form-control" wire:model.defer="title" style="text-transform:capitalize" id="validationCustom03"  placeholder="---" required>
											   @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom04">Meta Description</label>
											  <textarea type="text" class="form-control" wire:model.defer="description" id="validationCustom04"  placeholder="---" required></textarea>
											   @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom05">Image</label>
											  <input type="file" class="form-control" accept=".svg" id="validationCustom05" wire:model="attach" placeholder="---" required>
											   @error('attach') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom20">Image Description</label>
											  <textarea type="text" class="form-control" wire:model.defer="imagedescription" id="validationCustom20"  placeholder="---" required></textarea>
											   @error('imagedescription') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
										  </div>
										  <button wire:loading.attr="disabled" class="btn btn-primary" type="submit">Save</button>
										</form>
									</div>
								</div>
							</div>
							@endif
						</div>
                    </div>
                    @endif
                    
                    
                     <div class="preloader wire-preloader" wire:loading wire:target="close">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="show">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="create">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="update">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="destroy">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="updateForm">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    
                    
                    
                    
                    
                    <!--SVG Modal -->
				@foreach ($files as $index => $row)
				<div class="modal fade" id="svgmodal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Image Preview</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<div class="col-lg-12">
								<div class="card" style="height:auto">
								  @php echo html_entity_decode($row->file); @endphp								  
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
				@endforeach
                </div>