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
                        <h4 class="m-b-0 text-white">Add & Edit Logo </h4>
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
                        <form action="{{ url('create/logo') }}" method="post" id="banner" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Logo Image</label>
                                            <input type="file" name="logo" class="form-control">
                                            @if($logo)<img style="height: 100px" src="{{ asset('upload/cms/'.$logo->logo) }}">@endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Site Title</label>
                                            <input type="text" name="site_title" class="form-control" value="{{ $logo->title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tagline</label>
                                            <input type="text" name="tagline" class="form-control" value="{{ $logo->description }}"  >
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Copyright</label>
                                            <input type="text" name="copyright" class="form-control" value="{{ $logo->copyright }}"  >
                                        </div>
                                        <div class="form-group">
											<label>Header Script</label>
											 <textarea class="form-control" rows="6" name="headerscript" placeholder="Enter text ..." required>{{ isset($logo->headerscript) ? $logo->headerscript : ''}}</textarea>
                                       </div>
                                        <div class="form-group">
											<label>Footer Script</label>
											 <textarea class="form-control" rows="6" name="footerscript" placeholder="Enter text ..." required>{{ isset($logo->footerscript) ? $logo->footerscript : ''}}</textarea>
                                       </div>
                                    </div>                            
                                </div>                               
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">@if($logo) Update @else Save @endif</button>
                                <a href="{{ url('sitemap') }}" class="btn btn-success">Update Sitemap</a>
                                <a href="{{ url('sitemap.xml') }}" target="_blank" class="btn btn-success">View Sitemap</a>
                            </div>
                        </form>
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