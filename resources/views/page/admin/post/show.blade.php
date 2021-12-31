<x-app-layout>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid pt-2"> 
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<div class="row">
                    <div class="col-12">
						@if (session()->has('message'))
							<div class="alert alert-success">
								{{ session('message') }}
							</div>
						@endif
                        @if (session()->has('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						@if (session()->has('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						@endif
						<div class="form-actions">
							<a href="{{ route('create-post') }}" class="btn btn-success" ><i class="mdi mdi-plus-box"></i> Post</a>
						</div></br>
						 @if(Auth::user()->role == 'admin')
						@foreach($post as $index =>  $row)
						<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2"><img src="{{ asset('storage/app/' . $row->photo) }}" style="height:150px" class="img-fluid"/></div>
                                    <div class="col-lg-10 col-md-10">
										<a href="{{ route('slug',[$row->slug])}}"><h4 class="card-title">{{ custom_echo($row->title,200) }}</h4></a>
                                        <div id="slimtest1" style="height:150px">
											@php custom_echo(strip_tags($row->description), 300); @endphp
                                        </div>
										<button type="button" class="btn btn-primary">{{ $row->created_at }}</button>
										<a href="{{ route('edit-post', $row->id) }}" type="button" class="btn btn-success"><span class="mdi mdi-pencil"></span></a>
										<!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger deletepost" data-id="{{ isset($row->id) ? $row->id :'' }}">
                                      <span class="mdi mdi-delete"></span>
                                    </button>
                                    

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
						{{ $post->links() }}
						@endif
						@if(Auth::user()->role == 'editor')
						@if(!$mypost->isEmpty())
						@foreach($mypost as $index =>  $row)
						<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2"><img src="{{ asset('storage/app/' . $row->photo) }}" style="height:150px" class="img-fluid"/></div>
                                    <div class="col-lg-10 col-md-10">
										<h4 class="card-title">{{ custom_echo($row->title,200) }}</h4>
                                        <div id="slimtest1" style="height:150px">
											@php custom_echo(strip_tags($row->description), 300); @endphp
                                        </div>
										<button type="button" class="btn btn-primary">{{ $row-> created_at }}</button>
										<a href="{{ route('edit-post', $row->id) }}" type="button" class="btn btn-success"><span class="mdi mdi-pencil"></span></a>
										<!-- Button trigger modal -->
                                        
										<a class="btn btn-success" href="{{ route('slug',[$row->slug])}}" target="_blank"><span class="mdi mdi-eye"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                         @else
                        <div class="no-data-wrapper">
						    <div class="no-data">
						        <img src="{{ asset('userlogin/img/no-data-found.png') }}" alt="images">
							    <h3>No Data Found</h3>
							    <p>Please Add Posts</p>
							</div>
						</div>
                        @endif
						{{ $mypost->links() }}
                        @endif
                    </div>
                </div>
                
                <!-- Delete Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h3 class="text-center">Are you sure want to delete this post ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary delete_modal" data-dismiss="modal">Delete</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
				
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
		@push('css')
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
			<link rel="stylesheet" href="{{ asset('assets/css/colors/child.css') }}">
		@endpush
		@push('js')
			<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function(){
                    $('.deletepost').click(function(){
                      var del_id = $(this).data('id');
                      $('#exampleModal').modal('show')
                        $('.delete_modal').click(function(){
                            $.ajax({
                                url: 'deletepost',
                                type: 'GET',
                                data: { id: del_id },
                                success: function(response)
                                {
                                    if(response == 1){
                                        location.reload();
                                    }
                                }
                            })
                        })
                    })
                })
            </script>
		@endpush
</x-app-layout>
