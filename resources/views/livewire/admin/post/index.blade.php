				<div class="row">
                    <div class="col-12">
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
						@if($create)
                        <div class="card">
                            <div class="card-body"><button type="button" class="btn btn-success mb-2" wire:click="cancel">Back</button>
                                <form  class="needs-validation" novalidate @if($postUid) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control form-control-line"  wire:model.lazy="title">	
										@error('title') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" class="form-control form-control-line" value="{{ Str::slug($title) }}" readonly>
									</div>
									 <div class="form-group">
											<label>Category</label>
                                            <select class="form-control custom-select" wire:model.defer="category_name">
                                                  <option value="">--Select--</option>
												  @foreach($category as $row)
													<option value="{{ $row->name }}">{{ $row->name }}</option>
												  @endforeach
											</select>
											@error('category_name') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div  wire:ignore>
											<label>Description</label>
											<trix-editor x-data
        x-on:trix-change="$dispatch('input', event.target.value)" wire:model.debounce.365ms="description" class="wysiwyg-content"></trix-editor>
										    @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
									<div class="form-group">
                                        <label>Image upload</label>
                                        <input class="form-control form-control-line" type="file" wire:model="photo"> 
										@error('photo') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    @if ($photo)
                                        Photo Preview:
                                        <img style="width:100px;height:100px" src="{{ $photo->temporaryUrl() }}">
                                    @elseif($old)
                                        Photo:
                                        <img style="width:100px;height:100px" src="{{ asset('public/storage/' . $old) }}">
                                    @endif
									<h5><strong>Meta Data Setting</strong></h5>
									<div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control form-control-line"  wire:model.defer="meta_title">	
										@error('meta_title') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control form-control-line"  wire:model.defer="meta_description">	
										@error('meta_description') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-group">
                                        <label>Meta Keyword</label>
                                        <input type="text" class="form-control form-control-line"  wire:model.defer="meta_keyword">	
										@error('meta_keyword') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-group">
                                        <label>Alt Image Tag</label>
                                        <input type="text" class="form-control form-control-line" wire:model.defer="alt_image">	
										@error('alt_image') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-success">@if($postUid) Update @else Post @endif</button>
										<button type="button" class="btn btn-success" wire:click="cancel">Back</button>
									</div>
                                </form>
                            </div>
                        </div>
						@else
						<div class="form-actions">
							<button type="button" class="btn btn-success" wire:click="create"><i class="mdi mdi-plus-box"></i> Post</button>
						</div></br>
						 @if(Auth::user()->role == 'admin')
						@foreach($post as $index =>  $row)
						<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2"><img src="{{ asset('public/storage/' . $row->photo) }}" style="height:150px" class="img-fluid"/></div>
                                    <div class="col-lg-10 col-md-10">
										<a href="{{ route('slug',[$row->slug])}}"><h4 class="card-title">{{ custom_echo($row->title,200) }}</h4></a>
                                        <div id="slimtest1" style="height:150px">
											@php custom_echo(strip_tags($row->description), 300); @endphp
                                        </div>
										<button type="button" class="btn btn-primary">{{ $row-> created_at }}</button>
										<button type="button" class="btn btn-success" wire:click="updateForm({{ $row->id }})"><span class="mdi mdi-pencil"></span></button>
										<!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">
                                      <span class="mdi mdi-delete"></span>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h3 class="text-center">Are you sure want to delete this post ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" wire:click="destroy({{ $row->id }})" class="btn btn-primary" data-dismiss="modal">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
										<a class="btn btn-success" href="{{ route('slug',[$row->slug])}}" target="_blank"><span class="mdi mdi-eye"></span></a>
										
                                            @if($row->status == 'unpublish')
                                                <a class="btn btn-success" href="{{ url('publish/'.$row->id)}}">Publish</a>
                                            @else
                                                <a class="btn btn-danger" href="{{ url('unpublish/'.$row->id)}}">Unpublish</a>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
						@endif
						@if(Auth::user()->role == 'editor')
						@foreach($mypost as $index =>  $row)
						<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2"><img src="{{ asset('public/storage/' . $row->photo) }}" style="height:150px" class="img-fluid"/></div>
                                    <div class="col-lg-10 col-md-10">
										<h4 class="card-title">{{ custom_echo($row->title,200) }}</h4>
                                        <div id="slimtest1" style="height:150px">
											@php custom_echo(strip_tags($row->description), 300); @endphp
                                        </div>
										<button type="button" class="btn btn-primary">{{ $row-> created_at }}</button>
										<button type="button" class="btn btn-success" wire:click="updateForm({{ $row->id }})">Edit</button>
										@if($postId == $row->id)
											<button type="button" class="btn btn-danger" wire:click="destroy">Confirm</button>
										@else
											<button type="button" class="btn btn-danger" wire:click="delete({{ $row-> id }})">Delete</button>
										@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
						{{ $post->links() }}
						@endif
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="create">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="updateForm">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="confirm">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="update">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="store">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="cancel">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="destroy">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                </div>
				