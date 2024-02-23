<?php

namespace App\Http\Repositories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    
    public function listProduct ()
    {
        $products = Product::where('visibility', 'Display')->paginate(9);
        return view('product-page')->with('products', $products);
    }

    public function getProductById ($id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function quickView ($data)
    {
        $product = Product::find($data->id);
        $images = $product->productImages;
        return response()->json([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => number_format($product->price, 0, '.', ','),
            'material' => $product->material,
            'images' => $images,
            'description' => $product->description,
            'weight' => $product->weight
        ], 200);
    }

    public function addToCart ($data)
    {
        // dd(Auth::guard('customer')->check());
        $product = Product::findOrFail($data->productId);
        if(isset($data->quantity))
        {
            $quantity = $data->quantity;
        }
        else
        {
            $quantity = 1;
        }
        if($product->status == 'Out Of Stock')
        {
            return response()->json('Sorry this product is currently out of stock', 500);
        }
        else{
            $cart = session()->get('cart', []);
            if(isset($cart[$data->productId]))
            {
                $cart[$data->productId]['quantity'] += $quantity;
                $cart[$data->productId]['total_price'] = floatval((float)$product->price * $cart[$data->productId]['quantity']);
            }
            else
            {
                $image = $product->productImages->first() ? $product->productImages->first()->file_name : 'no-image.png';
                $cart[$data->productId] = [
                    'product_name' => $product->name,
                    'image' => $image,
                    'quantity' => intval($quantity),
                    'price' => number_format($product->price, 0, '.', ','),
                    'material' => $product->material,
                    'weight' => $product->weight,
                    'total_price' => floatval((float)$product->price * $quantity),
                ];
            }
            session()->put('cart', $cart);
            $cartQuantity = count($cart);
            if(Auth::guard('customer')->check())
            {
                $customer = Customer::find(Auth::guard('customer')->id());
                $syncDataCart = [];
                $customerCart = $customer->cart()->first();
                if(isset($customerCart))
                {
                    $cartDetail = [];
                        if(in_array($data->productId, $customerCart->products->pluck('id')->toArray()))
                        {
                            $availableQuantity = $customerCart->products()->where('product_id', $data->productId)->first()->pivot->quantity;
                            $customerCart->products()->updateExistingPivot($data->productId, ['quantity' => $availableQuantity + $quantity]);
                            $cartQuantity = $customer->cart->quantity;
                            $productInCart = $customerCart->products()->where('product_id', $data->productId)->first();
                            $cartDetail[$data->productId] = [
                                'product_name' => $productInCart->name,
                                'image' => $product->productImages->first() ? $product->productImages->first()->file_name : 'no-image.png',
                                'quantity' => intval($availableQuantity + $quantity),
                                'price' => number_format($productInCart->price, 0, '.', ','),
                                'material' => $productInCart->material,
                                'weight' => $productInCart->weight,
                                'total_price' => floatval((float)$productInCart->price * ($availableQuantity + $quantity)),
                            ];
                            return response()->json([
                                'cart_detail' => $cartDetail[$data->productId],
                                'cartQuantity' => $cartQuantity,
                                'product_id' => $data->productId,
                            ], 200);
                        }
                        else
                        {
                            $customerCart->products()->attach($data->productId, ['quantity' => $quantity]);
                            $quantity = $customerCart->products()->wherePivot('product_id', $data->productId)->first()->pivot->quantity;
                            $cartQuantity = $customer->cart->quantity + 1;
                            $customerCart->update(['quantity' => $cartQuantity]);
                            $productInCart = $customerCart->products()->where('product_id', $data->productId)->first();
                            $cartDetail[$data->productId] = [
                                'product_name' => $productInCart->name,
                                'image' => $product->productImages->first() ? $product->productImages->first()->file_name : 'no-image.png',
                                'quantity' => intval($quantity),
                                'price' => number_format($productInCart->price, 0, '.', ','),
                                'material' => $productInCart->material,
                                'weight' => $productInCart->weight,
                                'total_price' => floatval((float)$productInCart->price * $quantity),
                            ];
                            return response()->json([
                                'cart_detail' => $cartDetail[$data->productId],
                                'cartQuantity' => $cartQuantity,
                                'product_id' => $data->productId,
                            ], 200);
                        }
                           
                    // $customer->cart()->update(['quantity' => $cartQuantity]);
                }
                else
                {
                    $customer->cart()->create(['quantity' => $cartQuantity]);
                }
                foreach ($cart as $key => $value) {
                    $syncDataCart[$key] = ['quantity' => $value['quantity']];
                }
                $customer->cart->products()->sync($syncDataCart);
                return response()->json([
                    'cart_detail' => $cart[$data->productId],
                    'cartQuantity' => $cartQuantity
                ], 200);
            }
            return response()->json([
                'cart_detail' => $cart[$data->productId],
                'cartQuantity' => $cartQuantity,
                'product_id' => $data->productId,
            ], 200);
        }
    
        
    }

    public function addToWishList ($id)
    {
        $customer = Customer::find(auth('customer')->id());
        $check = $customer->products->where('id', $id)->first();
        if (isset($check))
        {
            $customer->products()->detach($id);
            return redirect('/customer/wish-list')->with('message', 'you have just removed a product from your wishlist !');
        }
        else
        {
            $customer->products()->attach($id);
            return redirect('/customer/wish-list')->with('message', 'you just added a product to your wishlist !');
        }

    }

    public function searchProduct ($data)
    {
        $products = Product::Where([
            ['visibility', 'LIKE', 'Display'],
            ['name', 'LIKE', '%'.$data->search.'%']
        ])->paginate(9);
        return view('product-page')->with('products', $products);
    }
}

?>