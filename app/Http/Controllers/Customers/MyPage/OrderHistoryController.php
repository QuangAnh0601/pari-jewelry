<?php

namespace App\Http\Controllers\Customers\MyPage;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\EditOrderDetailRequest;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function __construct(
        protected OrderRepository $orderRepo,
        protected CustomerRepository $customerRepo
    )
    {
        
    }
    public function index ()
    {
        return $this->customerRepo->customerShowOrderHistory();
    }

    public function showOrderDetail ($id)
    {
        return $this->orderRepo->showOrderDetail($id);
    }

    public function editOrderDetail ($orderId, $orderDetailId)
    {
        return $this->orderRepo->editOrderDetailByCustomer($orderId, $orderDetailId);
    }

    public function updateOrderDetail (EditOrderDetailRequest $request)
    {
        return $this->orderRepo->updateOrderDetailByCustomer($request->all());
    }

    public function deleteOrderDetail ($id, $otherId)
    {
        return $this->orderRepo->deleteProductInOrder($id, $otherId);
    }
}
