<x-app-layout>     
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css" />

    <!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid pt-2"> 

    
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Add & Edit Welcome Image & Text </h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                        @endif
                         @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                        @endif
                        <form action="{{ url('create/welcome') }}" method="post" id="banner" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <hr>
                                <div class="row p-t-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @if($welcome)<img style="height: 100px" src="{{ asset('upload/cms/'.$welcome->image) }}">@endif
                                        </div>
                                    </div>                            
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Text</label>
                                            <input type="text" value="{{ isset($welcome->text) ? $welcome->text :''}}" name="text" class="form-control" placeholder="text" required>
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" value="{{ isset($welcome->description) ? $welcome->description :''}}" name="description" class="form-control" placeholder="description" required>
                                        </div>
                                    </div>                            
                                </div>                               
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div> 
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
</div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->	

</x-app-layout>