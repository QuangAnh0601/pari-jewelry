@extends('layouts.sb-admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Register') }}</h6>
        </div>

        <div class="card-body">
            <form method="POST" action="/admin/user/update">
                @csrf
                @if (isset($user))
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$user->id}}">
                @endif
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name ?? '') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-10">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email ?? '') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="age" class="col-md-2 col-form-label text-md-end">Age</label>

                    <div class="col-md-10">
                        <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', $user->age ?? '') }}" required autocomplete="email">

                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone_number" class="col-md-2 col-form-label text-md-end">Phone Number</label>

                    <div class="col-md-10">
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}" required autocomplete="email">

                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="address" class="col-md-2 col-form-label text-md-end">Address</label>

                    <div class="col-md-10">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address ?? '') }}" required autocomplete="email">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="roles" class="col-md-2 col-form-label text-md-end">Role</label>

                    <div class="col-md-10">
                        @foreach ($roles as $role)
                            <div class="custom-control custom-switch">
                                @if (isset($user))
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" class="custom-control-input" id="role-{{$role->id}}" @if (in_array($role->id, old('roles', $user->roles()->pluck('roles.id')->toArray())))
                                        checked
                                    @endif>
                                @else
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" class="custom-control-input" id="role-{{$role->id}}" @if (in_array($role->id, old('roles', [])))
                                        checked
                                    @endif>    
                                @endif
                                <label class="custom-control-label" for="role-{{$role->id}}">{{$role->name}}</label>
                            </div>
                        @endforeach
                        @error('roles')
                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
