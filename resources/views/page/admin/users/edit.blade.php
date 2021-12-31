<x-app-layout>
    @push('css')
 <style>
     .updatebtn{
        background: #f05a21;
        border: #f05a21;
     }
 </style>
    @endpush
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
                    {{-- @livewire('admin.users.index') --}}
                    <div class="row">
                        <div class="col-lg-8">
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
                            <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <h3>Update User</h3>
                                        </div>
                                        <form method="post" action="{{ url('user/update')}}">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name: </label>
                                                <input type="text" class="form-control" name="name" value="{{ isset($edit->name) ? $edit->name : ''}}" required>
                                                <input type="hidden" value="{{ isset($edit->id) ? $edit->id : ''}}" name="update_id">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email: </label>
                                                <input type="email" class="form-control" value="{{ isset($edit->email) ? $edit->email : ''}}" name="email" required>
                                            </div>
                                        </div><br>
                                        <div class="row" style="text-align: center">
                                            <button type="submit" style="text-align: center" class="btn btn-primary updatebtn">Update</button>
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

</x-app-layout>
