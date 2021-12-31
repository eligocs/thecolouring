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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" method="post" action="{{ url('saveprivacy') }}">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-line" value="{{ isset($privacy_data->title) ? $privacy_data->title : ''}}" name="title" required>	
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            {{-- <input type="text" class="form-control form-control-line" value="{{ isset($privacy_data->description) ? $privacy_data->description : ''}}" name="description" required>	 --}}
                            <textarea class="form-control textarea_editor" name="description" rows="18" required>{{ isset($privacy_data->description) ? $privacy_data->description : ''}}</textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Save</button>
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
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
<script>
        $(document).ready(function() {
                $('.textarea_editor').wysihtml5({
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
<!-- ============================================================== -->
<!-- End Page wrapper  -->	
</x-app-layout>
