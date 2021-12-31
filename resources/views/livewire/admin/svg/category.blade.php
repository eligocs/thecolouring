				<div class="row">
                    <div class="col-lg-8">
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
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table color-table primary-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>View On Front</th>
                                                @if(\Auth::user()->role == 'admin')<th>Action</th>@endif
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($category as $index => $categorys)
												<tr>
													<td>{{ $index+1 }}</td>
													<td>{{ $categorys->name }}</td><td>@if($categorys->front)
														@if($viewid == $categorys->id)
															<button type="button"  wire:click="frontremove" class="btn btn-danger">Confirm</button>
															@else
															<button type="button"  wire:click="remove({{  $categorys->id }})" class="btn btn-info">Remove</button>
															@endif
															@else
															@if($count < 5)
															<button type="button"  class="btn btn-primary" wire:click="view({{ $categorys->id }})">Show</button>@endif
															@endif</td>
															@if(\Auth::user()->role == 'admin')
													<td>
														<button type="button" wire:click="updateForm({{ $categorys->id }})" class="btn btn-success"><span class="mdi mdi-pencil"></span></button>
															<!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $categorys->id }}">
                                                              <span class="mdi mdi-delete"></span>
                                                            </button>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $categorys->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                  <div class="modal-body">
                                                                    <h3 class="text-center">Are you sure want to delete this category ?</h3>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" wire:click="destroy({{ $categorys->id }})" class="btn btn-primary" data-dismiss="modal">Delete</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
													</td>
													@endif
												</tr>
											@endforeach
                                        </tbody>
                                    </table>
									{{ $category->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4">
						<div class="row">
							@if($category_id)
							<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Edit</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="update">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom02">Category</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom02" wire:model.defer="update_category_name" placeholder="---"  required>
											  @error('update_category_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom03">Meta Title</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom03" wire:model.defer="meta_title" placeholder="---"  required>
											  @error('meta_title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom04">Meta Description</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom04" wire:model.defer="meta_description" placeholder="---"  required>
											  @error('meta_description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom05">Meta Keyword</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom05" wire:model.defer="meta_keyword" placeholder="---"  required>
											  @error('meta_keyword') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
										  </div>
										  <button class="btn btn-primary" type="submit">Update</button>
										  <button class="btn btn-primary" wire:click="clear" type="button">Cancel</button>
										</form>
									</div>
								</div>
							</div>
							@elseif($view)
							    <div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Show On Front</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="front">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom021">Number Of Images</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom021" wire:model.defer="number" placeholder="---"  required>
											  @error('number') <span class="error text-danger">{{ $message }}</span> @enderror
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
										<form method="post" class="needs-validation" novalidate wire:submit.prevent="create">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom01">Category</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom01" wire:model.defer="category_name" placeholder="---" required>
											   @error('category_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom03">Meta Title</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom03" wire:model.defer="meta_title" placeholder="---"  required>
											  @error('meta_title') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom04">Meta Description</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom04" wire:model.defer="meta_description" placeholder="---"  required>
											  @error('meta_description') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom05">Meta Keyword</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom05" wire:model.defer="meta_keyword" placeholder="---"  required>
											  @error('meta_keyword') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
										  </div>
										  <button class="btn btn-primary" type="submit">Save</button>
										</form>
									</div>
								</div>
							</div>
							@endif
						</div>
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
                    <div class="preloader wire-preloader" wire:loading wire:target="clear">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                </div>
