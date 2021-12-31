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
            <h4 class="card-title">Select Social Media Icons</h4><br>
            @if($errors->any())
                {!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
                <form action="{{ url('addfootersocial') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="table-responsive col-md-6">
                            <label>Icons</label>
                            <select class="form-control" name="icon">
                                <option value="">Select Icon</option>
                                @if($social)
                                    @foreach($social as $soc)
                                        <option value="{{$soc->id}}">{{ isset($soc->name) ? $soc->name :''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="table-responsive col-md-6">
                            <label>Enter Link</label>
                            <input type="text" name="link" class="form-control" placeholder="Example:https://www.xyz.com">
                        </div>
                    </div><br>
                    <div class="table-responsive" style="text-align: center">
                        <button class="btn btn-info"><i class="fa fa-plus">&nbsp;Add</i></button>
                    </div>
                </form>
        </div>
    </div>

</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Social Media Icons</h4>
            <div class="table-responsive">
                <table class="table color-table info-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($selected)
                             @foreach($selected as $key => $banner)
                                <tr>
                                    <td>{{ $key+1}}</td>                                    
                                    <td>{{ isset($banner->social_name) ? $banner->social_name : ''}}</td>
                                    <td>{{ isset($banner->link) ? $banner->link : ''}}</td>
                                    <td>
                                        <a href="{{ url('editfootersocial/'.$banner->id) }}"><button><i class="fa fa-edit"></i></button></a>
                                        <a href="javascript(0)" data-toggle="modal" data-target="#exampleModal{{ $banner->id }}"><button><i class="fa fa-trash"></i></button></a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                  <div class="modal-body">
                                                                    <h3 class="text-center">Are you sure want to delete this social link ?</h3>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a href="{{ url('deletefootersocial/'.$banner->id) }}" class="btn btn-primary">Delete</a>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
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