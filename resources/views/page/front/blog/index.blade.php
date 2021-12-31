   <x-front-layout>
      @push('css')
         <link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
      @endpush

         <!--- top Section Start--->   
         <div class="top_image_blog" style="background : url({{ asset('userlogin/img/kids-with-mom.jpg') }})">
            <!--<img src="{{ asset('userlogin/img/1920x730_slide3.jpg') }}" alt="images">-->
            <h1> Blog </h1>
         </div>
         <!--- top Section End--->   
         <!--- blog section left side start ---->
         <div class="blog_divide_section">
            <div class="container">
               <div class="row d-flex">                  
                        @foreach($blogs as $row)
                              <!--- blog section 1 start --- ---->
                              <div class="col-md-4 mb-4">  
                              <div class=" card-section">
                                  
                                 <div class="card">
                                     <div class="pm-card-image">
                                    
                                       <a href="{{ route('slug',[$row->slug])}}">
                                       
									@if($row->photo)
                                       <img width="770" height="350" src="{{ asset('storage/app/' . $row->photo) }}" alt="{{ $row->alt_image }}">
									@else
									<img  src="https://cached.imagescaler.hbpl.co.uk/resize/scaleWidth/815/cached.offlinehbpl.hbpl.co.uk/news/SUC/color1-20191204062437970.jpg" alt="temp">
									@endif
									</a>
                                    
                                    </div>
                                    <div class="card-body news">
                                       <h5 class="card-title"><a href="{{ route('slug',[$row->slug])}}">{{ custom_echo($row->title,20) }}</a></h5>
                                       <ul class="post-meta">
                                       
                                             <i class="fas fa-calendar-alt"></i> 
                                             <time class="updated" datetime="2017-11-13T04:32:59+00:00">{{ date('F, d, Y', strtotime($row->created_at)) }}</time></span>
                                          </li>
                                       </ul>
                                       <p class="card-text">{{ custom_echo(strip_tags($row->description),70) }}</p>
                                       <div class="images_border"> </div>
                                       <a href="{{ route('slug',[$row->slug])}}"><button class="btn_crouser2_btn home-blog-btn">Read More</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                              <!--- blog section 6 End------ ---->
                        @endforeach
               
               {{ $blogs->links() }}
                  </div>
                  <!--- blog section left side start ---->
            
                  
                  </div>
               </div>
            </div>
         </div>
         <!--- blog section End--- ---->
   </x-front-layout>