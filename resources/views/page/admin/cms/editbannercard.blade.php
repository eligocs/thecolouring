<x-app-layout>     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css" />
   
       <!-- Page wrapper  -->
   <!-- ============================================================== -->
   <div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Container fluid  -->
   <!-- ============================================================== -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Card </h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                    @endif
                    <form action="{{ url('updatebannercard') }}" method="post" id="editcartoon" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Card Image</label>
                                        <div id="dx" class="dropzone" required>
                                        </div>                                    
                                    </div>
                                    <img src="{{ asset('upload/cms/'.$edit->cardimage) }}" height="100px" width="100px">
                                    <input type="hidden" value="{{$edit->id}}" name="update_id">
                                </div>                           
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Main Text</label>
                                        <input type="text" name="maintext" value="{{ isset($edit->maintext) ? $edit->maintext : '' }}" class="form-control" placeholder="Image Text">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Sub Text</label>
                                        <input type="text" name="subtext" value="{{ isset($edit->subtext) ? $edit->subtext : '' }}" class="form-control" placeholder="Image Text">
                                    </div>                                    
                                </div>
                            </div>
                        </div> 
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
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
                   maxFiles: 1,
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
                              
                             $('#editcartoon').append('<input type="hidden" name="cartoonimage" value="' + file.name + '">');
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