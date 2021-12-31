<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
	public $pageUid;
	public $title;
	public $description;
	public $photo;
	public $old;
	
	public function mount(){
	    $content  = Page::where('type','about')->first();
		if($content){
			$this->pageUid = $content->id;
			$this->title = $content->title;
			$this->description =$content->description;
			$this->old = $content->photo;
		}
	}
	public function store()
    {
			$validatedData = $this->validate([
			
				'title' => 'required',
				'description' => 'required',
				'photo' => 'required|image|max:1024',

			]);
			$temp = $this->photo->store('photos');
			Page::create([
					'title' => $this->title,
					'type' => 'about',
					'photo' => $temp,
					'description' => $this->description
			]);
			session()->flash('message', 'Created Successfully.');
    }
	public function update()
    {

			$validatedData = $this->validate([
			
				'title' => 'required',
				'description' => 'required',

			]);
			if($this->photo){	
				$temp = $this->photo->store('photos');
    			Page::where('id', $this->pageUid)->update([
    					'title' => $this->title,
    					'photo' => $temp,
    					'description' => $this->description
    				]);
			}else{
			    Page::where('id', $this->pageUid)->update([
    					'title' => $this->title,
    					'description' => $this->description
    				]);
			}
			session()->flash('message', 'Updated Successfully.');
    }
    public function render()
    {
        return view('livewire.admin.about.index');
    }
}
