<?php

namespace App\Http\Repositories;

use App\Models\Permission;
use App\Models\Role;

class PermissionRepository
{
    public function listPermission ()
    {
        $roles = Role::all();
        $permissions = Permission::paginate(5);
        return view('admins.permissions.index')->with('permissions', $permissions)->with('roles', $roles);
    }

    public function editPermission ($id)
    {
        if(empty($id))
        {
            return view('admins.permissions.edit');
        }
        else
        {
            $permission = Permission::find($id);
            return view('admins.permissions.edit')->with('permission', $permission);
        }
    }

    public function updatePermission ($data = [])
    {
        if(isset($data['id']))
        {
            $permission = Permission::find($data['id']);
            $permission->update($data);
            return redirect('/admin/permission')->with('message', 'Update Permission Successfully !');
        }
        else
        {
            Permission::create($data);
            return redirect('/admin/permission')->with('message', 'Create Permission Successfully !');
        }
    }

    public function deletePermission ($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('/admin/permission')->with('message', 'Delete Permission Successfully !');
    }
}

?>