<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';
	
	public $delete_user_id;

	public function confirm($user_id)
    {
		$this->delete_user_id = $user_id;

    }
	
	public function destroy()
    {
		$isValid = User::where('id',$this->delete_user_id);
        $isValid->delete();
		session()->flash('message', 'User Deleted Successfully.');
		$this->reset('delete_user_id');
    }
    public function render()
    {
		return view('livewire.admin.users.index', [
            'users' => User::where('role','student')->paginate(10),
        ]);
    }
}
