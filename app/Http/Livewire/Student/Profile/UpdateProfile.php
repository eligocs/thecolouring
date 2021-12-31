<?php

namespace App\Http\Livewire\Student\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\User;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

	public $photo;
	 /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];
	
	public function mount()
    {
		$this->state = Auth::user()->withoutRelations()->toArray();
		
    }
	public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
		$validatedData = $this->validate([
            'photo' => ['nullable', 'image', 'max:1024'],

        ]);
        $this->resetErrorBag();

        $updater->update(
            \Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );
		return redirect()->route('my-profile');
    }
	public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
		return redirect()->route('my-profile');
    }
    public function render()
    {
        return view('livewire.student.profile.update-profile');
    }
}
