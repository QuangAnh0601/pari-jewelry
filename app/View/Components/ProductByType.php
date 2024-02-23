<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ProductByType extends Component
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
        $newestProducts = Product::where('visibility', 'Display')->orderBy('id', 'desc')->take(3)->get();
        $trendingProducts = Product::where('visibility', 'Display')->withCount('customers')
        ->orderBy('customers_count', 'desc')
        ->take(3)
        ->get();
        $bestSellers = Product::where('visibility', 'Display')->select('products.id', 'products.name', 'products.price', DB::raw('SUM(order_details.quantity) as total_quantity'))
        ->join('order_details', 'products.id', '=', 'order_details.product_id')
        ->groupBy('products.id', 'products.name', 'products.price')
        ->orderByRaw('total_quantity DESC')
        ->take(3)
        ->get();
        return view('components.product-by-type', compact('newestProducts', 'trendingProducts', 'bestSellers'));
    }
}
