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
                           <h4 class="m-b-0 text-white">Add & Edit Heading </h4>
                       </div>
                       <div class="card-body">
                           @if($errors->any())
                               {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                           @endif
                           <form action="{{ url('cartoonheading') }}" method="post" >
                               @csrf
                               <div class="form-body">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label class="control-label">Heading</label>
                                               <input type="text" value="{{ isset($cartoon->heading) ? $cartoon->heading : ''}}" name="heading" class="form-control" placeholder="Heading" required>
                                           
                                           </div>
                                       </div>                           
                                   </div>                               
                               <div class="form-actions">
                                   <button type="submit" class="btn btn-success">Save</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
             </div>  
             
             <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cartoon Images & Text</h4>
                        <a href="{{ url('addcartoonimages') }}"><button class="btn btn-success" style="float:right"><i class="fa fa-plus"></i>&nbsp;Add Images</button></a>
                        <div class="table-responsive">
                            <table class="table color-table info-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cartoon Images</th>
                                        <th>Text</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cartoon_image)
                                    @foreach($cartoon_image as $key => $banner)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td><img src="{{ asset('upload/cms/'.$banner->images) }}" style="height: 100px"></td>
                                            <td>{{ isset($banner->text) ? $banner->text : ''}}</td>
                                            <td>
                                                <a href="{{ url('editcartoonimages/'.$banner->id) }}"><button><i class="fa fa-edit"></i></button></a>
                                                <a href="{{ url('deletecartoonimages/'.$banner->id) }}"><button><i class="fa fa-trash"></i></button></a>
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