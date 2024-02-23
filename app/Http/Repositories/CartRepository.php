<?php

namespace App\Http\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CartRepository
{
    public function changeQuantity ($data)
    {
        if(session()->has('cart'))
        {
            $cart = session()->get('cart');
            $cart[$data->product_id]['quantity'] = intVal($data->quantity);
            $cart[$data->product_id]['total_price'] = $data->quantity * floatVal(str_replace(',', '', $cart[$data->product_id]['price']));
            session()->put('cart', $cart);
            if(auth('customer')->check())
            {
                $customer = Customer::find(Auth::guard('customer')->id());
                $customerCart = $customer->cart()->first();
                if(isset($customerCart))
                {
                    $customerCart->products()->updateExistingPivot($data->product_id, ['quantity' => $data->quantity]);
                    $cartDetail[$data->product_id] = ['total_price' => $data->quantity * floatVal(str_replace(',', '', $cart[$data->product_id]['price']))];
                    return response()->json($cart[$data->product_id], 200);
                }
            }
            return response()->json($cart[$data->product_id], 200);
        }
        else
        {
            return response()->json('error !', 500);
        }
    }

    public function removeItem ($data)
    {
        if(session()->has('cart'))
        {
            $cartLength = 0;
            $cart = session()->get('cart');
            unset($cart[$data->id]);
            session()->put('cart', $cart);
            $cartLength = count($cart);
        }
        
        if(auth('customer')->check())
        {
            $customer = Customer::find(Auth::guard('customer')->id());
            $customerCart = $customer->cart()->first();
            if(isset($customerCart))
            {
                $quantity = $customerCart->quantity;
                $customerCart->update(['quantity' => $quantity - 1]); 
                $customerCart->products()->detach($data->id);
                $cartLength = $customerCart->quantity;
            }
        }
        return response()->json([
            'cartQuantity' => $cartLength
        ], 200);
    }
}

?>