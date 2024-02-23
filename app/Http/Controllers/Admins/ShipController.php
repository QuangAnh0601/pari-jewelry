<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditShipRequest;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipController extends Controller
{
    public function index ()
    {
        $ships = Ship::paginate(5);
        return view('admins.ships.index')->with('ships', $ships);
    }

    public function edit ($id = '')
    {
        if(!empty($id)){
            $ship = Ship::find($id);
            return view('admins.ships.edit')->with('ship', $ship);
        }
        else
        {
            return view('admins.ships.edit');
        }
    }

    public function update (EditShipRequest $request)
    {
        $data = $request->all();
        $data['create_by'] = Auth::id();
        if(isset($request->id))
        {
            $ship = Ship::find($request->id);
            $ship->update($data);
            return redirect('/admin/ship')->with('message', 'Update Ship successfully !');
        }
        else
        {
            Ship::create($data);
            return redirect('/admin/ship')->with('message', 'Create Ship successfully !');
        }
    }

    public function delete ($id)
    {
        $ship = Ship::find($id);
        $ship->delete();
        return redirect('/admin/ship')->with('message', 'Delete ship successfully !');
    }
}
