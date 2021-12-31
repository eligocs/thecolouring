<?php



namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Models\Blog;

use App\Models\Page;

use App\Models\Footer;

use App\Models\BlogCategory;

use App\Models\SvgFile;

use App\Models\Terms;

use App\Models\Privacy;

use App\Models\User;

use App\Models\SvgCategory;

use App\Models\UserSvg;

use Auth;

use Session;

use DB;

use Illuminate\Support\Facades\Cookie;

class FrontController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

	 

	public function index()

    {

		$blogs = Blog::orderBy('created_at','desc')->where('status','publish')->paginate(10);

        return  view('page.front.blog.index',compact(['blogs']));

    }

	public function blog($search)

    {

		$blog = Blog::where('slug',$search)->first();

        return  view('page.front.blog.page',compact(['blog']));

    }

    public function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

	public function guest(Request $request)

    {
        
        if (!Cookie::get('isGuest')){
            $randomstring = $this->random_str(10); 
            $user = User::create([
                'name' => "Guest".$randomstring,
                'email' => $randomstring,
                'sex' => "-",
                'password' => '',
                'role' => "student",
                'email_verified_at' => date('Y-m-d h:i:s'), 
            ]); 
            
            Auth::loginUsingID($user->id,true);
            Session::put('lastActivityTime', time()); 
            Session::put('guest_id', $randomstring); 
            Cookie::queue('isGuest', true,  time()+86400); //86400 1 day
        }
          


        return  redirect('/');

    }

	public function contact()

    {

		$template =Footer::first();

        return  view('page.front.contact.index',compact(['template']));

    }

	public function about()

    {

		$content = Page::where('type', 'about')->first();

        return  view('page.front.about.index',compact(['content']));

    }

	public function login()

    {
       
        return view('page.front.auth.login');

    }

	public function guest_svg_session(Request $request) 
    {
        $svg_name = $request->svg_name;
        $svg = $request->svg;
        if(!empty($svg_name) && $svg){
            Session::put('svg_name',$svg_name);
            Session::put('svg',$svg); 
            return response()->json([
                'status' => 1, 
            ]); 
        } else{
            return response()->json([
                'status' => 2, 
            ]); 
        } 
    }
 


    public function login_guest(Request $request){  
        $email = $request->email;
        $password = $request->password;
        $svg_name = $request->svg_name;
        $svg = $request->svg; 
        $old_user  = DB::table('users')->where('email',$email)->first();
        if(!empty($old_user)){
            Auth::logout();  
            Auth::loginUsingId($old_user->id,true);  
            $id = UserSvg::create([ 
                'name' => $svg_name, 
                'file' => $svg, 
                'user_id' => $old_user->id 
            ])->id;
            $guest = Session::get('guest_id');
            if(!empty($guest)){
                DB::table('users')->where('email',$guest)->delete();
                Session::forget('lastActivityTime'); 
                Session::forget('guest_id'); 
                \Cookie::queue(\Cookie::forget('isGuest'));
            }
            
            return response()->json([
                'status' => 1,
                'user_id' => $old_user->id
            ]); 
        }else{
            return response()->json([
                'status' => 3, 
            ]); 
        }
    }


    public function register_guest(Request $request){  

        $old_user  = DB::table('users')->where('email',$request->email)->first();
        if(!empty($old_user)){
            return response()->json([
                'status' => 3, 
            ]); 
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $guest = Session::get('guest_id');
		if(!empty($guest)){
            DB::table('users')->where('email',$guest)->delete();
			Session::forget('lastActivityTime'); 
			Session::forget('guest_id'); 
            \Cookie::queue(\Cookie::forget('isGuest'));
		}
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'sex' => "-",
            'password' => Hash::make($password),
            'role' => "student",    
            ])->id; 

        $new_user  = DB::table('users')->where('id',$user)->first();   
        
        if(!empty($new_user)){ 
            $id = UserSvg::create([ 
                'name' => $request->svg_name, 
                'file' => $request->svg, 
                'user_id' => $new_user->id 
            ])->id;
        }

        Auth::logout();  
        $guest = Session::get('guest_id');
        if(!empty($guest)){
            DB::table('users')->where('email',$guest)->delete();
            Session::forget('lastActivityTime'); 
            Session::forget('guest_id');  
            \Cookie::queue(\Cookie::forget('isGuest')); 
        }

        if($user){
            return response()->json([
                'status' => 1,
                'user_id' => $user
            ]); 
        }else{
            return response()->json([
                'status' => 2,
                'user_id' => ''
            ]); 
        }

    }
    public function register()

    { 
        if (isset($_COOKIE['isGuest'])){
            $guest = Session::get('guest_id');
            if(!empty($guest)){
                DB::table('users')->where('email',$guest)->delete();
                Session::forget('lastActivityTime'); 
                Session::forget('guest_id');  
                \Cookie::queue(\Cookie::forget('isGuest'));  
            }
        }
        return view('page.front.auth.register');

    }

	

    public function sketches()

    {

        $category = SvgCategory::all(); 

        $search = !empty($_GET["search"]) ? $_GET["search"] : '';

	    if($search){

			$files = SvgFile::orderBy('created_at','desc')->join('svg_categories','svg_files.category', '=', 'svg_categories.id')->select('svg_files.*', 'svg_categories.name as cat_name')->where('svg_files.name','LIKE','%'.$search.'%')->paginate(30); 

		}else{  

			$files = SvgFile::orderBy('created_at','desc')->join('svg_categories','svg_files.category', '=', 'svg_categories.id')->select('svg_files.*', 'svg_categories.name as cat_name')->paginate(30);

	  }

        return view('page.front.search.index', compact(['category', 'files']));

    }



    public function serach_by_cat($cat_name)

    {

        

        $category = SvgCategory::all();

        $url1 = str_replace('-',' ',$cat_name);

        $url = ucfirst($url1);

        $temp = SvgCategory::where('name', $url)->first();

        if($temp){

            $files = SvgFile::where('category', $temp->id)->join('svg_categories','svg_files.category', '=', 'svg_categories.id')->select('svg_files.*', 'svg_categories.name as cat_name')->orderBy('created_at','desc')->paginate(30);

        }else{

            $files = SvgFile::where('category', 0)->orderBy('created_at','desc')->paginate(9);;

        }

       

        return view('page.front.search.index', compact(['category', 'files']));

    }

    

    public function getAllCategory()

    {

        $category = SvgCategory::all();

	 	$files = SvgFile::orderBy('created_at','desc')->join('svg_categories','svg_files.category', '=', 'svg_categories.id')->select('svg_files.*', 'svg_categories.name as cat_name')->paginate(30);

	    return view('page.front.search.index', compact(['category', 'files']));

    }

     

    public function serach_by_img($cat_name, $img_name)

    {

            $image = SvgFile::where('slug', $img_name)->first();

            if(empty($image)){

                 return view('errors.404');

            }

            return view('page.front.search.searchimage', compact('image'));

        

    }

    

    public function resend_email(Request $request)

    {

        if($request->verify_id){

            $user = User::where('id', $request->verify_id)->first();

            $user->sendEmailVerificationNotification();

            return redirect('user/login')->with('success', 'Verification Link Resend Successfully');

        }

    }

    

    public function termsconditions()

    {

        $terms = Terms::where('id', 1)->first();

        return view('page.front.policyterms.terms', compact('terms'));

    }



    public function policies()

    {

        $policy = Privacy::where('id', 1)->first();

        return view('page.front.policyterms.policy', compact('policy'));

    }

}

