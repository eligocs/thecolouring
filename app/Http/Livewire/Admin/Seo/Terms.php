<?php

namespace App\Http\Livewire\Admin\Seo;

use App\Models\SeoSetting;
use Livewire\Component;

class Terms extends Component
{

	public $meta_title;
	public $meta_description;
	public $meta_keyword;
	
	public function mount()
    {
        $data = SeoSetting::where('page','terms')->first();
        if($data){
            $this->meta_title = $data->meta_title;
            $this->meta_description = $data->meta_description;
            $this->meta_keyword = $data->meta_keyword;
        }
    }
	public function store()
    {

        $validatedData = $this->validate([
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',

        ]);
			SeoSetting::create([
				'page' =>'terms',
				'meta_title' =>$this->meta_title,
				'meta_description' =>$this->meta_description,
				'meta_keyword' =>$this->meta_keyword,
			]);
			session()->flash('message', 'Created Successfully.');
    }
	
	public function update()
    {

        $validatedData = $this->validate([
            
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',

        ]);
			$temp = SeoSetting::where('page','terms');
			$temp->update([
				'meta_title' =>$this->meta_title,
				'meta_description' =>$this->meta_description,
				'meta_keyword' =>$this->meta_keyword,
			]);
			session()->flash('message', 'Updated Successfully.');
    }
	
    public function render()
    {
        return view('livewire.admin.seo.terms');
    }
}
