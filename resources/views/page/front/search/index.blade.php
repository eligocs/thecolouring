<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
		<link rel ="stylesheet" href="{{ asset('front/style/search.css') }}">
		<style>
			.activeclass{
				background-color: #ffbd0a;
                padding: 5px 20px;
                border-radius: 5px;
                color: #fff;
				}
		</style>
	@endpush
		<!-- hero section start -->
		<div class="top_image_about">   
		   <img src="{{ asset('userlogin/img/1920x730_slide2.jpg') }}" alt="images">
		   <h1> All Sketches </h1>
		</div>
		<div class="background pt-5">
      <div class="continer container-width pm-main-continer">
         <div class="inner-main-content-division">
		
		<!-- hero section end -->
		<div class="container container-width sketches-container">
			<div>
				<div class="row">
				<div class="col-md-8 order-md-2 col-lg-9 search-container">
					<!-- searched-category-filter start -->
					<div class="container-fluid searched-category-filter">
						<div class="row">
						@if($files->count() > 0)
						@foreach($files as $key => $rows)
							<div class=" col-md-6 col-lg-4 mb-3 search">
								<div class="card h-100 border-0">
									<div class="card-img-top">
										<div class="img-fluid mx-auto d-block" >
											@php echo html_entity_decode($rows->file); @endphp
										</div>
									</div>
									<div class="card-body text-center">
										<h4 class="card-title">
										    
											@php $ur = strtolower($rows->cat_name); $uri = str_replace(' ', '-', $ur); $img = $rows->slug; @endphp											
											<a href="{{ url('category/'.$uri.'/'.$img) }}" class=" font-weight-bold  text-uppercase small"> {{ $rows->name }} </a>
										</h4>
									</div>
								</div>
							</div>
						@endforeach
						@else
						<h4 class="no-data">No Data Found. Check our Category Section!</h4>
						@endif
						<!-- searched-category-filter row -->
					</div>
					<!-- searched-category-filter end -->
				</div>
				<!-- sidebar-filter start -->
				<div class="row custom_pagination">
					{{ $files->links() }}
				</div>

	
				</div>
					<div class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
					<h6 class="text-uppercase font-weight-bold mb-3">Select Any Category</h6>
					
					@foreach($category as $key => $row)
					<div class="form-group">
						<div class="form-check active">		
							@php $url1 = str_replace(' ','-',$row->name); $url = strtolower($url1); @endphp				  
						  <a class="{{ (request()->is('category/'.$url)) ? 'activeclass' : '' }}" href="{{ url('category/'.$url) }}">{{ $row->name }}</a>
						</div>
					  </div>
					@endforeach
				</div>
				<!-- sidebar-filter end -->
				</div></div>
		</div>

</div>
</div>
</div>
<!-- Sketch Modal -->
@if($files)
@foreach($files as $key => $rows)
<div class="modal fade" id="sketchpreview-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
				<div class="col-12 search">
					<div class="card h-100 border-0">
						<div class="card-img-top">
							<div class="img-fluid mx-auto d-block" style="height:300px">
								@php echo html_entity_decode($rows->file); @endphp
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="{{ url('user/register')}}" class="btn btn-secondary">Draw</a>
			</div>
		</div>
	</div>
</div>
@endforeach
@endif
</x-front-layout>