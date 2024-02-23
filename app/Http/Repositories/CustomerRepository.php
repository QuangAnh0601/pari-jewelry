<?php

namespace App\Http\Repositories;

use App\Events\CustomerRegistered;
use App\Models\Customer;
use App\Notifications\SendRandomUserPasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class CustomerRepository
{
    public function createCustomerByAdmin ($data = [])
    {
        if(isset($data['id']))
        {
            $data['is_default'] = true;
            $customer = Customer::find($data['id']);
            $customer->update($data);
            $customer->addresses()->create($data);
            return redirect('/admin/customer')->with('message', 'Update Customer successfull !');
        }
        else
        {
            $data['is_default'] = true;
            $randomString = Str::random('10');
            $data['password'] = Hash::make($randomString);
            $customer = Customer::create($data);
            event(new CustomerRegistered($customer));
            $customer->notify(new SendRandomUserPasswordNotification($randomString));
            $customer->addresses()->create($data);
            return redirect('/admin/customer')->with('message', 'Create Customer successfull !');
        }
    }

    public function customerShowProfile ()
    {
        $customer = Auth::user();
        return view('customers.mypages.dashboard')->with('customer', $customer);
    }

    
    public function customerShowOrderHistory ()
    {
        $customer = Auth::user();
        return view('customers.mypages.order-history')->with('customer', $customer);
    }

    public function CustomerUpdateProfile ($data)
    {
        $customer = Customer::find($data['id']);
        $customer->update($data);
        return redirect('/customer/dashboard')->with('message', 'Update Profile successfull !');
    }

    public function customerUpdateAvatar ($data)
    {
        $fileName = $this->saveImage($data->file('image'));
        $customer = Customer::find(Auth::id());
        $customer->update(['image' => $fileName]);
        return 'Update Image successfully !';
    }

    public function saveImage ($image)
    {
        $oldImage = Auth::user()->image;
        if($oldImage != 'no-image.png')
        {
            Storage::delete('customer-images/'.Auth::user()->image);
        }
        $fileName = md5($image->getClientOriginalName()).".". $image->getClientOriginalExtension();
        Storage::putFileAs("customer-images" , $image, $fileName);
        return $fileName;
    }

    public function showCustomerAddress ()
    {
        $customer = Auth::user();
        return view('customers.mypages.addresses.index')->with('customer', $customer);
    }

    public function EditCustomerAddress ($id)
    {
        $customer = Customer::find(Auth::id());
        if(empty($id))
        {
            return view('customers.mypages.addresses.edit')->with('customer', $customer);
        }
        else
        {
            $address = $customer->addresses->where('id', $id)->first();
            if(isset($address))
            {
                return view('customers.mypages.addresses.edit')->with('address', $address)->with('customer', $customer);
            }
            else
            {
                $permissionErrors = new MessageBag();
                $permissionErrors->add('permission', "You do not have the right to edit other people's addresses !");
                return redirect()->back()->withErrors($permissionErrors);
            }
        }
    }

    public function updateAddressByCustomer ($data = [])
    {
        $customer = Customer::find(Auth::id());
        if(isset($data['id']))
        {
            $address = $customer->addresses()->where('id', $data['id'])->first();
            if(isset($address))
            {
                $address->update($data);
                return redirect('customer/address')->with('message', 'Update Address successfully !');
            }   
            else
            {
                $permissionErrors = new MessageBag();
                $permissionErrors->add('permission', "Address not found or you do not have the permission to edit it!");
                return redirect()->back()->withErrors($permissionErrors);
            }
        }
        else
        {
            $data['is_default'] = true;
            $customer->addresses()->create($data);
            return redirect('customer/address')->with('message', 'Create Address successfully !');
        }
    }

    public function wishList()
    {
        $customer = Customer::find(Auth::id());
        return view('customers.mypages.wish-lists.index')->with('customer', $customer);
    }

    public function deleteProductFromWishList ($id)
    {
        $customer = Customer::find(Auth::id());
        $customer->products()->detach($id);
        return redirect('/customer/wish-list')->with('message', 'Delete Successfully !');
    }


}

?>