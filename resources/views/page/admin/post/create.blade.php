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
                            @if($errors->any())
                                {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                            @endif
                            <div class="card-body">
                                <form  class="needs-validation" novalidate action="{{ route('save-post') }}" method="post" enctype="multipart/form-data">
									@csrf
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control form-control-line" onchange="convertToSlug(this);" name="title" required>	
									</div>
									<div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" id="slug" class="form-control form-control-line" readonly required>
									</div>
								{{--	 <div class="form-group">
										<label>Category</label>
										<select class="form-control custom-select"  name="category" required>
												<option value="">--Select--</option>
												@foreach($category as $row)
												<option value="{{ $row->id }}">{{ $row->name }}</option>
												@endforeach
										</select>
									</div> --}}
									<div class="form-group">
											<label>Description</label>
											 <textarea class="textarea_editor form-control" rows="15" name="description" placeholder="Enter text ..." required></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Image upload</label>
                                        <input class="form-control form-control-line" type="file" name="image" onchange="readURL(this);" required> 
                                    </div>
									<img id="blah" src="#" style="height:100px;width:100px;display:none" alt="your image" />
									<h5><strong>Meta Data Setting</strong></h5>
									<div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control form-control-line"  name="meta_title" required>
									</div>
									<div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control form-control-line"  name="meta_description" required>
									</div>
									<div class="form-group">
                                        <label>Meta Keyword</label>
                                        <input type="text" class="form-control form-control-line"  name="meta_keyword" required>
									</div>
									<div class="form-group">
                                        <label>Alt Image Tag</label>
                                        <input type="text" class="form-control form-control-line" name="alt_image" required>	
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
</x-app-layout>
