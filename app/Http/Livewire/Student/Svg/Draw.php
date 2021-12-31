<?php



namespace App\Http\Livewire\Student\Svg;



use Livewire\Component;

use App\Models\SvgFile;

use App\Models\Color;

use App\Models\UserSvg;

use Session;

use DB;


class Draw extends Component

{

	public $files;

	public $color;

	public $uid;

	public $name;

	public $file;

	public $other = [];

	public $userId;

	protected $listeners = ['created' => 'create'];

	

	public function mount($id)

    {

		$this->uid = \Auth::user()->id;

		$this->files = SvgFile::where('id',$id)->get();

		$this->name = $this->files[0]->name;

		$this->color = Color::all();

		$this->other = SvgFile::where('category',$this->files[0]->category)->get();

    }

	public function create()

    {  
		$id = UserSvg::create([
			
			'name' => $this->name,
			
			'file' => $this->file,
			
			'user_id' => $this->uid
			
			])->id;
			 
	  
		 
			return redirect()->route('edit',$id);
		 
 

    }

    public function render()

    {

        return view('livewire.student.svg.draw');

    }

}

