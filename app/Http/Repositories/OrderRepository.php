<?php

namespace App\Http\Repositories;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Ship;
use App\Notifications\CheckoutSuccessNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\MessageBag;

class OrderRepository
{
    public function listOrderByAdmin ()
    {
        $orders = Order::paginate(5);
        return view('admins.orders.index')->with('orders', $orders);
    }

    public function editOrderByAdmin ($id)
    {
        if(empty($id))
        {
            $coupons = Coupon::all();
            $ships = Ship::all();
            $payments = Payment::all();
            $products = Product::all();
            $customers = Customer::all();
            return view('admins.orders.edit')->with('customers', $customers)->with('products', $products)->with('ships', $ships)->with('payments', $payments)->with('coupons', $coupons);
        }
        else
        {
            $coupons = Coupon::all();
            $ships = Ship::all();
            $payments = Payment::all();
            $products = Product::all();
            $customers = Customer::all();
            $order = Order::find($id);
            return view('admins.orders.edit')->with('order', $order)->with('customers', $customers)->with('products', $products)->with('ships', $ships)->with('payments', $payments)->with('coupons', $coupons);
        }
    }

    public function updateOrderByAdmin ($data = [])
    {

        if(isset($data['id']))
        {
            $order = Order::find($data['id']);
            $order->update($data);
            $orderProductIds = $order->orderDetails->pluck('product_id')->toArray();
            $productArr = [];
            foreach ($data['product'] as $orderDetail) {
                $decode = json_decode($orderDetail, true);
                array_push($productArr, $decode['product_id']);
                if(!in_array($decode['product_id'], $orderProductIds))
                {
                    $order->orderDetails()->create($decode);
                }
                $order->orderDetails()->firstWhere('product_id', $decode['product_id'])->update($decode);
            }
            foreach ($orderProductIds as $item) {
                if(!in_array($item, $productArr))
                {
                    $order->orderDetails()->firstWhere('product_id', $item)->delete();
                }
            }
            return redirect('admin/order')->with('message', 'Update Order Successfully !');
        }
        else
        {
            $admin = auth('web')->user();
            $order = $admin->orders()->create($data);
            foreach ($data['product'] as $orderDetail) {
                $decode = json_decode($orderDetail, true);
                $order->orderDetails()->create($decode);
            }
            $order->notify(new CheckoutSuccessNotification());
            return redirect('admin/order')->with('message', 'Create Order Successfully !');
        }
    }

