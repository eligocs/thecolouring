<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
	use WithFileUploads;
	use WithPagination;
	protected $paginationTheme = 'bootstrap';
	
	public $category = [];
	public $create = false;
	public $photo;
	
	
	//var
	public $title;
	public $category_name;
	public $alt_image;
	public $description;
	
	//meta data
	public $meta_title;
	public $meta_description;
	public $meta_keyword;
	
	// data
	public $postUid;
	public $photoUpdate;
	public $old;
	
	public function create()
    {
		$this->create = true;
    }
	public function cancel()
    {	$this->postUid = false;
		$this->create = false;
		$this->reset('title');
		$this->reset('category_name');
		$this->reset('description');
		$this->reset('photo');
		$this->reset('alt_image');
		$this->reset('meta_title');
		$this->reset('meta_description');
		$this->reset('meta_keyword');
		$this->reset('old');
		
    }
	
	public function store()
    {
			$validatedData = $this->validate([
			
				'title' => 'required',
				'category_name' => 'required',
				'photo' => 'required|image|max:1500',
				'alt_image' => 'required',
				'meta_title' => 'required',
				'meta_description' => 'required',
				'meta_keyword' => 'required',

			]);
			$temp = $this->photo->store('photos');
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
			$slug = Str::slug($this->title);
			// check to see if any other slugs exist that are the same & count them
            $count = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
            // if other slugs exist that are the same, append the count to the slug
            $slg = $count ? "{$slug}-{$count}" : $slug;
			Blog::create([
					'title' => $this->title,
					'description' => $this->description,
					'slug' => $slg,
					'category' => $this->category_name,
					'photo' => $temp,
					'alt_image' => $this->alt_image,
					'user_id' => $user_id,
					'role' => $role,
					'status' => $status,
					'meta_title' =>  $this->meta_title,
				    'meta_description' =>  $this->meta_description,
				    'meta_keyword' =>  $this->meta_keyword
			]);
			session()->flash('message', 'Post Created Successfully.');
			$this->reset('title');
			$this->reset('category_name');
			$this->reset('description');
			$this->reset('photo');
			$this->reset('alt_image');
			$this->create = false;
			$this->reset('meta_title');
	    	$this->reset('meta_description');
	    	$this->reset('meta_keyword');
    }
	
	public function update()
    {

			$validatedData = $this->validate([
			
				'title' => 'required',
				'category_name' => 'required',
				'alt_image' => 'required',

			]);
			$slug = Str::slug($this->title);
			// check to see if any other slugs exist that are the same & count them
            $count = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
            // if other slugs exist that are the same, append the count to the slug
            $slg = $count ? "{$slug}-{$count}" : $slug;
			if($this->photo){	
				$temp = $this->photo->store('photos');
				Blog::where('id', $this->postUid)->update([
					'title' => $this->title,
					'description' => $this->description,
					'slug' => $slg,
					'category' => $this->category_name,
					'photo' => $temp,
					'alt_image' => $this->alt_image,
					'meta_title' =>  $this->meta_title,
				    'meta_description' =>  $this->meta_description,
				    'meta_keyword' =>  $this->meta_keyword
				]);
			}else{
				Blog::where('id', $this->postUid)->update([
					'title' => $this->title,
					'description' => $this->description,
					'slug' => $slg,
					'category' => $this->category_name,
					'alt_image' => $this->alt_image,
					'meta_title' =>  $this->meta_title,
				    'meta_description' =>  $this->meta_description,
				    'meta_keyword' =>  $this->meta_keyword
				]);
			}
			session()->flash('message', 'Post Updated Successfully.');
			$this->reset('postUid');
			$this->reset('title');
			$this->reset('category_name');
			$this->reset('description');
			$this->reset('photo');
			$this->reset('alt_image');
			$this->create = false;
			$this->reset('meta_title');
	    	$this->reset('meta_description');
	    	$this->reset('meta_keyword');
    }
	
	public function updateForm($id)
    {
		$this->postUid = $id;
		$temp = Blog::where('id',$this->postUid)->first();
		$this->title = $temp->title;
		$this->category_name = $temp->category;
		$this->description = $temp->description;
		$this->alt_image = $temp->alt_image;
		$this->meta_title =  $temp->meta_title;
	    $this->meta_description =  $temp->meta_description;
		$this->meta_keyword =  $temp->meta_keyword;
		$this->old =  $temp->photo;
		$this->create = true;
    }
	
	public function destroy($id)
    {
		$isValid = Blog::where('id',$id);
        $isValid->delete();
		session()->flash('message', 'Post Deleted Successfully.');
    }
	
    public function render()
    {
		$this->category = BlogCategory::all();
        return view('livewire.admin.post.index', [
            'post' => Blog::orderBy('created_at','desc')->paginate(10),
            'mypost' => Blog::where('user_id', \Auth::user()->id)->where('role', 'editor')->get(),
        ]);
    }
}
