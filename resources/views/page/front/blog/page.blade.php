<x-front-layout>
	@push('css')
		<link rel ="stylesheet" href="{{ asset('userlogin/style/style.css') }}">
	@endpush
      <!--- top Section Start--->   
      <div class="top_image_blog" style="background :linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('storage/app/' . $blog->photo) }})">
         <h1> {{ $blog->title }} </h1>
      </div>
      <!--- top Section End--->  
      <!--- Blog 1 Section Start------>  
      <div class="full_section">
         <div class="container">
            <div class="row">
               <div class="single_blog">
                  <div class="col-md-12">
                     <!--- Blog image Section Start------>  
                     <div class="post-items1">
                        <div id="post-502" class="blog_images single">                           
                           <div class="post-content">                              
                              <ul class="post-meta">                                 
                                    <li><i class="fas fa-calendar-alt"></i><time class="updated" datetime="2017-11-13T04:32:59+00:00">{{ date('F, d, Y', strtotime($blog->created_at)) }}</time></span>
                                 </li>
                              </ul>
                              <p>{!! $blog->description !!}</p>
                           </div>
                        </div>
                     </div>
                     <!--- Blog image Section END------>  	  
                     <!--- Blog FORM  Section Start------>  
                     <!--- <div class="leave_reply">
                        <h3> Leave A Reply </h3>
                     </div>
                     <div class="reply_form">
                        <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                 <input class="com-input" name="author" type="text" value="" placeholder="Full Name" style="cursor: auto;"> 
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                 <input class="com-input" name="email" type="text" value="" placeholder="Email Address"> 
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12"><input class="com-input" name="url" type="text" value="" placeholder="Website"> </div>
                           </div>
                           <textarea class="com-input" id="comment-reply" name="comment" cols="45" rows="6" placeholder="Type Here Your Comment" aria-required="true"></textarea>
                     </div>
                     <div class="checkbox">
                     <p class="comment-form-cookies-consent">
                     <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                     <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>
                     <span class="comment-button_checkbox">
                     <input name="submit" type="submit" id="submit" class="submit" value="Submit Comment"> 
                     <input type="hidden" name="comment_post_ID" value="496" id="comment_post_ID">
                     <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                     </div>
                     </span></form>
                     Blog FORM  Section Start------> 			  
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--- Blog 1 Section End------> 
</x-front-layout>