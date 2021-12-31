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
                        <div class="card">
                            <div class="card-body">
                                <form  class="needs-validation" novalidate action="{{ route('update-post') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="update_id" value="{{ isset($post->id) ? $post->id : '' }}">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control form-control-line" value="{{ isset($post->title) ? $post->title : '' }}" name="title" required>	
									</div>
									<div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" id="slug" class="form-control form-control-line" readonly value="{{ isset($post->slug) ? $post->slug : '' }}" required>
									</div>
                                   {{-- <div class="form-group">
                                        <label>Category</label>                                    
                                        <select class="form-control custom-select"  name="category" required>
                                                <option value="">--Select--</option>
                                                @if($post && $category)
                                                    @foreach($category as $row)
                                                    <option @if($row->id == $post->category) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div> --}}
									<div class="form-group">
											<label>Description</label>
											 <textarea class="textarea_editor form-control" rows="15" name="description" placeholder="Enter text ..." required>{{ isset($post->description) ? $post->description : '' }}</textarea>
                                    </div>
									<div class="form-group">
                                        <label>Image upload</label>
                                        <input class="form-control form-control-line" type="file" onchange="readURL(this);" name="image" required> 
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('storage/app/'.$post->photo) }}" style="height: 100px" id="editimage"/>
                                    </div>
									<img id="blah" style="display:none; height:100px" src="{{ isset($post->title) ? $post->title : ''}}" alt="your image" />
									<h5><strong>Meta Data Setting</strong></h5>
									<div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control form-control-line"  value="{{ isset($post->meta_title) ? $post->meta_title : ''}}" name="meta_title" required>
									</div>
									<div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control form-control-line"  value="{{ isset($post->meta_description) ? $post->meta_description : '' }}" name="meta_description" required>
									</div>
									<div class="form-group">
                                        <label>Meta Keyword</label>
                                        <input type="text" class="form-control form-control-line"  value="{{ isset($post->meta_keyword) ? $post->meta_keyword : '' }}" name="meta_keyword" required>
									</div>
									<div class="form-group">
                                        <label>Alt Image Tag</label>
                                        <input type="text" class="form-control form-control-line" value="{{ isset($post->alt_image) ? $post->alt_image : ''}}" name="alt_image" required>	
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-success">Post</button>
									</div>
                                </form>
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
		@endpush
		@push('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
            @push('js')
			<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
			<script>
                    $(document).ready(function() {
                            $('.textarea_editor').summernote({
                                height: 350, // set editor height
                                minHeight: null, // set minimum height of editor
                                maxHeight: null, // set maximum height of editor
                                focus: false // set focus to editable area after initializing summernote
                            });
                    });
					function readURL(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							reader.onload = function (e) {
							    $('#blah').css('display', 'block');
							    $('#editimage').css('display', 'none');
								$('#blah').attr('src', e.target.result);
								$('#blah').show();
							}
							reader.readAsDataURL(input.files[0]);
						}
					}
					function convertToSlug(Text)
					{
						var slug = Text.value
							.toLowerCase()
							.replace(/ /g,'-')
							.replace(/[^\w-]+/g,'')
							;
							$('#slug').val(slug);
					}
			</script>
		@endpush
		@endpush
</x-app-layout>
