<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendingProduct extends Component
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
        $products = Product::where('visibility', 'Display')->withCount('customers')
            ->where("products.status", "not like", "%Expired%")
            ->orderBy('customers_count', 'desc')
            ->get();
        return view('components.trending-product')->with('products', $products);
    }
}
