<?php

namespace App\Http\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class FilterRepository
{
    public function sortByFilter ($data)
    {
        $products = Product::where('visibility', 'Display');

        if(isset($data->sort_by))
        {
            if ($data->sort_by == 'latest')
            {
                $products->orderBy('created_at', 'desc');
            }
            
            if ($data->sort_by == 'popularity')
            {
                $products->select('products.id', 'products.name', 'products.price', DB::raw('SUM(order_details.quantity) as total_quantity'))
                    ->join('order_details', 'products.id', '=', 'order_details.product_id')
                    ->groupBy('products.id', 'products.name', 'products.price')
                    ->orderByRaw('total_quantity DESC');
            }
            
            if ($data->sort_by == 'rating')
            {
                $products->select('products.id', 'products.name', 'products.price', DB::raw('COUNT(reviews.rating) as total_rating'))
                    ->join('reviews', 'products.id', '=', 'reviews.product_id')
                    ->groupBy('products.id', 'products.name', 'products.price')
                    ->orderByRaw('total_rating DESC');
            }
        }
        
        if(isset($data->price_from))
        {
            $products->where('price', '>=', $data->price_from);
        }
        if(isset($data->price_to))
        {
            $products->where('price', '<=', $data->price_to);
        }
        
        if(isset($data->category_filter))
        {
            $categoryName = str_replace('-', ' ', $data->category_filter);
            $category = Category::where('name', $categoryName)->first();
            $products->whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            });
        }
        
        if(isset($data->material_filter))
        {
            $materials = str_replace('-', ' ', $data->material_filter);
            $products->whereIn('material', $materials);
        }
        
        if(isset($data->brand_filter))
        {
            $brands = str_replace('-', ' ', $data->brand_filter);
            $products->whereIn('brand', $brands);
        }
        
        $products = $products->paginate(9);
        return view('product-page')->with('products', $products)->with('filter', $data->sort_by);
        
    }
}

?>
