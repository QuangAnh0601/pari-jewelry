<?php

namespace App\Http\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleRepository
{
    public function listRole ()
    {
        $roles = Role::paginate(5);
        return view('admins.roles.index')->with('roles', $roles);
    }

    public function editRole ($id)
    {
        if(empty($id))
        {
            return view('admins.roles.edit');
        }
        else
        {
            $role = Role::find($id);
            return view('admins.roles.edit')->with('role', $role);
        }
    }

    public function updateRole ($data = [])
    {
        if(isset($data['id']))
        {
            $role = Role::find($data['id']);
            $role->update($data);
            return redirect('/admin/role')->with('message', 'Update Role Successfully !');
        }
        else
        {
            Role::create($data);
            return redirect('/admin/role')->with('message', 'Create Role Successfully !');
        }
    }

    public function deleteRole ($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('/admin/role')->with('message', 'Delete Role Successfully !');
    }

    public function givePermissionTo ($data = [])
    {
        if($data['checked'] == true)
        {
            $role = Role::find($data['role_id']);
            $role->permissions()->attach($data['permission_id']);
            return 'Add succcesfully !';
        }
        else
        {
            $role = Role::find($data['role_id']);
            $role->permissions()->detach($data['permission_id']);
            return 'Remove succcesfully !';
        }
    }
}

?>