<?php

namespace App\View\Components;

use App\Models\Review;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopRateProduct extends Component
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
        $reviews = Review::select('id', 'product_id')->orderBy('rating', 'desc')->groupBy('product_id', 'id')->take(3)->get();
        return view('components.top-rate-product')->with('topRates', $reviews);
    }
}
