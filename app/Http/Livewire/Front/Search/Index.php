<?php

namespace App\Http\Livewire\Front\Search;

use App\Models\SvgFile;
use App\Models\SvgCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	public $search;
	public $num = 0;
	
	protected $listeners = [
		'loadMore' => 'load_more',
	];
	public function load_more()
	{
		$this->num += 8;
	}
    public function render()
    {	
		$category = SvgCategory::all();
		if($this->search){
			$files = SvgFile::where('category',$this->search)->orderBy('created_at','desc')->paginate($this->num);
		}else{
			$files = SvgFile::orderBy('created_at','desc')->paginate($this->num);
		}
		$this->load_more();
        return view('livewire.front.search.index', compact(['files','category']));
    }
}
