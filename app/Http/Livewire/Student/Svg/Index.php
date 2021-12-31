<?php



namespace App\Http\Livewire\Student\Svg;



use App\Models\SvgFile;

use App\Models\SvgCategory;

use Livewire\Component;

use Livewire\WithPagination;



class Index extends Component

{

	use WithPagination;

protected $paginationTheme = 'bootstrap';



	

	public function destroy($id)

    {

		$isValid = SvgFile::where('id',$id);

        $isValid->delete();

		session()->flash('message', 'Image Deleted Successfully.');



    }



	public function gotoPage($page){

	    $this->page = $page;

        return redirect()->to('/drawings?page='.$page);

	}

	

	public function nextPage(){

	    $this->page += 1;

        return redirect()->to('/drawings?page='.$this->page);

	}

	

	public function previousPage(){

	    $this->page -= 1;

        return redirect()->to('/drawings?page='.$this->page);

	}

	

    public function render()

    {

        if(!empty($_GET['id'])){

        	$files = SvgFile::where('category',$_GET['id'])->orderBy('created_at','desc')->paginate(12);

        }else{

		    $files = SvgFile::orderBy('created_at','desc')->paginate(12); 

        } 
        $SvgCategory = SvgCategory::get();

        return view('livewire.student.svg.index', compact(['files','SvgCategory']));

    }

}

