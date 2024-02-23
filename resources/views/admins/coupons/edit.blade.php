@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Coupon</h6>
            </div>
            <div class="card-body">
                <form action="/admin/coupon/update" method="POST">
                    @csrf
                    @if (isset($coupon))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$coupon->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $coupon->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type" id="type" aria-label="Default select example">
                                <option value="buy" @if (old('type', $coupon->type ?? '') == 'buy') selected @endif>Buy</option>
                                <option value="free" @if (old('type', $coupon->type ?? '') == 'free') selected @endif>Free</option>
                            </select>
                            @error("type")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="quantity" id="quantity" value="{{old('quantity', $coupon->quantity ?? '')}}">
                            @error("quantity")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="out_of_date" class="col-sm-2 col-form-label">Out Of Date</label>
                        <div class="col-sm-10">
                          <input type="dateTimeLocal" class="form-control" name="out_of_date" id="out_of_date" value="{{old('out_of_date', $coupon->out_of_date ?? '')}}">
                          @error("out_of_date")
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="discount_percent" class="col-sm-2 col-form-label">Discount Percent</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="discount_percent" id="discount_percent" value="{{old('discount_percent', $coupon->discount_percent ?? '')}}">
                            @error("discount_percent")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option value="Active" @if (old('status', $coupon->status ?? '') == 'Active') selected @endif>Active</option>
                                <option value="Not Active" @if (old('status', $coupon->status ?? '') == 'Not Active') selected @endif>Not Active</option>
                            </select>
                            @error("status")
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