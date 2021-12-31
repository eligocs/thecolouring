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
                <form action="{{ url('updatefootersocial') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ ($edit->id) ? $edit->id : '' }}"/>
                    <div class="row">
                        <div class="table-responsive col-md-6">
                            <label>Icons</label>
                            <select class="form-control" name="icon">
                                <option value="">Select Icon</option>
                                @if($social)
                                    @foreach($social as $soc)
                                        <option {{ ($edit->social_id == $soc->id) ? 'selected' : '' }} value="{{$soc->id}}">{{ isset($soc->name) ? $soc->name :''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="table-responsive col-md-6">
                            <label>Enter Link</label>
                            <input type="text" name="link" class="form-control" value="{{ ($edit->link) ? $edit->link : '' }}" placeholder="Example:https://www.xyz.com">
                        </div>
                    </div><br>
                    <div class="table-responsive" style="text-align: center">
                        <button class="btn btn-info"><i class="fa fa-plus">&nbsp;Update</i></button>
                    </div>
                </form>
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