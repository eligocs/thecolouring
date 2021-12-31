<?php

namespace App\Http\Livewire\Student\Svg;

use Livewire\Component;
use App\Models\Color;
use App\Models\SvgFile;
use App\Models\UserSvg;

class Edit extends Component
{
	public $files;
	public $color;
	public $uid;
	public $file_id;
	public $file;
	public $other = [];
	protected $listeners = ['updated' => 'update'];
	
	public function mount($id)
    {
		$this->file_id = $id;
		$this->uid = \Auth::user()->id;
		$this->files = UserSvg::where('id',$id)->get();
		$this->color = Color::all();
    }
	public function update()
    {

        UserSvg::where('id',$this->file_id)->update([
				'file' => $this->file
		]);
		return redirect()->route('edit',$this->file_id);

    }
    public function render()
    {
        return view('livewire.student.svg.edit');
    }
}
