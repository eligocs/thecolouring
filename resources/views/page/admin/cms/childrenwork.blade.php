<x-app-layout>     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css" />
   
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
                           <form action="{{ url('childrenheading') }}" method="post" >
                               @csrf
                               <div class="form-body">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label class="control-label">Heading</label>
                                               <input type="text" value="{{ isset($children->heading) ? $children->heading : ''}}" name="heading" class="form-control" placeholder="Heading" required>
                                           
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
             
       </div>
       <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Add Multiple SVG </h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                    @endif
                    <form action="{{ url('childrenimages') }}" method="post" id="children" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">SVG Images</label>
                                        <div id="dx" class="dropzone" required>
                                        </div>                                    
                                    </div>
                                   @if($children_image)
                                    <div class="row">
                                        @foreach($children_image as $image) 
                                        <div class="col-1">
                                              <a href="{{ url('deletechildrenimages/'.$image->id) }}"><i class="fa fa-times fa-lg" style="color:red"></i></a>
                                            <img src="{{ asset('upload/cms/'.$image->images) }}" height="100px" width="100px">
                                        </div>  
                                        @endforeach
                                    </div>
                                    @endif
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
   <!-- ============================================================== -->
   <!-- End Container fluid  -->
   <!-- ============================================================== -->
   </div>
   </div>
   <!-- ============================================================== -->
   <!-- End Page wrapper  -->	
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>
   <script>
       Dropzone.autoDiscover = false;
           var uploadedDocumentMap = {};
           window.onload = function() {
               //var drop = $('#dz-preview-template').html();
   
               var dropzoneOptions = {
                   maxFiles: 10,
                   items: '.dz-preview',
                   cursor: 'move',
                   opacity: 0.5,
                   containment: "parent",
                   distance: 20,
                   tolerance: 'pointer',
                   update: function(e, ui) {
                       // do what you want
                   },
                   dictDefaultMessage: 'Select Multiple Images And Not More Than 5 MB',
                   paramName: "file",
                   maxFilesize: 5, // MB
                   addRemoveLinks: true,
                   acceptedFiles: ".jpeg,.jpg,.png,.gif",
   
                   //previewsContainer: '.visualizacao',
                   //
                   //previewTemplate: '<div class="dz-preview dz-file-preview"> <div class="row"> <div class="col-md-4"> <div class="dz-image"> <img //data-dz-thumbnail/> </div></div><div class="col-md-8"> <textarea class="form-control des" row="3" ></textarea></div></div>',
                   thumbnail: function(file, dataUrl) {
                       if (file.previewElement) {
                           console.log("ds");
                           file.previewElement.classList.remove("dz-file-preview");
                           var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                           for (var i = 0; i < images.length; i++) {
                               var thumbnailElement = images[i];
                               thumbnailElement.alt = file.name;
                               thumbnailElement.src = dataUrl;
                           }
                           setTimeout(function() {
                               file.previewElement.classList.add("dz-image-preview");
                           }, 1);
                       }
                   },
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   url: "/banner/image",
                   init: function() {
                       this.on("success", function(file, res){
                              
                             $('#children').append('<input type="hidden" name="childrenimage[]" value="' + file.name + '">');
                           /*uploadedDocumentMap[file.name] = file.name
   
   
                           $(file.previewTemplate).find('.des').attr('data-id', res.id); */
                       });
                       this.on("error", function(file, data) {
                           /* this.removeFile(file);
                           swal(data, " ", "error"); */
                       });
   
                   }
               };
   
               var dropzone = new Dropzone('#dx', dropzoneOptions);
   
               dropzone.removeAllFiles();
               //dropzone.handleFiles(files);
               dropzone.processQueue();
           }
   </script>
   </x-app-layout>