<?php

namespace App\Http\Controllers\Customers\MyPage;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\AddToCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function __construct(
        protected CustomerRepository $customerRepo,
        protected ProductRepository $productRepo
    )
    {
    }

    public function index()
    {
        return $this->customerRepo->wishList();
    }

    public function delete ($id)
    {
        return $this->customerRepo->deleteProductFromWishList($id);
    }

    public function addToWishList ($id)
    {
        return $this->productRepo->addToWishList($id);
    }
}
