<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index ()
    {
        $coupons = Coupon::paginate(5);
        return view('admins.coupons.index')->with('coupons', $coupons);
    }

    public function edit ($id = '')
    {
        if(!empty($id)){
            $coupon = Coupon::find($id);
            return view('admins.coupons.edit')->with('coupon', $coupon);
        }
        else
        {
            return view('admins.coupons.edit');
        }
    }

    public function update (EditCouponRequest $request)
    {
        $data = $request->all();
        $data['create_by'] = Auth::id();
        if(isset($request->id))
        {
            // dd($data);
            $coupon = Coupon::find($request->id);
            $coupon->update($data);
            return redirect('/admin/coupon')->with('message', 'Update Coupon successfully !');
        }
        else
        {
            coupon::create($data);
            return redirect('/admin/coupon')->with('message', 'Create Coupon successfully !');
        }
    }

    public function delete ($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect('/admin/coupon')->with('message', 'Delete Coupon successfully !');
    }
}
