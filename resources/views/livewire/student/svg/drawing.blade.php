<div class="row">

                    <div class="col-lg-12">

						@if (session()->has('message'))

							<div class="alert alert-success">

								{{ session('message') }}

							</div>

						@endif

						<div class="row">

						@if(!$files->isEmpty())

							@foreach ($files as $index => $row) 

							<div class="col-lg-4 col-md-4">

								<div class="card">

								  @php $img = html_entity_decode($row->file); echo $img; @endphp

								  <div class="card-body">

									<h5 class="card-title">{{ $row->name }}</h5>

									<div class="btn-wrapper">

    									<a type="button" style="color:white" data-toggle="modal" data-target="#usersvg-{{$row->id}}" class="btn btn-success">View</a>

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

    								

    									<a type="button"  href="{{ route('edit',[$row->id]) }}" class="btn btn-success">Draw</a>

									</div>

									 

									<!-- https://www.facebook.com/sharer.php?s=100&p[title]=Title+here&p[url]=http://example.com&p[summary]=I+love+cheese&p[images][0]=http://www.ucmas.com/wp-content/uploads/2013/07/rm.jpg -->



									@php 

									$link = "http://www.facebook.com/sharer.php?u=https://thecolouring.com/public/storage/photos/diagram.png";



									//$link = 'https://www.facebook.com/sharer.php?[caption]='.$row->name.'&[description]='.$row->name .'&[picture]=https://thecolouring.com/public/upload/cms/360x220_img2.jpg&[u]=https://thecolouring.com/'.$files->file.''; 
									@endphp
									<a style='float:left;' href={{$link}} class="share-btn">Share on <i class='fa fa-facebook'></i></a>

								  </div>

								</div>

							</div>

							@endforeach

						@else

						<div class="no-data-wrapper">

						    <div class="no-data">

						        <img src="{{ asset('userlogin/img/no-data-found.png') }}" alt="images">

							    <h3>No Data Found</h3>

							    <p>Please draw an image</p>

							</div>

						</div>

						@endif

						</div>

						<div class="custom-pagination">

						    {{ $files->links() }}

						</div>

                    </div>

                     <!-- Modal -->

			 @if(!$files->isEmpty())

				@foreach ($files as $index => $row)

				<div class="modal fade" id="usersvg-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="svg" aria-hidden="true">

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

								<div class="card" style="height:350px">

								  @php echo html_entity_decode($row->file); @endphp

								  <div class="card-body">

									<h5 class="card-title">{{ $row->name }}</h5>

									

								  </div>

								</div>

							</div>

						</div>

					</div>

					</div>

				</div>

				@endforeach

				@endif

                    @push('css')

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                    @endpush

                </div>

