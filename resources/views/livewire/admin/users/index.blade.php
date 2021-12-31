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
												<th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($users as $index => $row)
													<td>{{ $row->name }}</td>
													<td>{{ $row->email }}</td>
													<td>
														@if($delete_user_id == $row->id)
															<button type="button" wire:click="destroy" class="btn btn-danger">Confirm</button>
														@else
															<button type="button" wire:click="confirm({{ $row->id }})" class="btn btn-danger">Delete</button>
														@endif
													</td>
												</tr>
											@endforeach
                                        </tbody>
                                    </table>
									{{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
