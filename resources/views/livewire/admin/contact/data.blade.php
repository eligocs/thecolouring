				<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table color-table primary-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
												<th>Phone</th>
												<th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($contact as $index => $row)
												<tr>
													<td>{{ $row->name }}</td>
													<td>{{ $row->email }}</td>
													<td>{{ $row->phone }}</td>
													<td>
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $index }}">
																	View
														</button>
														<!-- Modal -->
														<div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  <div class="modal-dialog" role="document">
															<div class="modal-content">
															  <div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Message</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																  <span aria-hidden="true">&times;</span>
																</button>
															  </div>
															  <div class="modal-body">
																{{ $row->message }}
															  </div>
															  <div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															  </div>
															</div>
														  </div>
														</div>
													</td>
												</tr>
											@endforeach
                                        </tbody>
                                    </table>
									{{ $contact->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
