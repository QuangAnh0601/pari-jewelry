<?php

namespace App\Http\Controllers\Customers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\AuthenticatesCustomers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesCustomers;

        /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }
}
