<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PermissionRepository;
use App\Http\Requests\EditPermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionRepository $permissionRepo
    ){}

    public function index ()
    {
        return $this->permissionRepo->listPermission();
    }

    public function edit ($id = '')
    {
        return $this->permissionRepo->editPermission($id);
    }

    public function update (EditPermissionRequest $request)
    {
        return $this->permissionRepo->updatePermission($request->all());
    }

    public function delete ($id)
    {
       return $this->permissionRepo->deletePermission($id);
    }

}
