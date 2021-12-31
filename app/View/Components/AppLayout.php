<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Logo;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
		$logo = Logo::first();
        return view('layouts.app', compact('logo'));
    }
}
