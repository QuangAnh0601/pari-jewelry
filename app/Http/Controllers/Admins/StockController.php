<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditStockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index ()
    {
        $stocks = Stock::paginate(5);
        return view('admins.stocks.index')->with('stocks', $stocks);
    }

    public function edit ($id = '')
    {
        if(empty($id))
        {
            return view('admins.stocks.edit');
        }
        else
        {
            $stock = Stock::find($id);
            return view('admins.stocks.edit')->with('stock', $stock);
        }
    }

    public function update (EditStockRequest $request)
    {
        $data = $request->all();
        $data['create_by'] = Auth::id();
        if(isset($request->id))
        {
            $stock = Stock::find($request->id);
            $stock->update($data);
            return redirect('/admin/stock')->with('message', 'Update Stock successfully !');
        }
        else
        {
            Stock::create($data);
            return redirect('/admin/stock')->with('message', 'Create Stock successfully !');
        }
    }

    public function delete ($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return redirect('/admin/stock')->with('message', 'Delete Stock successfully !');
    }
}
