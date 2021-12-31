<?php

namespace App\Http\Livewire\Student\Svg;

use App\Models\UserSvg;
 use Livewire\Component;
 use Livewire\WithPagination;

class Drawing extends Component
{

	public $uid;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
	public function destroy($id)
    {
		$isValid = UserSvg::where('id',$id);
        $isValid->delete();
		session()->flash('message', 'Image deleted Successfully.');
    }
	
	public function gotoPage($page){
	    $this->page = $page;
        return redirect()->to('/my-drawings?page='.$page);
	}
	
	public function nextPage(){
	    $this->page += 1;
        return redirect()->to('/my-drawings?page='.$this->page);
	}
	
	public function previousPage(){
	    $this->page -= 1;
        return redirect()->to('/my-drawings?page='.$this->page);
	}
	
	
    public function render()
    {
		$this->uid = \Auth::user()->id;
		$files = UserSvg::orderBy('created_at','desc')->where("user_id",$this->uid)->paginate(12);
        return view('livewire.student.svg.drawing',compact(['files']));
    }
}
