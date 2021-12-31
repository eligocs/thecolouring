<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
	use WithPagination;
	public $name;
	public $update_name;
	public $category_id;
	
    
	public function create()
    {
        /*

        $validatedData = $this->validate([

            'name' => 'required',

        ]);
		$temp = BlogCategory::where('name', ucwords($this->name))->first();
		if($temp){
			session()->flash('error', 'Category Already Exist.');
		}else{
			BlogCategory::create([
				'name' => ucwords($this->name)
			]);
			session()->flash('message', 'Category Added Successfully.');
			$this->reset('name');
		}*/

    }
	public function clear()
    {
	/*	$this->reset('name');
		$this->reset('category_id');
		$this->reset('update_name');*/

    }
	public function update()
    {

       /* $validatedData = $this->validate([
            'update_name' => 'required',
        ]);
		$temp = BlogCategory::where('name', ucwords($this->update_name))->first();
		if($temp){
			session()->flash('error', 'Category Already Exist.');
		}else{
			$isValid = BlogCategory::where('id',$this->category_id);
			$isValid->update([
				'name' => ucwords($this->update_name)
			]);
			session()->flash('message', 'Category Updated Successfully.');
			$this->reset('category_id');
			$this->reset('update_name');
		}*/
    }
	
	
	public function destroy($id)
    {
	/*	$isValid = BlogCategory::where('id',$id);
        $isValid->update([
			'del_status' => true,
		]);
		session()->flash('message', 'Category Deleted Successfully.');*/
    }
	
	public function updateForm($category_id,$update_name)
    {
		/*$this->category_id = $category_id;
		$this->update_name = $update_name;*/
    }
	
    public function render()
    {
       /* return view('livewire.admin.blog.index', [
            'category' => BlogCategory::where('del_status', 0)->paginate(10),
        ]);*/
    }
}
