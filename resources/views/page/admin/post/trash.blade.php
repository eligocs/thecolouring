<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    @push('css')
    <style>
        .updatebtn{
           background: #f05a21;
           border: #f05a21;
           color:white;
        }
    </style>
       @endpush
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
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table color-table primary-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @if($alltrash)
                                                        @foreach($alltrash as $key => $data)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ isset($data->name) ? $data->name : ''}}</td>
                                                                
                                                                <td>
                                                                    <a href="{{ url('restore/'.$data->id) }})" class="btn btn-danger">Restore</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                            </tbody>
                                        </table>
                                        {{-- {{ $editors->links() }} --}}
                                    </div>
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