    public function updateStatus ($data = [])
    {
        $checkStatus = ['New', 'Delivering', 'Delivered', 'Cancel'];
        if(in_array($data['status'], $checkStatus))
        {
            $order = Order::find($data['id']);
            if($order->status == 'New')
            {
                DB::beginTransaction();
                try {
                    foreach ($order->orderDetails as $orderDetail) {
                        $checkStock = $orderDetail->product->stocks()->wherePivot('quantity','>=', $orderDetail->quantity)->wherePivot('out_of_date','>=', Carbon::now())->first();
                        // dd($checkStock);
                        if (isset($checkStock)) 
                        {
                            $quantity = $checkStock->pivot->quantity - $orderDetail->quantity;
                            $orderDetail->product->stocks()->updateExistingPivot($checkStock->id, ['quantity' => $quantity]);
                        } else 
                        {
                            throw new Exception('One or more products in your order are out of stock or have expired!');
                        }
                        
                    }
                }
                catch (Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'error' => $e->getMessage()
                    ], 500);
                }
                DB::commit();
            }
            else
            {
                if($data['status'] == 'New')
                {
                    return response()->json([
                        'error' => 'Goods that are being delivered cannot be returned to the new creation state anymore !'
                    ], 500);
                }
            }
            $order->update([
                'status' => $data['status']
            ]);
            return response()->json([
                'success' => 'Update status Successfully !'
            ], 200);
        }
        else
        {
            return response()->json([
                'error' => 'Your order has a product that is out of stock or has expired !'
            ], 500);
        }
    }

    public function showOrderDetail ($id)
    {
        $customer = Auth::user();
        $order = $customer->orders()->where('id', $id)->first();
        $orderDetails = $order->orderDetails;
        return view('customers.mypages.order-details.index')->with('customer', $customer)->with('orderDetails',$orderDetails);

    }

    public function editOrderDetailByCustomer ($orderId, $orderDetailId)
    {
        $customer = Auth::user();
        $order = $customer->orders()->where('id', $orderId)->first();
        if(isset($order))
        {
            if($order->status != 'New')
            {
                $errors = new MessageBag();
                $errors->add('status_error', 'This order has been shipped and cannot be edited !');
                return redirect()->back()->with('errors', $errors);
            }
            $orderDetail = $order->orderDetails()->where('id', $orderDetailId)->first();
            if(isset($orderDetail))
            {
                return view('customers.mypages.order-details.edit')->with('orderDetail', $orderDetail)->with('customer', $customer);
            }
            else
            {
                return abort(403, 'you do not have access to a detail not in the current order');
            }
        }
        else
        {
            return abort(403, 'you do not have permission to access orders that are not yours');
        }
    }

    public function updateOrderDetailByCustomer ($data)
    {
        $customer = Auth::user();
        $order = $customer->orders()->where('id', $data['orderId'])->first();
        if(isset($order))
        {
            if($order->status != 'New')
            {
                $errors = new MessageBag();
                $errors->add('status_error', 'This order has been shipped and cannot be edited !');
                return redirect()->back()->with('errors', $errors);
            }
            $orderDetail = $order->orderDetails()->where('id', $data['orderDetailId'])->first();
            if(isset($orderDetail))
            {
                $orderDetail->update($data);
                $price = 0;
                foreach ($order->orderDetails as $item) {
                    $price += $item->price;
                }
                $totalPriceWithCoupon = $price - ($price * intval($order->coupon->discount_percent)/100);
                $order->update(['total_price' => $totalPriceWithCoupon]);
                return redirect("customer/order-history/showOrderDetail/".$data['orderId'])->with('message', 'Update Order Successfully !');
            }
            else
            {
                return abort(403, 'you do not have access to a detail not in the current order');
            }
        }
        else
        {
            return abort(403, 'you do not have permission to access orders that are not yours');
        }
    }

    public function deleteProductInOrder ($orderId, $orderDetailId)
    {
        $customer = Auth::user();
        $order = $customer->orders()->where('id', $orderId)->first();
        if(isset($order))
        {
            if($order->status != 'New')
            {
                $errors = new MessageBag();
                $errors->add('status_error', 'This order has been shipped and cannot be edited !');
                return redirect()->back()->with('errors', $errors);
            }
            $orderDetail = $order->orderDetails()->where('id', $orderDetailId)->first();
            if(isset($orderDetail))
            {
                $orderDetail->delete();
                return redirect("customer/order-history/showOrderDetail/$orderId")->with('message', 'successfully removed the product from the order');
            }
            else
            {
                return abort(403, 'you do not have access to a detail not in the current order');
            }
        }
        else
        {
            return abort(403, 'you do not have permission to access orders that are not yours');
        }
    }

    public function checkoutProccess ($data)
    {
        $orderDetails = $data->order_detail;
        if(auth('customer')->check())
        {
            $data['order_date'] = Carbon::now();
            $data['customer_id'] = auth('customer')->id();
            $customer = auth('customer')->user();
            // dd($data->all());
            $order = $customer->additionalOrders()->create($data->all());
            // dd($order);
            foreach ($orderDetails as $value) {
                $orderDetailData = json_decode($value, true);
                // dd($orderDetailData);
                $order->orderDetails()->create($orderDetailData);
            }
            $customer->cart->Products()->detach();
            $customer->cart()->delete();
        }
        else
        {
            $data['order_date'] = Carbon::now();
            $order = Order::create($data->all());
            foreach ($orderDetails as $value) {
                $orderDetailData = json_decode($value, true);
                $order->orderDetails()->create($orderDetailData);
            }
        }
        if(session()->has('cart'))
        {
            session()->forget('cart');
        }
        session(['checkout_success' => 'success']);
        $order->notify(new CheckoutSuccessNotification());
        return $order;
    }
}

?>