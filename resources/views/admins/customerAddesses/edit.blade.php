@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Customer Address</h6>
            </div>
            <div class="card-body">
                <form action="/admin/customer-address/update" method="POST">
                    @csrf
                    @if (isset($address))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$address->id}}">
                    @endif
                    <input type="hidden" name="customerId" value="{{$customerId}}">
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address', $address->address ?? '')}}">
                            @error("address")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="ward" class="col-sm-2 col-form-label">Ward</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ward" id="ward" value="{{old('ward', $address->ward ?? '')}}">
                            @error("ward")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="district" class="col-sm-2 col-form-label">District</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="district" id="district" value="{{old('district', $address->district ?? '')}}">
                            @error("district")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city" value="{{old('city', $address->city ?? '')}}">
                            @error("city")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="full_name" class="col-sm-2 col-form-label">Name For Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{old('full_name', $address->full_name ?? '')}}">
                            @error("full_name")
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