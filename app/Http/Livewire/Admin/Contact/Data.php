<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\ContactData;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';
	
    public function render()
    { 
		return view('livewire.admin.contact.data', [
            'contact' => ContactData::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
