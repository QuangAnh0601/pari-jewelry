<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserRepository $userRepo
    ){}

    public function index ()
    {
        return $this->userRepo->listUser();
    }

    public function edit ($id = '')
    {
        return $this->userRepo->editUser($id);
    }

    public function update (EditUserRequest $request)
    {
        return $this->userRepo->updateUserByAdmin($request->all());
    }

    public function delete($id)
    {
        return $this->userRepo->deleteUser($id);
    }
}
