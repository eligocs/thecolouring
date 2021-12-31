<?php

namespace App\Http\Livewire\Admin\Svg;

use App\Models\SvgFile;
use App\Models\SvgCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Upload extends Component
{
    protected $paginationTheme = 'bootstrap';
	use WithPagination;
	use WithFileUploads;

	public $file_name;
	public $attach;
	public $file_id;
	public $file_category;
	public $category;
	public $title;
	public $description;
	public $imagedescription;
	public $update_file_name;
	public $update_category;
	public $update_title;
	public $update_description;
	public $update_image_description;
    public $show =false;
	

	public function mount()
    {
		$this->file_category = SvgCategory::all();
    }
	public function show(){
	    $this->show = true;
	    $this->reset('file_id');
	}
	public function close(){
	    $this->show = false;
	    $this->reset('file_name','category','title','description','attach','imagedescription');
	}
	public function create()
    {

			$validatedData = $this->validate([

				'file_name' => 'required',
				'category' => 'required',
				'title' => 'required',
				'description' => 'required',
				//'imagedescription' => 'required',

			]);
			
			$slug = Str::slug($this->file_name);
			// check to see if any other slugs exist that are the same & count them
            $count = SvgFile::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
            // if other slugs exist that are the same, append the count to the slug
			$slg = $count ? "{$slug}-{$count}" : $slug;
			
			$temp = SvgFile::where('name',$this->file_name)->first();
			if(!$temp){
    			$filename = $this->attach->store('bucket');
    			$contents = file_get_contents(Storage::path($filename));
    			Storage::delete($filename);
    			$r=  SvgFile::create([
    				'name' => $this->file_name,
    				'slug' => $slg,
    				'category' => $this->category,
    				'meta_title' => $this->title,
    				'meta_description' => $this->description,
    				'file' => $contents,
    				'image_description' => $this->imagedescription ? $this->imagedescription :''
    			]); 
    			session()->flash('message', 'Image Added Successfully.');
    			$this->reset('file_name','category','title','description','attach');
    			$this->show = false;
			}else{
			    session()->flash('error', 'Image Name Already Exist.');
			}
    }
	
	public function update()
    {

        $validatedData = $this->validate([

            'update_file_name' => 'required',
            'update_image_description' =>'required',

        ]);
        
        $slug = Str::slug($this->update_file_name);
		// check to see if any other slugs exist that are the same & count them
		$count = SvgFile::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

		// if other slugs exist that are the same, append the count to the slug
		$slg = $count ? "{$slug}-{$count}" : $slug;
		
		$temp = SvgFile::where('id', $this->file_id);
		if($temp){
			if($this->attach){
			    	$tempa = SvgFile::where('name',$this->update_file_name)->first();
		        	if(!$tempa){
        				$filename = $this->attach->store('bucket');
        				$contents = file_get_contents(Storage::path($filename));
        				Storage::delete($filename);
        				$temp->update([
        					'name' => $this->update_file_name,
        					'slug' => $slg,
        					'category' => $this->update_category,
        					'meta_title' => $this->update_title,
        					'meta_description' => $this->update_description,
        					'file' => $contents,
    				        'image_description' => $this->update_image_description
        				]);
        				session()->flash('message', 'Image Updated Successfully.');
		        	}else{
		        	    $filename = $this->attach->store('bucket');
        				$contents = file_get_contents(Storage::path($filename));
        				Storage::delete($filename);
        				$temp->update([
        					'category' => $this->update_category,
        					'meta_title' => $this->update_title,
        					'meta_description' => $this->update_description,
        					'file' => $contents,
    				        'image_description' => $this->update_image_description
        				]);
			            session()->flash('error', 'Image Name Already Exist..');
			        }
			}else{
			    $tempa = SvgFile::where('name',$this->update_file_name)->first();
		        	if(!$tempa){
        				$temp->update([
        					'name' => $this->update_file_name,
        					'slug' => $slg,
        					'category' => $this->update_category,
        					'meta_title' => $this->update_title,
        					'meta_description' => $this->update_description,
    				        'image_description' => $this->update_image_description,
        				]);
        				session()->flash('message', 'Image Updated Successfully.');
		        	}else{
		        	    $tt = $temp->update([
        					'category' => $this->update_category,
        					'meta_title' => $this->update_title,
        					'meta_description' => $this->update_description,
    				        'image_description' => $this->update_image_description
        				]);
			              session()->flash('message', 'Image Description Updated Successfully');
			        }
			}
			$this->reset('update_file_name','update_category','update_title','update_description','attach','update_image_description');
		}
		$this->show = false;

    }
	
	public function destroy($id)
    {
		$isValid = SvgFile::where('id',$id);
        $isValid->delete();
        return redirect()->back();
		session()->flash('message', 'Image Deleted Successfully.');
    }
	
	public function updateForm($file_id)
    {
		$this->file_id = $file_id;
		$temp = SvgFile::where('id',$this->file_id)->first(); 
		$this->update_file_name = $temp->name;
		$this->update_category = $temp->category;
		$this->update_title = $temp->meta_title;
		$this->update_description = $temp->meta_description;
		$this->update_image_description = $temp->image_description;
		$this->show = true;
    }
	
	public function gotoPage($page){
	    $this->page = $page;
        return redirect()->to('/svg-upload?page='.$page);
	}
	
	public function nextPage(){
	    $this->page += 1;
        return redirect()->to('/svg-upload?page='.$this->page);
	}
	
	public function previousPage(){
	    $this->page -= 1;
        return redirect()->to('/svg-upload?page='.$this->page);
	}
	
    public function render()
    {
		$files = SvgFile::orderBy('created_at','desc')->paginate(12);
        return view('livewire.admin.svg.upload', compact(['files']));
    }
}
