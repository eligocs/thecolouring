<?php

namespace App\Http\Livewire\Admin\Svg;

use App\Models\SvgCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    protected $paginationTheme = 'bootstrap';
	use WithPagination;
	public $category_name;
	public $update_category_name;
	public $category_id;
	public $view;
	public $viewid;
	public $number;
	public $meta_title;
	public $meta_description;
	public $meta_keyword;
	
	public function create()
    {

        $validatedData = $this->validate([

            'category_name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',

        ]);
		$temp = SvgCategory::where('name', ucwords($this->category_name))->first();
		if($temp){
			session()->flash('error', 'Image Category Already Exist.');
		}else{
			SvgCategory::create([
				'name' => ucwords($this->category_name),
				'meta_title' => $this->meta_title,
				'meta_description' => $this->meta_description,
				'meta_keyword' => $this->meta_keyword
			]);
			session()->flash('message', 'Image Category Added Successfully.');
			$this->reset('category_name','meta_title','meta_description','meta_keyword');
		}

    }
	public function clear()
    {
		$this->reset('category_name','meta_title','meta_description','meta_keyword');
		$this->reset('category_id','update_category_name','meta_title','meta_description','meta_keyword');

    }
	public function update()
    {

		$temp = SvgCategory::where('name', ucwords($this->update_category_name))->first();
		if($temp){
			$isValid = SvgCategory::where('id',$this->category_id);
			$isValid->update([
				'meta_title' => $this->meta_title,
				'meta_description' => $this->meta_description,
				'meta_keyword' => $this->meta_keyword
			]);
			session()->flash('error', 'Image Category Already Exist.');
			$this->reset('category_id','update_category_name','meta_title','meta_description','meta_keyword');
		}else{
			$isValid = SvgCategory::where('id',$this->category_id);
			$isValid->update([
				'name' => ucwords($this->update_category_name),
				'meta_title' => $this->meta_title,
				'meta_description' => $this->meta_description,
				'meta_keyword' => $this->meta_keyword
			]);
			session()->flash('message', 'Image Category Updated Successfully.');
			$this->reset('category_id','update_category_name','meta_title','meta_description','meta_keyword');
		}
    }
	
	public function front()
    {

        $validatedData = $this->validate([
            'number' => 'required',
        ]);
			$isValid = SvgCategory::where('id',$this->view);
			$isValid->update([
				'front' => $this->number
			]);
			session()->flash('message', 'Updated Successfully.');
			$this->reset('view');
			$this->reset('number');
    }

    public function view($category_id)
    {
		$this->view = $category_id;

    }
      public function remove($category_id)
    {
		$this->viewid = $category_id;

    }
    public function frontremove()
    {
			$isValid = SvgCategory::where('id',$this->viewid);
			$isValid->update([
				'front' => 0
			]);
			session()->flash('message', 'Updated Successfully.');
			$this->reset('viewid');
    }
	
	public function destroy($id)
    {
		$isValid = SvgCategory::where('id',$id);
        $isValid->delete();
		session()->flash('message', 'Image Category Deleted Successfully.');
    }
	
	public function updateForm($category_id)
    {
		$this->category_id = $category_id;
		$temp = SvgCategory::where('id',$category_id)->first();
		$this->update_category_name = $temp->name;
		$this->meta_title = $temp->meta_title;
		$this->meta_description = $temp->meta_description;
		$this->meta_keyword = $temp->meta_keyword;
		
    }
	
    public function render()
    {
        $count = SvgCategory::where('front', '!=', 0)->count();
        return view('livewire.admin.svg.category', [
            'category' => SvgCategory::paginate(10),'count' => $count
        ]);
    }
}
