<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Logo;

class StudentLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
		$logo = Logo::first();
        return view('layouts.student', compact('logo'));
    }
}
