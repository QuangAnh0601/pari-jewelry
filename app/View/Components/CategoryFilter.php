<?php

namespace App\View\Components;

use App\Http\Repositories\CategoryRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CategoryRepository $categoryRepo)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = $this->categoryRepo->listCategory();
        return view('components.category-filter')->with('categories', $categories);
    }
}
