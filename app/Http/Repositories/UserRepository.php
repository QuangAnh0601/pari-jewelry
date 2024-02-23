<?php

namespace App\Http\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Notifications\SendRandomUserPasswordNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository
{
    public function listUser ()
    {
        $users = User::paginate(5);
        return view('admins.users.index')->with('users', $users);
    }

    public function editUser ($id)
    {
        if(empty($id))
        {
            $roles = Role::all();
            return view('admins.users.edit')->with('roles', $roles);
        }
        else
        {
            $roles = Role::all();
            $user = User::find($id);
            return view('admins.users.edit')->with('user', $user)->with('roles', $roles);
        }
    }

    public function updateUserByAdmin ($data = [])
    {
        if(isset($data['id']))
        {
            $user = User::find($data['id']);
            $user->update($data);
            if(isset($data['roles']))
            {
                $user->roles()->sync($data['roles']);
            }
            else
            {
                $user->roles()->sync([]);
            }
            return redirect('/admin/user')->with('message', 'Update User Successfully !');
        }
        else
        {
            $data['password'] = Str::random(16);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'age' => $data['age'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
            ]);
            if(isset($data['roles']))
            {
                $user->roles()->attach($data['roles']);
            }
            else
            {
                $user->roles()->attach(Role::where('name', 'staff')->first('id'));
            }
            event(new Registered($user));
            $user->notify(new SendRandomUserPasswordNotification($data['password']));
            return redirect('/admin/user')->with('message', 'Create User Successfully !');
        }
    }

    public function deleteUser ($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user')->with('message', 'Delete User Successfully !');
    }

    
    public function showProfile ()
    {
        $user = Auth::user();
        return view('admins.users.profile')->with('user', $user);
    }

    public function updateProfile ($data = [])
    {
        $user = User::find($data['id']);
        $user->update($data);
        return redirect('/admin/profile')->with('message', 'Update Profile Successfully !');
    }

    public function updateProfileImage ($data)
    {
        $fileName = $this->saveImage($data->file('image'));
        $user = User::find(Auth::id());
        $user->update(['image' => $fileName]);
        return 'Update Image successfully !';
    }

    public function saveImage ($image)
    {
        $oldImage = Auth::user()->image;
        if($oldImage != 'no-image.png')
        {
            Storage::delete('user-images/'.Auth::user()->image);
        }
        $fileName = md5($image->getClientOriginalName()).".". $image->getClientOriginalExtension();
        Storage::putFileAs("user-images" , $image, $fileName);
        return $fileName;
    }
}

?>