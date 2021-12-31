<?php

function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}

function get_post_image($post_id)
{
   $image_link ='';
   $image_alt ='';
   $post_meta = \DB::connection('wordpress_db')->table('postmeta')->where('post_id',$post_id)->where('meta_key','_thumbnail_id')->first();
   if($post_meta){
       $meta_id = $post_meta->meta_value;
       $image = \DB::connection('wordpress_db')->table('posts')->where('ID',$meta_id)->first();
       $image_link = $image ? $image->guid : '';
       $getAlt = \DB::connection('wordpress_db')->table('postmeta')->where('post_id',$meta_id)->where('meta_key','_wp_attachment_image_alt')->first();
       $image_alt = $getAlt ? $getAlt->meta_value : '';
   }
   return "<img src='$image_link' class='blog_thumbnail' alt='$image_alt'>";
}
