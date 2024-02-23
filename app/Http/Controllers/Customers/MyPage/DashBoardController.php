<?php

namespace App\Http\Controllers\Customers\MyPage;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Requests\EditAvatarResquest;
use App\Http\Requests\EditCustomerProfileRequest;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct(protected CustomerRepository $customerRepo)
    {
        $this->middleware('auth:customer');
    }
    public function index()
    {
        return $this->customerRepo->customerShowProfile();
    }

    public function updateAvatar (EditAvatarResquest $request)
    {
        return $this->customerRepo->customerUpdateAvatar($request);
    }

    public function update (EditCustomerProfileRequest $request)
    {
        return $this->customerRepo->CustomerUpdateProfile($request->all());
    }
}
