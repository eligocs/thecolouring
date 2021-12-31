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
                                            <h3>Add Editor</h3>

                                            @if ($errors->any())
                                            <div class="col-md-12">
                                                <ol>
                                                @foreach ($errors->all() as $error)
                                                    <li style="color:red">{{$error}}</li>
                                                @endforeach
                                                </ol>
                                            </div>
                                            @endif
                                        </div>
                                        <form method="post" action="{{ url('addeditor')}}">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name: </label>
                                                <input type="text" class="form-control" name="name" required>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email: </label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Password: </label>
                                                <div class="form-group pswd_group">
                                                    <input type="password" class="form-control" name="password" required>
                                                    <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
                                                 </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Confirm Password: </label>
                                                <div class="form-group pswd_group">
                                                    <input type="password" class="form-control" name="password_confirmation" required>
                                                    <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row" style="text-align: center">
                                            <button type="submit" style="text-align: center" class="btn btn-primary updatebtn">Add</button>
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
