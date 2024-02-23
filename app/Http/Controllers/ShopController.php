<?php

namespace App\Http\Controllers;

use App\Http\Repositories\FilterRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepo,
        protected FilterRepository $filterRepo
    )
    {
        
    }

    public function index()
    {
        return $this->productRepo->listProduct();
    }

    public function quickView (Request $request)
    {
        $request->validate([
            'quantity' => 'min:1|numeric',
        ]);
        return $this->productRepo->quickView($request);
    }

    public function sortByFilter (FilterRequest $request)
    {
        return $this->filterRepo->sortByFilter($request);
    }

    public function searchProduct (SearchRequest $request)
    {
        return $this->productRepo->searchProduct($request);
    }
}
