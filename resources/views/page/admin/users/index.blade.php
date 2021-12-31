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
                                    <a href="{{ url('user/add') }}" class="btn btn-parimary updatebtn" style="float:right"><i class="fa fa-plus"></i>&nbsp;Add User</a>
                                    <div class="table-responsive">
                                        <table class="table color-table primary-table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $index => $row)
                                                    <tr>
                                                       
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ $row->email }}</td>
                                                        <td>
                                                            {{-- <a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a> --}}
                                                            <a href="{{ url('user/edit/'.$row->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                            <a  data-id="{{$row->id}}" href="javascript:void(0);" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                                            {{-- @if($delete_user_id == $row->id)
                                                                <button type="button" wire:click="destroy" class="btn btn-danger">Confirm</button>
                                                            @else
                                                                <button type="button" wire:click="confirm({{ $row->id }})" class="btn btn-danger">Delete</button>
                                                            @endif --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $users->links() }}
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
 @push('js')       
 <script>
     $(document).ready(function(){
         $('.delete').click(function(){
             var delete_id = $(this).data('id');
             swal({
                title: "Are you sure want to delete this  User ?",
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if(isConfirm == true){
                    $.ajax({
                        type: "get",
                        url: "{{ url('delete/user') }}",
                        data: {deleteid : delete_id},
                        success: function(data) {
                            if(data == true){
                                swal("Deleted!", "Data successfully Deleted!", "success");
                                setTimeout(function(){ location.reload(); }, 4000);
                            }else{
                                swal("Oops", "We couldn't connect to the server!", "error");
                            }
                        }
                    })
                    /* .done(function(data) {
                        swal("Deleted!", "Data successfully Deleted!", "success");
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    }); */
                }
            }
            );
         })
     })
 </script>
 @endpush
</x-app-layout>
