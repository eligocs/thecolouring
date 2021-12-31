<x-front-layout>
    
<style>
input.form-control.inputSty {
    width: 50%;
    margin-left: auto;
    margin-right: auto;
}
.text-orangecolor{
    color: #f05a21;
}
.seachdiv {
    display: flex;
    width: 50%;
    justify-content: center;
    margin: 20px auto 100px;
}

input.form-control.inputSty {width: 100%;border-radius: 5px 0px 0px 5px;}

button.btn.searchSketch {
    background: #f05a21;
    color: #fff;
    border-radius: 0 5px 5px 0px;
}
@media (max-width:990px){
.seachdiv {width:98%}
}
</style>

<div id="carouselExampleFade" class="carousel slide carousel-fade pm_carosuel" data-ride="carousel">
   
    <div class="carousel-inner">
      @if($data['banner'])
       @foreach($data['banner'] as $key => $bane)
       @if($key == 0)
         <div class="carousel-item @php if($key == 0){echo 'active'; } @endphp">
            <img src="{{ asset('upload/cms/'.$bane->bannerimage) }}" alt="Color Online">
            <div class="carousel-caption crouser_text  d-md-block hero-banner-content">
               <h1>{{ isset($bane->text1) ? $bane->text1 : ''}}
               </h1>
               <h2>{{ isset($bane->text2) ? $bane->text2 : ''}}
               </h2>
               <div class="crouser_button">
                  <!-- <button type="submit" class="btn_crouser1_btn">Read More</button> -->
                 @if(!\Auth::user())<a href="{{ route('user.register') }}" ><button type="submit"class="btn_crouser2_btn">Enroll Now</button></a>@endif
               </div>
            </div>
         </div>
         @endif
        @endforeach 
      @endif
    </div>
    <!--a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a-->
 </div>
 <!--- crouser section end--->   
  
   <div class="background">
      <div class="continer container-width pm-main-continer">
         <div class="inner-main-content-division">
            <!--- why us section start--->   
            <div class="whyus_section">
               <div class="container ">
                   <div class="row "> 
                      <div class="col-12  align-items-center">
                          <h2 class='text-orangecolor text-center'>Search Sketch You Like To Colour</h2> 
                         <div class='seachdiv'>
                          <input class='form-control inputSty' type="text" placeholder="e.g. elephant" name="search"><button class='btn searchSketch' type=""><i class="fa fa-search"></i></button> 
                          </div>
                      </div>
                  </div>
                  <div class="row d-flex align-items-center">
                     <div class="col-lg-6">
                        <div class="house">
                           <img src="{{ asset('upload/cms/'.$data['welcome']->image) }}" alt="online colouring portal">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="house_text">
                           <h2> {{ isset($data['welcome']) ? $data['welcome']->text : ''}}</h2>
                           <p> 
                              {{ isset($data['welcome']) ? $data['welcome']->description : ''}}
                           </p>
                           <!--<button type="submit" class="btn_crouser2_btn ">Why Us</button>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--- why us section end---> 

            <!--- Famous cartoon start--->   
               @foreach ($svg as $row)
               @if(!$row->images->isEmpty())
               <div class="main-cartoon-caontainer">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12">
                        <div class="famous_cartoon">
                           @php $url1 = str_replace(' ','-',$row->name); $url = strtolower($url1); @endphp	
                           <a href="{{ url('category/'.$url) }}"><h3> {{  $row->name }}</h3></a>
                        </div>
                        </div>
                     </div>
                  </div>
                  <!--- Famous cartoon end--->    
                  <!--- Famous cartoon slider start ---> 
                  <div class="container ">
                     <div class="row">
                        <div class="MultiCarousel" data-items="1,4,3" data-slide="1" id="MultiCarousel1" data-interval="1000">
                           <div class="MultiCarousel-inner crousel-cartoon-cl" style="transform: translateX(0px);">
                           @foreach($row->images as $rw)
                              <div class="item" style"width: 190px;">
                                  @php $ur = strtolower($row->name); $uri = str_replace(' ', '-', $ur); 
                                     $img = $rw->slug; @endphp
                                 <a href="{{ url('category/'.$uri.'/'.$img) }}"><div class="pad15">
                                    
                                    @php echo html_entity_decode($rw->file); @endphp
											   <a href="{{ url('category/'.$uri.'/'.$img) }}" type="button" class="lead">{{ $rw->name }} </a>									
                                 </div>
                              </div></a>
                            </a>
                           @endforeach
                           </div>
                           <button class="btn  leftLst over"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                           <button class="btn  rightLst"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
                  </div>
                  @endif
            @endforeach
			<div class="lates_butoon">
                  <a href="{{ route('sketches') }}"><button type="submit" class="btn_crouser2_btn">View More Sketches</button></a>
           </div></br>
          <!--- Famous cartoon slider end---> 

            <!--- testomonial start--> 
            <div class="testomonial">
               <div class="container-fluid">
                  <div class="row">
                     
                     <div class="col-lg-5">
                        <div class="testomonial_text mx-auto text-center">
                           <p>  What Parents
                              Say About Us
                           </p>
                        </div>
                     </div>
                     <div class="col-lg-7">
                        <div class="slideshow-container">
                           <div class="mySlides">
                              <q>A fun and happy digital subscription of colouring pages to brighten my child's mind - Marilyn</q>
                           </div>
                           <div class="mySlides">
                              <q>It's an easy learning and educational game. I'm teaching my baby colouring and it helps - Jason</q>
                           </div>
                           <div class="mySlides">
                              <q>It helped my little kids learn their colours and have fun - Ashley</q>
                           </div>
                           <a class="prev" onclick="plusSlides(-1)">❮</a>
                           <a class="next" onclick="plusSlides(1)">❯</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--- testomonial end--> 

            <!--- Latest News start--> 
            <div class="Latest_news">
               <h1> Latest Blogs </h1>
               <div class="latest_news_section">
                  <div class="container ">
                     <div class="row">
					 @foreach($blog as $row)
                        <div class="col-lg-4">
                           
                              <div class="card_section">
                                 <div class="card">
                                     <div class="pm-card-image">
                                        {!! get_post_image($row->ID) !!}
                                    </div>
                                    <time class="time_entry">
                                    <span>{{ date('d', strtotime($row->post_date)) }}</span></br>
                                    <p>{{ date('F', strtotime($row->post_date)) }}</p>
                                    </time>
                                    <div class="card-body text-center news">
                                       <svg class="bigHalfCircle0" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
                                          <path d="M0 100 C40 0 60 0 100 100 Z"></path>
                                       </svg>
                                       <a href="/blog/{{ $row->post_name }}">
                                          <h5 class="card-title">{{ $row->post_title }}</h5>
                                       </a>
                                       <p class="card-text">{{ custom_echo(strip_tags($row->post_content),150) }}</p>
                                       <div class="images_border"> </div>
									   <a href="/blog/{{ $row->post_name }}"><button type="submit" class="btn_crouser2_btn home-blog-btn">View</button></a>
                                    </div>
                                 </div>
                              </div>
                           
                        </div>
						@endforeach
                     </div>
                  </div>
               </div>
            </div>
            <!-- latest news end -->
         </div>
         <!-- inner-main-content-division -->
      </div>
      <!-- main container in which white section is coming -->
   </div>
   <!-- background-div -->
 </div>
 @push('js')
   <script>
    $('.formSubmitData').on('click',function(){
        $(this).find('form').submit();
    });
    $('.searchSketch').on('click',function(){
        var keyword = $('.inputSty').val();
        if(keyword.length > 0){ 
            window.location.href = '{{url("sketches?search=")}}'+keyword;
        } 
    });
    </script>
 @endpush
</x-front-layout>