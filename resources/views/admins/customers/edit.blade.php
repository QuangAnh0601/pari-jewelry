@extends('layouts.sb-admin')

@section('content')
    <style>
        .card-header {
            padding: 0
        }
    </style>
    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header pt-3 pl-3 pr-3 d-flex">
                <a class="editCustomer" href="#editCustomer"><h6 class="m-0 font-weight-bold text-white rounded-top bg-primary p-2" role="button">Edit Customer</h6></a>
                <a class="customerAddress" href="#customerAddress"><h6 class="m-0 font-weight-bold p-2" role="button">Customer Address</h6><a>
            </div>
            <div class="card-body" id="editCustomer">
                <div class="mb-3"><span class="badge badge-info">Customer Information</span></div>
                <form action="/admin/customer/update" method="POST">
                    @csrf
                    @if (isset($customer))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$customer->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $customer->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="age" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="age" id="age" value="{{old('age', $customer->age ?? '')}}">
                            @error("age")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{old('phone_number', $customer->phone_number ?? '')}}">
                            @error("phone_number")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{old('email', $customer->email ?? '')}}">
                            @error("email")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <hr>
                    <div class="mb-3"><span class="badge badge-info">Address Information</span></div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">
                            @error("address")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="ward" class="col-sm-2 col-form-label">Ward</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ward" id="ward" value="{{old('ward')}}">
                            @error("ward")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="district" class="col-sm-2 col-form-label">District</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="district" id="district" value="{{old('district')}}">
                            @error("district")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city" value="{{old('city')}}">
                            @error("city")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="full_name" class="col-sm-2 col-form-label">Name For Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{old('full_name', $customer->name ?? '')}}">
                            @error("full_name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right my-3">Submit</button>
                </form>
            </div>
            <div class="card-body d-none" id="customerAddress">
                @if (isset($customer))
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Default</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Default</th>
                                    <th>Tools</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ( $customer->addresses->count() > 0 )
                                    @foreach ($customer->addresses as $address)
                                        <tr>
                                            <td>{{ $address->full_name }}</td>
                                            <td>{{ $address->phone_number }}</td>
                                            <td>{{ $address->address }}, {{ $address->ward }}, {{ $address->district }},{{ $address->city }}</td>
                                            <td>{{ $address->is_default ? 'yes' : 'no' }}</td>
                                            <td>
                                                <a href="/admin/customer-address/edit/{{$customer->id}}/{{$address->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                                
                                                <a class="badge badge-danger" href="javascript:void(0)"
                                                    onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                    document.getElementById('destroy-form[{{$customer->id}}]').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <form id="destroy-form[{{$customer->id}}]" action="/admin/customer-address/delete/{{$customer->id}}" method="POST" class="d-none">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>Chưa có địa chỉ nào !</h1>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <h2>Chưa có địa chỉ nào !</h2>
                @endif
            </div> 
        </div>
    </div>

    <script>
        var hash = 'editCustomer';
        var customerFlag = true;
        var addressFlag = false;
        $(document).ready(function () {
            $('.editCustomer').click(function (e) {
                hash = window.location.hash.substr(1)
                if(!customerFlag) {
                    $(this).children().toggleClass('rounded-top bg-primary')
                    $(this).children().addClass('text-white')
                    $(this).children().removeClass('text-primary')
                    $('#editCustomer').toggleClass('d-none')
                    $('#customerAddress').toggleClass('d-none')
                    $('.customerAddress').children().toggleClass('rounded-top bg-primary')
                    $('.customerAddress').children().addClass('text-primary')
                    $('.customerAddress').children().removeClass('text-white')
                    customerFlag = true;
                    addressFlag = false;
                }
            });
            $('.customerAddress').click(function (e) {
                hash = window.location.hash.substr(1)
                if(!addressFlag)
                {
                    $(this).children().toggleClass('rounded-top bg-primary')
                    $(this).children().addClass('text-white')
                    $(this).children().removeClass('text-primary')
                    $('#customerAddress').toggleClass('d-none')
                    $('#editCustomer').toggleClass('d-none')
                    $('.editCustomer').children().toggleClass('rounded-top bg-primary')
                    $('.editCustomer').children().toggleClass('text-primary')
                    customerFlag = false;
                    addressFlag = true;
                }
            });
            hash = window.location.hash.substr(1)
            $('.'+hash).click();
        });
    </script>
@endsection