@extends('customers.layouts.layout')

@section('content')
    <style>
        .my__account--section input {
            font-size: 16px;
        }
    </style>
    <x-title></x-title>
    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <p class="account__welcome--text">Hello, Admin welcome to your dashboard!</p>
            <div class="my__account--section__inner border-radius-10 d-flex">
                <x-customers.sidebar :customer="$customer"></x-customers.sidebar>
                <div class="account__wrapper">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Dash board</h2>
                        <div class="account__table--area">
                            <form method="POST" action="/customer/dashboard/update">
                                @csrf
                                @if (isset($customer))
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$customer->id}}">
                                @endif
                                <div class="row mb-3">
                                    <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customer->name ?? '') }}" required autocomplete="name" autofocus>
                
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                
                                <div class="row mb-3">
                                    <label for="email" class="col-md-2 col-form-label">{{ __('Email Address') }}</label>
                
                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customer->email ?? '') }}" required autocomplete="email">
                
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                
                                <div class="row mb-3">
                                    <label for="age" class="col-md-2 col-form-label">Age</label>
                
                                    <div class="col-md-10">
                                        <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', $customer->age ?? '') }}" required autocomplete="email">
                
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                
                                <div class="row mb-3">
                                    <label for="phone_number" class="col-md-2 col-form-label">Phone Number</label>
                
                                    <div class="col-md-10">
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $customer->phone_number ?? '') }}" required autocomplete="email">
                
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" d-flex justify-content-end"><button style="font-size: 16px" type="submit" class="btn btn-primary">Update</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>  
@endsection