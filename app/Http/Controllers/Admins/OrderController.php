<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\EditOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderRepository $orderRepo)
    {
        
    }

    public function index ()
    {
        return $this->orderRepo->listOrderByAdmin();
    }

    public function edit ($id = '')
    {
        return $this->orderRepo->editOrderByAdmin($id);
    }

    public function update (EditOrderRequest $request)
    {
        return $this->orderRepo->updateOrderByAdmin($request->all());
    }

    public function updateStatus (Request $request)
    {
        return $this->orderRepo->updateStatus($request->all());
    }
}
