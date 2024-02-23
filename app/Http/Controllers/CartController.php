<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CartRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\AddToCartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartRepository $cartRepo,
        protected ProductRepository $productRepo
    ){}
    public function index()
    {
        $products = session()->get('cart', []);
        if(auth()->guard('customer')->check())
        {
            $products = auth('customer')->user()->cart->products;
        }
        if(auth('customer')->check())
        {
            $customer = auth('customer')->user();
            return view('cart-page')->with('products', $products)->with('customer', $customer);
        }
        else
        {
            return view('cart-page')->with('products', $products);
        }
    }
    
    public function changeQuantity (Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'min:1|numeric',
        ]);
        return $this->cartRepo->changeQuantity($request);
    }

    public function remove (Request $request)
    {
        return $this->cartRepo->removeItem($request);
    }

    public function addToCart (AddToCartRequest $request)
    {
        return $this->productRepo->addToCart($request);
    }
}
