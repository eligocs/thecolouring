<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Page;
use Livewire\Component;

class Index extends Component
{
	public $pageUid;
	public $title;
	public $description;
	
	public function store()
    {
			$validatedData = $this->validate([
			
				'title' => 'required',
				'description' => 'required',

			]);
			Page::create([
					'title' => $this->title,
					'type' => 'contact',
					'description' => $this->description
			]);
			session()->flash('message', 'Created Successfully.');
			$this->reset('title');
			$this->reset('description');
    }
	public function update()
    {

			$validatedData = $this->validate([
			
				'title' => 'required',
				'description' => 'required',

			]);
			Page::where('id', $this->pageUid)->update([
					'title' => $this->title,
					'description' => $this->description
				]);
			session()->flash('message', 'Updated Successfully.');
			$this->reset('title');
			$this->reset('description');
    }
    public function render()
    { 
		$content  = Page::where('type','contact')->first();
		if($content){
			$this->pageUid = $content->id;
			$this->title = $content->title;
			$this->description =$content->description;
		}
        return view('livewire.admin.contact.index');
    }
}
