<?php

namespace App\Http\Controllers\Customers\MyPage;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Requests\EditCustomerAddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(protected CustomerRepository $customerRepo)
    {
        $this->middleware('auth:customer');
    }
    
    public function index()
    {
        return $this->customerRepo->showCustomerAddress();
    }

    public function edit ($id = '')
    {
        return $this->customerRepo->EditCustomerAddress($id);
    }

    public function update (EditCustomerAddressRequest $request)
    {
        return $this->customerRepo->updateAddressByCustomer($request->all());
    }
}
