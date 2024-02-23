<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCustomerAddressRequest;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function edit($id, $anotherId) 
    { 
        $address = Address::find($anotherId);
        return view('admins.customerAddesses.edit')->with('address', $address)->with('customerId', $id);
    }

    public function update (EditCustomerAddressRequest $request)
    {
        $customer = Customer::find($request->customerId);
        $address = $customer->addresses->where('id', $request->id)->first();
        $address->update($request->all());
        return redirect('/admin/customer/edit/'.$request->customerId.'#customerAddress');
    }
}
