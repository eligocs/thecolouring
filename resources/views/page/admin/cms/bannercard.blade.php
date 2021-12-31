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
            <h4 class="card-title">Home Banner Card</h4>
            <div class="table-responsive">
                <table class="table color-table info-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Card Images</th>
                            <th>Main Text</th>
                            <th>Sub Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if($card)
                            @foreach($card as $key => $banner)
                                <tr>
                                    <td>{{ $key+1}}</td>
                                    <td><img src="{{ asset('upload/cms/'.$banner->cardimage) }}" style="height: 100px"></td>
                                    <td>{{ isset($banner->maintext) ? $banner->maintext : ''}}</td>
                                    <td>{{ isset($banner->subtext) ? $banner->subtext : ''}}</td>
                                    <td>
                                        <a href="{{ url('editbannercard/'.$banner->id) }}"><button><i class="fa fa-edit"></i></button></a>
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