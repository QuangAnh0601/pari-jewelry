<?php

namespace App\View\Components;

use App\Models\OrderDetail;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class RecommendProduct extends Component
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
        $products = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
        ->select('products.id', 'products.name', 'products.price', DB::raw('SUM(order_details.quantity) as total_quantity'))
        ->groupBy('products.id', 'products.name', 'products.price')
        ->orderBy('total_quantity', 'desc')
        ->take(4)
        ->get();
        return view('components.recommend-product')->with('products', $products);
    }
}
