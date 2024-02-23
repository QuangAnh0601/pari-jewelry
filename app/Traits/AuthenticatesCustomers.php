<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthenticatesCustomers
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function showLoginForm()
    {
        return view('customers.auth.login');
    }

        /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
                $customer = auth('customer')->user();
                $cart = session()->get('cart', []);
                $this->syncCart($customer, $cart);
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function logout()
    {
        $this->guard('customer')->logout();

        return redirect('/');
    }

    public function syncCart($customer, $cart)
    {
        $cartQuantity = count($cart);
        $customerCart = $customer->cart()->first();
        if($cartQuantity > 0 )
        {
            if(isset($customerCart))
            {
                foreach ($cart as $key => $value) {
                    if(in_array($key, $customerCart->products->pluck('id')->toArray()))
                    {
                        $availableQuantity = $customerCart->products()->where('product_id', $key)->first()->pivot->quantity;
                        $customerCart->products()->updateExistingPivot($key, ['quantity' => $availableQuantity + $value['quantity']]);
                        $cartQuantity = $customerCart->products()->count();
                        $customer->cart()->update(['quantity' => $cartQuantity]);
                    }
                    else
                    {
                        $customerCart->products()->attach($key, ['quantity' => $value ['quantity']]);
                        $cartQuantity = $customerCart->products()->count();
                        $customer->cart()->update(['quantity' => $cartQuantity]);
                    }
                       
                }
                return response()->json('successfully !', 200);
            }
            else
            {
                $customer->cart()->create(['quantity' => $cartQuantity]);
            }
        }
        else
        {
            return response()->json('There are no products in the cart !', 200);
        }
    }
}