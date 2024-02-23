<?php

namespace App\View\Components;

use App\Http\Repositories\ProductRepository;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MaterialFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $products = Product::where('visibility', 'Display')->paginate(9);
        return view('components.material-filter')->with('products', $products);
    }
}
