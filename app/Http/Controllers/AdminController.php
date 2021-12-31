<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* use App\Models\Blog;
use App\Models\BlogCategory; */
use App\Models\User;
use App\Models\SvgFile;
use App\Models\Terms;
use App\Models\Privacy;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/* 	// create post
	public function post()
    {
        return  view('page.admin.post.index');
    }
	//add blog categroy
	public function blogCategory()
    {
        return  view('page.admin.blog.index');
    } */

	//front contact page setting
	public function about()
    {
        return  view('page.admin.about.index');
    }
	//show all user list
	public function users()
    {
        $users = User::where('role','student')->orderBy('created_at','desc')->paginate(10);
        return  view('page.admin.users.index', compact('users'));
    }
	//Show All Svg Categoty
    public function categoty()
    {
        return  view('page.admin.svg.category');
    }
	//Show All Svg Upload
    public function upload()
    {
        return  view('page.admin.svg.upload');
    }
    //Show All Svg Upload
    public function seoHome()
    {
        return  view('page.admin.seo.home');
    }
     //Show All Svg Upload
    public function seoAbout()
    {
        return  view('page.admin.seo.about');
    }
         //Show All Svg Upload
    public function seoBlog()
    {
        return  view('page.admin.seo.blog');
    }
           //Show All Svg Upload
    public function seoSketches()
    {
        return  view('page.admin.seo.sketches');
    }
     //Show All Svg Upload
    public function seoContact()
    {
        return  view('page.admin.seo.contact');
    }
	//Show All Svg Color
    public function color()
    {
        return  view('page.admin.svg.color');
    }
	//Show Contact data
    public function contactData()
    {
        return  view('page.admin.contact.data');
    }
    	//Show Svg Front
    public function categoryShow()
    {
        return  view('page.admin.svg.show');
    }
    
    public function deleteuser(Request $request)
    {
        if($request->deleteid){
            $delete = User::where('id', $request->deleteid)->delete();
            if($delete){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function edituser($id)
    {
        if($id){
            $edit = User::where('id', $id)->first();
            return view('page.admin.users.edit', compact('edit'));
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

    }

    public function updateuser(Request $request)
    {
        if($request->update_id){
            $update = User::where('id', $request->update_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if($update == 1){
                return redirect('/users')->with('success', 'User Updated Successfully');
            }else{
                return redirect()->back()->with('error', 'Something Went wrong');
            }
        }else{
            return redirect()->back()->with('error', 'Something Went wrong');
        }
    }

    public function adduser()
    {
        return view('page.admin.users.adduser');
    }

    public function savenewuser(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:8'
        ]);
        
        $curTime = new \DateTime();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => $curTime->format("Y-m-d H:i:s"),
            'role' => 'student'
        ]);

        if($user == true){
            
            $details = [
                'title' => 'Mail from thecolouring.com',
                'email' => $request->email,
                'password' => $request->password,
            ];
           
            \Mail::to($request->email)->send(new \App\Mail\AdduserMail($details));
            
            return redirect('/users')->with('success', 'New User Added');
        }else{
            return redirect()->back()->with('error', 'Something Went wrong');
        }
    }
    
/*         public function editorpost()
    {
        $posts = Blog::where('role','editor')->orderBy('created_at','desc')->get();
        return view('page.admin.post.editor', compact('posts'));
    }

    public function publish($id)
    {
        if($id){
            $publish = Blog::where('id', $id)->update([
                'status' => 'publish',
            ]);
            if($publish == true){
                return redirect('/show-post')->with('success', 'Post Published Successfully');
            }
        }else{
            return redirect()->back()->with('error', 'Id Not Found');
        }
    }

    public function unpublish($id)
    {
        if($id){
            $unpublish = Blog::where('id', $id)->update([
                'status' => 'unpublish',
            ]);
            if($unpublish == true){
                return redirect('/show-post')->with('success', 'Post Unpublished Successfully');
            }
        }else{
            return redirect()->back()->with('error', 'Id Not Found');
        }
    } 
    
       public function editors()
    {
        $editors = User::where('role','editor')->paginate(10);
        return  view('page.admin.users.editor', compact('editors'));
    }

    public function addeditor()
    {
        return view('page.admin.users.addeditor');
    }

    public function saveneweditor(Request $request)
    {
       
        $this->validate($request, [
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:8'
        ]);
        
        $curTime = new \DateTime();
        
        $editor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $curTime->format("Y-m-d H:i:s"),
            'password' => Hash::make($request->password),
            'role' => 'editor'
        ]);

        if($editor == true){
            $details = [
                'title' => 'Mail from thecolouring.com',
                'email' => $request->email,
                'password' => $request->password,
            ];
           
            \Mail::to($request->email)->send(new \App\Mail\AdduserMail($details));
            return redirect('/editors')->with('success', 'New Editor Added');
        }else{
            return redirect()->back()->with('error', 'Something Went wrong');
        }
    }

    public function editeditor($id)
    {
        if($id){
            $edit = User::where('id', $id)->first();
            return view('page.admin.users.editeditor', compact('edit'));
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

    }

    public function updateeditor(Request $request)
    {
        if($request->update_id){
            $update = User::where('id', $request->update_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if($update == 1){
                return redirect('/editors')->with('success', 'Editor Updated Successfully');
            }else{
                return redirect()->back()->with('error', 'Something Went wrong');
            }
        }else{
            return redirect()->back()->with('error', 'Something Went wrong');
        }
    }

    public function deleteeditor(Request $request)
    {
        if($request->deleteid){
            $delete = User::where('id', $request->deleteid)->delete();
            if($delete){
                return true;
            }else{
                return false;
            }
        }
    }
    
        public function cat_trashes()
    {
        $alltrash = BlogCategory::where('del_status', 1)->get();
        return view('page.admin.post.trash', compact('alltrash'));
    } */

    public function restore($id)
    {
        $restore = BlogCategory::where('id', $id)->update([
            'del_status' => false,
        ]);

        if($restore == true)
        {
            return redirect('/cat_trashes')->with('message', 'Restored Successfully');
        }else{
            return redirect()->back()->with('error', 'something went wrong');
        }
    }
    
     public function seotermsandcondition()
    {
        return view('page.admin.seo.terms');
    }

    public function seoprivacyandpolicy()
    {
        return view('page.admin.seo.privacy');
    }

    public function termsandcondition()
    {
        $terms_data = Terms::where('id', 1)->first();
        if($terms_data){
            return view('page.admin.cms.terms', compact('terms_data'));
        }else{
            return view('page.admin.cms.terms');
        }
    }

    public function privacyandpolicy()
    {
        $privacy_data = Privacy::where('id', 1)->first();
        if($privacy_data){
            return view('page.admin.cms.privacy', compact('privacy_data'));
        }else{
            return view('page.admin.cms.privacy');
        }
    }

    public function saveterms(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $check = Terms::where('id', 1)->first();
        if($check){
            $update = Terms::where('id', 1)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if($update == true){
                return redirect('termsandcondition')->with('success', 'Terms And Conditions Updated Successfully.');
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }
        }else{
            $create = Terms::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if($create == true){
                return redirect('termsandcondition')->with('success', 'Terms And Conditions Created Successfully.');
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }
        }
    }

    public function saveprivacy(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $check = Privacy::where('id', 1)->first();
        if($check){
            $update = Privacy::where('id', 1)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if($update == true){
                return redirect('privacyandpolicy')->with('success', 'Privacy & Policy Updated Successfully.');
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }
        }else{
            $create = Privacy::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if($create == true){
                return redirect('privacyandpolicy')->with('success', 'Privacy & Policy Created Successfully.');
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }
        }
    }
    
/*     	//Show Post 
    public function showPost()
    {
		$post = Blog::orderBy('created_at','desc')->paginate(10);
		$mypost = Blog::where('user_id', \Auth::user()->id)->where('role', 'editor')->paginate(10);
        return  view('page.admin.post.show',compact(['post','mypost']));
    }
	public function createPost()
    {
		$category = BlogCategory::get();
        return  view('page.admin.post.create',compact(['category']));
    }

	public function editPost($id)
    {
		$category = BlogCategory::get();
		$post = Blog::where('id',$id)->first();
        return  view('page.admin.post.edit',compact(['category','post']));
    }

	public function deletepost(Request $request)
    {
       
        if($request->id){
            Blog::where('id',$request->id)->delete();
            return  true;
        }        
		
    }
	
	public function savePost(Request $request)
    {
        
			$this->validate($request, [
				'title' => 'required',
				'description' => 'required',
				'alt_image' => 'required',
				'meta_title' => 'required',
				'meta_description' => 'required',
				'meta_keyword' => 'required',
			]);
			$temp = $request->file('image')->store('photos');
			$user_id = \Auth::user()->id;
			$role;
			$status;
			if(\Auth::user()->role == 'editor'){
				$role = 'editor';
				$status = 'unpublish';
			}else{
				$role = 'admin';
				$status = 'unpublish';
			}
			$slug = Str::slug($request->title);
			// check to see if any other slugs exist that are the same & count them
            $count = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
            // if other slugs exist that are the same, append the count to the slug
            $slg = $count ? "{$slug}-{$count}" : $slug;
			Blog::create([
					'title' => $request->title,
					'description' => $request->description,
					'slug' => $slg,
					'photo' => $temp,
					'alt_image' => $request->alt_image,
					'user_id' => $user_id,
					'role' => $role,
					'status' => $status,
					'meta_title' =>  $request->meta_title,
				    'meta_description' =>  $request->meta_description,
				    'meta_keyword' =>  $request->meta_keyword
			]);
			return redirect()->route('show-post')->with('success','Post Is Created Successfully Your Process Is Under Review.');
    }
    
    public function updatePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'alt_image' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
        ]);

        $photo = '';
        $image = Blog::where('id', $request->update_id)->first();
        if($request->file('image')){
            $temp = $request->file('image')->store('photos');
            $photo = $temp;
        }else{
            $photo = $image->photo;
        }
        $slug = Str::slug($request->title);
			// check to see if any other slugs exist that are the same & count them
        $count = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
            // if other slugs exist that are the same, append the count to the slug
        $slg = $count ? "{$slug}-{$count}" : $slug;
        
        Blog::where('id', $request->update_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slg,
            'photo' => $photo,
            'alt_image' => $request->alt_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
        ]);

        return redirect()->route('show-post')->with('success','Updated successfully');
    } */
    
    public function sitemap()
    {
		// modify this to your own needs
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                   if ($url->segment(1) === 'blog') {
                       return;
                   }
            
                   return $url;
               })
            ->writeToFile('sitemap.xml');
            
            return redirect('logo')->with('message', 'Sitemap Updated Successfully ');
    }
}
