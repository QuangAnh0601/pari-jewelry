<?php

namespace App\View\Components;

use App\Http\Repositories\CategoryRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Category extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CategoryRepository $categories)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): view|Closure|string 
    {
        $categories = $this->categories->listCategory();
        return view('components.category')->with('categories', $categories);
    }
}
