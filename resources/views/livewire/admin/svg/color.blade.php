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
                                                <th>Name</th>
                                                <th>Color</th>
												<th>Code</th>
                                               @if(\Auth::user()->role == 'admin')<th>Action</th>@endif
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($color as $index => $row)
												<tr>
													<td>{{ $row->name }}</td>
													<td><span style="background-color:{{ $row->code }};padding:10px 20px;"></span></td>
													<td>{{ $row->code }}</td>
													@if(\Auth::user()->role == 'admin')
													<td>
														<button type="button" wire:click="updateForm({{ $row->id }},'{{ $row->name }}','{{ $row->code }}')" class="btn btn-success"><span class="mdi mdi-pencil"></span></button>
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
													</td>
													@endif
												</tr>
											@endforeach
                                        </tbody>
                                    </table>
                                    {{ $color->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4">
						<div class="row">
							@if($color_id)
							<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Update</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="update">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom01">Name</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom01" wire:model.defer="update_color_name" placeholder="---"  required>
											  @error('update_color_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom02">Code</label>
											  <input type="color" class="form-control" id="validationCustom02" wire:model.defer="update_color_code" placeholder="---" required>
											   @error('color_code') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
										  </div>
										  <button class="btn btn-primary" type="submit">Update</button>
										  <button class="btn btn-primary" wire:click="clear" type="button"><span class="mdi mdi-window-close"></span></button>
										</form>
									</div>
								</div>
							</div>
							@else
								<div class="col-lg-12">
								 <div class="card">
									<div class="card-body">
										<h4 class="card-title">Add</h4>
										<form class="needs-validation" novalidate wire:submit.prevent="create">
										  <div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="validationCustom03">Name</label>
											  <input type="text" class="form-control" style="text-transform:capitalize" id="validationCustom03" wire:model.defer="color_name" placeholder="---" required>
											   @error('color_name') <span class="error text-danger">{{ $message }}</span> @enderror
											</div>
											<div class="col-md-12 mb-3">
											  <label for="validationCustom04">Code</label>
											  <input type="color" class="form-control" id="validationCustom04" wire:model.defer="color_code" placeholder="---" required>
											   @error('color_code') <span class="error text-danger">{{ $message }}</span> @enderror
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
                    <div class="preloader wire-preloader" wire:loading wire:target="updateForm">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                    <div class="preloader wire-preloader" wire:loading wire:target="clear">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
                    </div>
                </div>
