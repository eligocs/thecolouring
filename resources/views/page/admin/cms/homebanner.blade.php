<x-app-layout>     
    <!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid pt-2"> 

    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="top-banner-heading">
                <h4 class="card-title">Home Banner Images & Text</h4>
                <a href="{{ url('add/banner') }}"><button class="btn btn-success" style="float:right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
            </div>
             @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
            @endif
            <div class="table-responsive">
                <table class="table color-table info-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Banner Images</th>
                            <th>Text 1</th>
                            <th>Text 2</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($list)
                            @foreach($list as $key => $banner)
                                <tr>
                                    <td>{{ $key+1}}</td>
                                    <td><img src="{{ asset('upload/cms/'.$banner->bannerimage) }}" style="height: 100px"></td>
                                    <td>{{ isset($banner->text1) ? $banner->text1 : ''}}</td>
                                    <td>{{ isset($banner->text2) ? $banner->text2 : ''}}</td>
                                    <td>
                                        <a href="{{ url('edit/banner/'.$banner->id) }}"><button><i class="fa fa-edit"></i></button></a>
                                        <a href="{{ url('bannerdelete/'.$banner->id) }}"><button><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>No Data Found</td>    
                        @endif
                    </tbody>
                </table>
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