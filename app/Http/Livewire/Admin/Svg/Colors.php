<?php

namespace App\Http\Livewire\Admin\Svg;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    
	public $color_name;
	public $color_code;
	public $update_color_name;
	public $update_color_code;
	public $color_id;
	
	public function create()
    {

        $validatedData = $this->validate([

            'color_name' => 'required',
			'color_code' => 'required',

        ]);
		$temp = Color::where('name',  ucwords($this->color_name))->first();
		if($temp){
			session()->flash('error', 'Color Already Exist.');
		}else{
			Color::create([
				'name' => ucwords($this->color_name),
				'code' => $this->color_code
			]);
			session()->flash('message', 'Color Added Successfully.');
			$this->reset('color_name','color_code');
			$this->color = Color::all();
		}

    }
	
	public function update()
    {

        $validatedData = $this->validate([

            'update_color_name' => 'required',
			'update_color_code' => 'required',

        ]);
		$temp = Color::where('name',  ucwords($this->update_color_name))->first();
		if($temp){
			session()->flash('error', 'Color Already Exist.');
		}else{
			$isValid = Color::where('id',$this->color_id);
			$isValid->update([
				'name' =>  ucwords($this->update_color_name),
				'code' => $this->update_color_code
			]);
			session()->flash('message', 'Color Updated Successfully.');
			$this->reset('color_id','update_color_name','update_color_code');
			$this->color = Color::all();
		}

    }

    
    public function clear()
    {
		$this->reset('color_id','update_color_name','update_color_code');
		$this->reset('color_name','color_code');

    }
	
	public function destroy($id)
    {
		$isValid = Color::where('id',$id);
        $isValid->delete();
		session()->flash('message', 'Color Deleted Successfully.');
		$this->color = Color::all();

    }
	
	public function updateForm($color_id,$update_color_name,$update_color_code)
    {
		$this->color_id = $color_id;
		$this->update_color_name = $update_color_name;
		$this->update_color_code = $update_color_code;
    }
	
    public function render()
    {
        return view('livewire.admin.svg.color', [
            'color' => Color::orderBy('created_at','desc')->paginate(10),
        ]);
    }
}
