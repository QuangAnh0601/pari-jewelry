<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function __construct(protected ProductRepository $productRepo)
    {
        
    }

    public function show($id)
    {
        $product = $this->productRepo->getProductById($id);
        return view('product-detail-page')->with('product', $product);
    }
}
