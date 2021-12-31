<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\EditorController;

use App\Http\Controllers\FrontController;

use App\Http\Controllers\SocialiteController;

use App\Http\Controllers\CmsController;

use App\Models\Homebanner;

use App\Models\Bannercard;

use App\Models\Homewelcome;

use App\Models\Cartoonheading;

use App\Models\Cartoonimage;

use App\Models\Childrenheading;

use App\Models\Childrenimage;

use App\Models\Footer;

use App\Models\User;

use App\Models\SvgFile;

use App\Models\SvgCategory;

use App\Models\Blog;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
 



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/





//Front End Routes Here



/*------------------------------------------*/
 

Route::fallback(function() {

    return view('errors.404');

});



Route::get('/', function (Request $request) { 
 
	
	$data['banner'] = Homebanner::get();

	$data['bannercard1'] = Bannercard::where('id', 1)->first();

	$data['bannercard2'] = Bannercard::where('id', 2)->first();

	$data['bannercard3'] = Bannercard::where('id', 3)->first();

	$data['welcome'] = Homewelcome::where('id', 1)->first();

	$data['Cartoonheading'] = Cartoonheading::where('id', 1)->first();

	$data['cartoonimage'] = Cartoonimage::get();

	$data['childrenheading'] = Childrenheading::first();

	$data['childrenimage'] = Childrenimage::get();

    $svg = SvgCategory::where('front', '!=', 0)->get();

	$blog = Blog::orderBy('id', 'desc')->where('post_status', 'publish')->take(3)->get();

	foreach($svg as $row){

		$row->images = SvgFile::where('category',$row->id)->take($row->front)->get();

	}
	

    return view('index', compact(['data','svg','blog']));

})->name('home');

Route::get('/clearAll', function() {

    \Artisan::call('cache:clear');

    \Artisan::call('config:clear');

    \Artisan::call('route:clear');

    \Artisan::call('view:clear');

    return "Cache is cleared";

});


/* Route::get('auth/google/callback',[FrontController::class, 'handleGoogleCallback']);
Route::get('auth/facebook',[Auth\FrontController::class, 'redirectToFacebook']);  */
Route::get('/login', [FrontController::class, 'login'])->middleware(['guest'])->name('login');

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])

            ->middleware(['guest'])

            ->name('admin-login');

			$limiter = config('fortify.limiters.login');

    $twoFactorLimiter = config('fortify.limiters.two-factor');



    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])

        ->middleware(array_filter([

            'guest',

            $limiter ? 'throttle:'.$limiter : null,

        ]));

Route::get('/user/guest', [FrontController::class, 'guest'])->name('user.guest');

Route::get('/user/login', [FrontController::class, 'login'])->middleware(['guest'])->name('user.login');

//Route::get('/register', [FrontController::class, 'register'])->middleware(['guest'])->name('register');

Route::get('user/register', [FrontController::class, 'register'])->name('user.register'); 

Route::get('/contact',[FrontController::class, 'contact'])->name('contact');

Route::get('/about',[FrontController::class, 'about'])->name('about');

Route::get('/termsconditions',[FrontController::class, 'termsconditions']);

Route::get('/policies',[FrontController::class, 'policies']);

//Route::get('/blog',[FrontController::class, 'index'])->name('blog');

//Route::get('/blog/{slug}',[FrontController::class, 'blog'])->name('slug');

Route::get('/sketches',[FrontController::class, 'sketches'])->name('sketches');



//Login Response Protected Routes Heress

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::get('/dashboard', function () {

		//dd(url()->previous());		 
		if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor'){

			$users = User::where('role','student')->count();

			$svg = SvgFile::count();

			return view('page.admin.dashboard', compact(['users','svg']));

		}else{	
			/* if(Auth::user()->id){
				return  redirect()->back();
			} */
			return  redirect()->route('home');

		}
	
	})->name('dashboard');

});



//Student Protected Routes Here
Route::post('student/login_guest',[FrontController::class, 'login_guest'])->name('login_guest');
Route::post('student/register_guest',[FrontController::class, 'register_guest'])->name('register_guest');
Route::post('student/guest_svg_session',[FrontController::class, 'guest_svg_session'])->name('guest_svg_session');

Route::middleware(['auth:sanctum', 'verified', 'student'])->group(function () {



	 Route::get('/my-profile',[UserController::class, 'myProfile'])->name('my-profile');

	 Route::get('/change-password',[UserController::class, 'changePassword'])->name('change-password');

	 Route::get('/my-drawings',[UserController::class, 'myDrawing'])->name('my-drawings');

	 Route::get('/drawings',[UserController::class, 'drawings'])->name('drawings');

	 Route::get('/draw/{id}',[UserController::class, 'draw'])->name('draw');

	 Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');

});



Route::middleware(['auth:sanctum', 'verified', 'editor'])->group(function () {

	Route::get('editor/myprofile',[EditorController::class, 'myProfile']);

	Route::get('editor/changepassword',[EditorController::class, 'changePassword']);



});



