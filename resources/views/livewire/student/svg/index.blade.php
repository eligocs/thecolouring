				<style>
				    .form-group.search_div {
                        width: 50%;
                        margin-left: auto;
                        margin-right: auto;
                    }
				</style>
				<div class="row">
                    <div class="col-lg-12">
						@if (session()->has('message'))
							<div class="alert alert-success">
								{{ session('message') }}
							</div>
						@endif
						 
						<div class="row">
							<div class="col-12">
    							<div class="form-group search_div">
    								<select class='form-control categorySelcted'>
    									<option value=''>--Filter--</option>
    									@if($SvgCategory)
    										@foreach($SvgCategory as $category)
    											<option @if(!empty($_GET['id']) && 
    											$_GET['id'] == $category->id) selected  
    											@endif value='{{$category->id ? $category->id :""}}'>{{$category->name ? $category->name :''}}</option>
    										@endforeach
    									@endif
    								</select>
    							</div>
							</div>
						</div>
						
						<div class="row">
						@if(!$files->isEmpty())
							@foreach ($files as $index => $row)
							<div class="col-lg-3 col-md-4">
								<div class="card" style="height:350px">
								  @php echo html_entity_decode($row->file); @endphp
								  <div class="card-body">
									<h5 class="card-title">{{ $row->name }}</h5>
									<a type="button" style="color:white" data-toggle="modal" data-target="#usersvg-{{$row->id}}" class="btn btn-success">View</a>
									<a type="button"  href="{{ route('draw',[$row->id]) }}" class="btn btn-success">Fill Colour</a>
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
                    </div>
                            <div class="custom-pagination">
						    {{ $files->links() }}
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
									<a type="button"  href="{{ route('draw',[$row->id]) }}" class="btn btn-success">Fill</a>
								  </div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
				@endforeach
				@endif
                </div>
                
