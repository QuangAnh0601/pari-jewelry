@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Stock</h6>
            </div>
            <div class="card-body">
                <form action="/admin/stock/update" method="POST">
                    @csrf
                    @if (isset($stock))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$stock->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $stock->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address', $stock->address ?? '')}}">
                            @error("address")
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