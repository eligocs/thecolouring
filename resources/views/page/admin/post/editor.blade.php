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
            @if($posts->count() > 0)
            @foreach($posts as $index =>  $row)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><img src="{{ asset('storage/' . $row->photo) }}" style="height:150px" class="img-fluid"/></div>
                        <div class="col-lg-10 col-md-10">
                            <h4 class="card-title">{{ custom_echo($row->title,200) }}</h4>
                            <div id="slimtest1" style="height:150px">
                                @php custom_echo(strip_tags($row->description), 300); @endphp
                            </div>
                            <button type="button" class="btn btn-primary">{{ $row-> created_at }}</button>
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
            @else
             <h3>No Posts Found</h3>
            @endif
          
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

   
</x-app-layout>