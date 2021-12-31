<x-app-layout>     
      
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
                           <h4 class="m-b-0 text-white">Edit Footer Content</h4>
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
                           <form action="{{ url('addfooter') }}" method="post" id="banner" enctype="multipart/form-data">
                               @csrf
                               <div class="form-body">
                                   <hr>
                                   {{-- <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label class="control-label">Location</label>
                                               <input type="text" value="{{ isset($footer->location) ? $footer->location :''}}" name="location" class="form-control" placeholder="Location" required>
                                           
                                           </div>
                                       </div>                                                                
                                   </div>  
                                  <div class="row">
                                    <label class="control-label">Opening Hours:</label>
                                  </div>
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Weekly</label>
                                            <input type="text" value="{{ isset($footer->weekly) ? $footer->weekly :''}}" name="week" class="form-control" placeholder="Weekly" required>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Timely</label>
                                            <input type="text" value="{{ isset($footer->timely) ? $footer->timely :''}}" name="time" class="form-control" placeholder="Timely" required>
                                        </div>
                                    </div>  
                                   </div>
                                   <div class="row">
                                      <label class="control-label">Contact Us:</label>
                                   </div> --}}
                                   <div class="row">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="control-label">Phone</label>
                                               <input type="number" value="{{ isset($footer->phone) ? $footer->phone :''}}" minlength="10" maxlength="12" name="phone" class="form-control" placeholder="Phone" required>
                                           
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="control-label">Email</label>
                                               <input type="email" value="{{ isset($footer->email) ? $footer->email :''}}" name="email" class="form-control" placeholder="Email" required>
                                           </div>
                                       </div>                            
                                   </div>                               
                               <div class="form-actions">
                                   <button type="submit" class="btn btn-success">Update</button>
                               </div>
                           </form>
                       </div>
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
      @push('js')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
   <script>
       $(document).ready(function(){
                $("#banner").validate({
                    ignore: "input[type=hidden]",
                    errorClass: "text-danger",
                    successClass: "text-success",
                    highlight: function (element, errorClass) {
                        $(element).removeClass(errorClass)
                    },
                    unhighlight: function (element, errorClass) {
                        $(element).removeClass(errorClass)
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element)
                    },
                    rules: {
                      
                    
                    }
            });
       })
   </script>
   @endpush
   </x-app-layout>