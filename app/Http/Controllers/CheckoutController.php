<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\PaypalRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Ship;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepo,
        protected OrderRepository $orderRepo,
        protected PaypalRepository $paypalRepo
    )
    {
        
    }

    public function index(AddToCartRequest $request)
    {
        $ships = Ship::all();
        $payments = Payment::all();
        if($request->has('quantity') && $request->has('productId'))
        {
            $this->productRepo->addToCart($request);
        }
        $products = session()->get('cart', []);
        if(auth()->guard('customer')->check())
        {
            $products = auth('customer')->user()->cart->products;
        }
        if(auth('customer')->check())
        {
            $customer = auth('customer')->user();
            return view('checkout-page')->with('ships', $ships)->with('products', $products)->with('payments', $payments)->with('customer', $customer);
        }
        else
        {
            return view('checkout-page')->with('ships', $ships)->with('products', $products)->with('payments', $payments);
        }
    }

    public function applyCouponCode (Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|uuid',
        ]);
        $coupon = Coupon::where('code', $request->coupon_code)->where('out_of_date', '>=', Carbon::now())->first();
        if(isset($coupon))
        {
            return response()->json(['discount_percent' => $coupon->discount_percent], 200);
        }
        else
        {
            return response()->json([
                'errors' => 
                    ['coupon_code' => 
                        ['This coupon is not in the system or has expired !']
                    ]
                ], 422);
        }
    }

    public function processCheckout (CheckoutRequest $request)
    {
        $order = $this->orderRepo->checkoutProccess($request);
        if($request->payment_id == 4)
        {
            return $this->paypalRepo->requestPayment($request);
        }
        return redirect('/checkout/success');
    }

    public function success ()
    {
        return view('checkout-success');
    }

    public function paymentSuccess (Request $request)
    {
        return $this->paypalRepo->paymentSuccess($request);
    }

    public function paymentCancel ()
    {
        return $this->paypalRepo->paymentCancel();
    }
}
