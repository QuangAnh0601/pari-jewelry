<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\EditAvatarResquest;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected UserRepository $userRepo
    )
    {
        
    }
    public function index ()
    {
        return $this->userRepo->showProfile();
    }

    public function update (EditProfileRequest $request)
    {
        return $this->userRepo->updateProfile($request->all());
    }

    public function updateImage (EditAvatarResquest $request)
    {
        return $this->userRepo->updateProfileImage($request);
    }
}
