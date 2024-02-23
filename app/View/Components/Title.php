<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Title extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Request $request)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $splitPath = explode('/', $this->request->path());
        $currentName = str_replace('-', ' ', $splitPath[0]);
        $upperCaseName = ucwords($currentName);
        return view('components.title')->with('currentName', $upperCaseName);
    }
}
