<div>
				<div class="row">
				<div class="col-md-8 order-md-2 col-lg-9">
					<!-- searched-category-filter start -->
					<div class="container-fluid searched-category-filter">
						<div class="row">
						@if(!$files->isEmpty())
						@foreach($files as $key => $rows)
							<div class="col-6 col-md-6 col-lg-4 mb-3 search">
								<div class="card h-100 border-0">
									<div class="card-img-top">
										<div class="img-fluid mx-auto d-block" style="height:300px">
											@php echo html_entity_decode($rows->file); @endphp
										</div>
									</div>
									<div class="card-body text-center">
										<h4 class="card-title">
											<a href="{{ (Auth::user()  && Auth::user()->role == 'student') ? route('draw',[$rows->id]) : route('user.login') }}" class=" font-weight-bold text-dark text-uppercase small"> {{ $rows->name }} </a>
										</h4>
									</div>
								</div>
							</div>
						@endforeach
						@else
							<h3>No Data Found</h3>
						@endif
						<!-- searched-category-filter row -->
					</div>
					<div wire:loading>
							Processing...
					</div>
					<!-- searched-category-filter end -->
				</div>
				<!-- sidebar-filter start -->

	
				</div>
							<div class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
					<h6 class="text-uppercase font-weight-bold mb-3">Categories</h6>
					@foreach($category as $key => $row)
					<div class="form-group">
						<div class="form-check">
						  <input class="form-check-input" type="radio" wire:model="search" name="search" value="{{ $row->name }}">
						  <label class="form-check-label">
							{{ $row->name }}
						  </label>
						</div>
					  </div>
					@endforeach
				</div>
				<!-- sidebar-filter end -->
				@push('js')
					<script>
						window.onscroll = function(ev) {
								window.livewire.emit('loadMore')
						}
					</script>
				@endpush
				</div></div>