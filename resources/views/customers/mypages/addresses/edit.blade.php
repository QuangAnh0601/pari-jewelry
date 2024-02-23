@extends('customers.layouts.layout')

@section('content')
    <style>
        .my__account--section input {
            font-size: 16px;
        }
        input[type='radio']:checked {
            background-color:#C97F5F !important;
            outline: #C97F5F;
            border-color: #C97F5F; 
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
                <div class="account__wrapper position-relative">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Edit Order Detail</h2>
                        @if ($errors->has('permission'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('permission') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="account__table--area">
                            <form method="POST" action="/customer/address/update">
                                @csrf
                                @if (isset($address))
                                    @method('PUT')
                                    <input type="hidden" name="id" id="id" value="{{ $address->id }}">
                                @endif

                                <div class="mb-3 row">
                                    <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="full_name" id="full_name" value="{{ old('full_name', $address->full_name ?? '') }}">
                                        @error("full_name")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="phone_number" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $address->phone_number ?? '') }}">
                                        @error("phone_number")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="address_number" class="col-sm-2 col-form-label">No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address" id="address_number" value="{{ old('address', $address->address ?? '') }}">
                                        @error("address")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="ward" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ward" id="ward" value="{{ old('ward', $address->ward ?? '') }}">
                                        @error("ward")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="district" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="district" id="district" value="{{ old('district', $address->district ?? '') }}">
                                        @error("district")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $address->city ?? '') }}">
                                        @error("city")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="is_default" class="col-sm-2 col-form-label">Is Default</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_default" id="yes" value="yes" {{ old('is_default', $address->is_default ?? '') == 'yes' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="yes">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class=" d-flex justify-content-end"><button style="font-size: 16px" type="submit" class="btn btn-primary">Update</button></div>
                            </form>
                        </div>
                    </div>
                    <div><a href="/customer/address" style="font-size: 18px; color: #C97F5F; text-decoration:none;" class="position-absolute bottom-0 end-0"><i class="fas fa-arrow-left"></i> Back to Address List</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>
@endsection