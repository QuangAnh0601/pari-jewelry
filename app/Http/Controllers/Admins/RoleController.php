<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoleRepository;
use App\Http\Requests\EditRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        protected RoleRepository $roleRepo
    ){
        $this->middleware(['role:staff']);
    }


    public function index ()
    {
        return $this->roleRepo->listRole();
    }

    public function edit ($id = '')
    {
        return $this->roleRepo->editRole($id);
    }

    public function update (EditRoleRequest $request)
    {
        return $this->roleRepo->updateRole($request->all());
    }

    public function delete ($id)
    {
       return $this->roleRepo->deleteRole($id);
    }

    public function givePermissionTo(Request $request)
    {
        return $this->roleRepo->givePermissionTo($request->all());
    }

}
