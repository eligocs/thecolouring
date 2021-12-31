<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Session;
use DB;
use Auth;


class UserController extends Controller

{

 

	//Livewire code here

	

    public function myDrawing()

    {

        return  view('page.student.svg.drawing');

    }

	public function drawings()

    {

        return  view('page.student.svg.index');

    }

	public function draw($id)

    {

        return  view('page.student.svg.draw',compact('id'));

    }

	public function edit($id)

    {
        $guest = Session::get('registered_guest'); 
		if(!empty($guest)){ 
			$user = DB::table('users')->where('id',\Auth::user()->id)->update([   
				'email_verified_at' => null, 
			]);     
		} 
        return  view('page.student.svg.edit',compact('id'));

    }

	public function myProfile(Request $request)

    {

		return view('page.student.profile.show', [

            'request' => $request,

            'user' => $request->user(),

        ]);

    }

	public function changePassword(Request $request)

    {

		return view('page.student.profile.password', [

            'request' => $request,

            'user' => $request->user(),

        ]);

    }

}

