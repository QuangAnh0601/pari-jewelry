<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Requests\EditCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerRepository $customerRepo
    ){}

    public function index ()
    {
        $customers = Customer::paginate(5);
        return view('admins.customers.index')->with('customers', $customers);
    }

    public function edit ($id = '')
    {
        if(!empty($id)){
            $customer = Customer::find($id);
            return view('admins.customers.edit')->with('customer', $customer);
        }
        else
        {
            return view('admins.customers.edit');
        }
    }

    public function update (EditCustomerRequest $request)
    {
        return $this->customerRepo->createCustomerByAdmin($request->all());
    }
}