//Admin Protected Routes Here

Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {



	/*-----------------------------------*/

     Route::get('/seo-home',[AdminController::class, 'seoHome'])->name('seo-home');

     Route::get('/seo-about',[AdminController::class, 'seoAbout'])->name('seo-about');

     Route::get('/seo-contact',[AdminController::class, 'seoContact'])->name('seo-contact');

     Route::get('/seo-blog',[AdminController::class, 'seoBlog'])->name('seo-blog');

      Route::get('/seo-sketches',[AdminController::class, 'seoSketches'])->name('seo-sketches');

	 Route::get('/svg-category',[AdminController::class, 'categoty'])->name('svg.category');

	 Route::get('/svg-upload',[AdminController::class, 'upload'])->name('svg.upload');

	 Route::get('/color',[AdminController::class, 'color'])->name('color');

	 Route::get('/post',[AdminController::class, 'post'])->name('post');

	 Route::get('/editorpost',[AdminController::class, 'editorpost'])->name('editorpost');

	 Route::get('publish/{id?}',[AdminController::class, 'publish'])->name('publish');

	 Route::get('unpublish/{id?}',[AdminController::class, 'unpublish'])->name('unpublish');

	 

	 Route::get('/blog-category',[AdminController::class, 'blogCategory'])->name('blog.category');

	 Route::get('/about-page',[AdminController::class, 'about'])->name('about.page');

	 Route::get('/users',[AdminController::class, 'users'])->name('users');

	  Route::get('/contact-data',[AdminController::class, 'contactData'])->name('contact-data');

	 

	 /*----------------------------------------*/

	

	 Route::get('/logo', [CmsController::class,'logo']);

	 Route::post('/create/logo', [CmsController::class,'logocreate']);

	 Route::get('/banner', [CmsController::class,'bannerlist']);

	 Route::get('/add/banner', [CmsController::class,'addbanner']);

	 Route::get('/bannercard', [CmsController::class,'bannercard']);

	 Route::get('/editbannercard/{id}', [CmsController::class,'editbannercard']);

	 Route::post('/updatebannercard', [CmsController::class,'updatebannercard']);

	 Route::get('/edit/banner/{id}', [CmsController::class,'editbanner']);

	 Route::post('/create/banner', [CmsController::class,'bannercreate']);

	 Route::post('/banner/image', [CmsController::class,'bannerImageSave']);

	 Route::get('/bannerdelete/{id}', [CmsController::class,'bannerdelete']);

	 Route::get('/welcome', [CmsController::class,'welcome']);

	 Route::post('/create/welcome', [CmsController::class,'createwelcome']);

	 Route::post('/cartoonheading', [CmsController::class,'cartoonheading']);

	 Route::post('/cartoonimages', [CmsController::class,'cartoonimages']);

	 Route::get('/addcartoonimages', [CmsController::class,'addcartoonimages']);

	 Route::get('/deletecartoonimages/{id}', [CmsController::class,'deletecartoonimages']);

	 Route::get('/editcartoonimages/{id}', [CmsController::class,'editcartoonimages']); 

	 Route::get('/children', [CmsController::class,'children']);

	 Route::post('/childrenheading', [CmsController::class,'childrenheading']);

	 Route::post('/childrenimages', [CmsController::class,'childrenimages']);

	 Route::get('/deletechildrenimages/{id}', [CmsController::class,'deletechildrenimages']);

	 Route::get('/footer', [CmsController::class, 'footer']);

	 Route::post('/addfooter', [CmsController::class, 'addfooter']);

	 Route::get('/footericon', [CmsController::class, 'footericon']);

	 Route::post('/addfootersocial', [CmsController::class, 'addfootersocial']);

	 Route::post('/updatefootersocial', [CmsController::class, 'updatefootersocial']);

	 Route::get('/editfootersocial/{id}', [CmsController::class, 'editfootersocial']);

	 Route::get('/deletefootersocial/{id}', [CmsController::class, 'deletefootersocial']);



     Route::get('/delete/user', [AdminController::class, 'deleteuser']);

     Route::get('/user/edit/{id?}', [AdminController::class, 'edituser']);

	 Route::post('user/update', [AdminController::class, 'updateuser']);

	 Route::get('user/add', [AdminController::class, 'adduser']);

	 Route::post('adduser', [AdminController::class, 'savenewuser']);

	 

	Route::get('/editors',[AdminController::class, 'editors'])->name('editors');

	Route::post('addeditor', [AdminController::class, 'saveneweditor']);

	Route::get('editor/add', [AdminController::class, 'addeditor']);

    Route::get('editor/edit/{id?}', [AdminController::class, 'editeditor']);

	Route::post('editor/update', [AdminController::class, 'updateeditor']);

	Route::get('/delete/editor', [AdminController::class, 'deleteeditor']);

	

	Route::get('/cat_trashes', [AdminController::class, 'cat_trashes']);

	Route::get('/restore/{id?}', [AdminController::class, 'restore']);

	

	Route::get('seo/termsandcondition',[AdminController::class, 'seotermsandcondition']);

	Route::get('seo/privacyandpolicy',[AdminController::class, 'seoprivacyandpolicy']);



	Route::get('termsandcondition',[AdminController::class, 'termsandcondition']);

	Route::get('privacyandpolicy',[AdminController::class, 'privacyandpolicy']);



	Route::post('saveterms', [AdminController::class, 'saveterms']);

	Route::post('saveprivacy', [AdminController::class, 'saveprivacy']);

	

	Route::get('sitemap', [AdminController::class, 'sitemap']);

	

	//post

	Route::get('show-post', [AdminController::class, 'showPost'])->name('show-post');

	Route::get('create-post', [AdminController::class, 'createPost'])->name('create-post');

	Route::get('edit-post/{id?}', [AdminController::class, 'editPost'])->name('edit-post');

	Route::post('save-post', [AdminController::class, 'savePost'])->name('save-post');

	Route::post('update-post', [AdminController::class, 'updatePost'])->name('update-post');

	Route::get('deletepost', [AdminController::class, 'deletepost'])->name('delete-post');

});







Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);



Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook']);

Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);

Route::get('/category/',[FrontController::class, 'getAllCategory'])->name('getAllCategory');

Route::get('category/{cat_name?}', [FrontController::class, 'serach_by_cat']);

Route::get('category/{cat_name?}/{img_name?}', [FrontController::class, 'serach_by_img']);



Route::post('resendemail', [FrontController::class, 'resend_email']);


