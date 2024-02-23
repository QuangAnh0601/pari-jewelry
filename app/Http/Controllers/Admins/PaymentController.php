<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index ()
    {
        $payments = Payment::paginate(5);
        return view('admins.payments.index')->with('payments', $payments);
    }

    public function edit ($id = '')
    {
        if(!empty($id)){
            $payment = Payment::find($id);
            return view('admins.payments.edit')->with('payment', $payment);
        }
        else
        {
            return view('admins.payments.edit');
        }
    }

    public function update (EditPaymentRequest $request)
    {
        $data = $request->all();
        $data['create_by'] = Auth::id();
        if(isset($request->id))
        {
            $payment = Payment::find($request->id);
            $payment->update($data);
            return redirect('/admin/payment')->with('message', 'Update Payment successfully !');
        }
        else
        {
            Payment::create($data);
            return redirect('/admin/payment')->with('message', 'Create Payment successfully !');
        }
    }

    public function delete ($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect('/admin/payment')->with('message', 'Delete payment successfully !');
    }
}
