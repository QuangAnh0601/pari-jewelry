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
                <div class="account__wrapper position-relative">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Edit Order Detail</h2>
                        <div class="account__table--area">
                            <form method="POST" action="/customer/order-history/updateOrderDetail">
                                @csrf
                                @if (isset($orderDetail))
                                    @method('PUT')
                                    <input type="hidden" name="orderId" value="{{$orderDetail->order_id}}">
                                    <input type="hidden" name="orderDetailId" value="{{$orderDetail->id}}">
                                @endif

                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10">
                                        <h3>{{$orderDetail->product->name}}</h3>
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">Product Image</label>
                                    <div class="col-sm-10">
                                        @foreach ($orderDetail->product->productImages as $item)
                                            <span><img src="{{asset('product/'. $item->file_name)}}" width="100" alt=""></span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" data-unit-price="{{$orderDetail->product->price}}" name="quantity" id="quantity" value="{{old('quantity', $orderDetail->quantity ?? '')}}">
                                        @error("quantity")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="displayPrice" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="displayPrice" value="{{number_format(old('price', $orderDetail->price ?? ''), 0, '.', '')}}" disabled>
                                        @error("price")
                                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="price" id="price" value="{{number_format(old('price', $orderDetail->price ?? ''), 0, '.', '')}}">

                                <div class=" d-flex justify-content-end"><button style="font-size: 16px" type="submit" class="btn btn-primary">Update</button></div>
                            </form>
                        </div>
                    </div>
                    <div><a href="/customer/order-history/showOrderDetail/{{$orderDetail->order_id}}" style="font-size: 18px; color: #C97F5F; text-decoration:none;" class="position-absolute bottom-0 end-0"><i class="fas fa-arrow-left"></i> Back to Order Detail list</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>
    
    <script>
        $('#quantity').change(function () { 
            var quantity = $(this).val();
            var unitPrice = $(this).attr('data-unit-price');
            price = Number(quantity * unitPrice);
            $('#price').val(price);
            $('#displayPrice').val(price);
        });
    </script>
@endsection