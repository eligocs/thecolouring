<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function myProfile(Request $request)
    {
    
		return view('page.editor.profile', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function changePassword(Request $request)
    {
		return view('page.editor.changepassword', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
