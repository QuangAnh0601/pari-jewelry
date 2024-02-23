@extends('customers.layouts.layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <x-title></x-title>
    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <p class="account__welcome--text">Hello, Admin welcome to your dashboard!</p>
            <div class="my__account--section__inner border-radius-10 d-flex">
                <x-customers.sidebar :customer="$customer"></x-customers.sidebar>
                <div class="account__wrapper position-relative">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Orders History</h2>
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('status_error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('status_error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Order Detail</th>
                                        <th class="account__table--header__child--items">Product</th>
                                        <th class="account__table--header__child--items">Image</th>
                                        <th class="account__table--header__child--items">Quantity</th>
                                        <th class="account__table--header__child--items">Price</th>
                                        <th class="account__table--header__child--items">Tools</th> 	 	
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    @foreach ($orderDetails as $orderDetail)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#{{ $orderDetail->id }}</td>
                                            <td class="account__table--body__child--items">{{ $orderDetail->product->name }}</td>
                                            @php
                                                $productImage = $orderDetail->product->productImages->first() ? $orderDetail->product->productImages->first()->file_name : 'no-image.png';
                                            @endphp
                                            <td class="account__table--body__child--items"><img src="{{ asset("product/$productImage") }}" width="100" alt=""></td>
                                            <td class="account__table--body__child--items">{{ $orderDetail->quantity }}</td>
                                            <td class="account__table--body__child--items">{{ number_format($orderDetail->price, 0, '.', ',') }} VND</td>
                                            <td class="account__table--body__child--items">
                                                <a href="/customer/order-history/order/{{$orderDetail->order_id}}/order-detail/{{$orderDetail->id}}">
                                                    <span class="badge bg-success"><i class="fas fa-edit"></i></span>
                                                </a>
                                                <a class="badge bg-danger" href="javascript:void(0)"
                                                    onclick="if(confirm('Are you sure to delete this item ?'))
                                                                    document.getElementById('destroy-form[{{$orderDetail->id}}]').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <form id="destroy-form[{{$orderDetail->id}}]" action="/customer/order-history/order/{{$orderDetail->order_id}}/deleteOrderDetail/{{$orderDetail->id}}" method="POST" class="d-none">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    @foreach ($orderDetails as $orderDetail)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order Detail</strong>
                                                <span>#{{ $orderDetail->id }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Product</strong>
                                                <span>{{ $orderDetail->product->name }}</span>
                                            </td>
                                            @php
                                                $productImageMobile = $orderDetail->product->productImages->first() ? $orderDetail->product->productImages->first()->file_name : 'no-image.png';
                                            @endphp
                                            <td class="account__table--body__child--items">
                                                <strong>Image</strong>
                                                <span><img src="{{ asset("product/$productImageMobile") }}" width="100" alt=""></span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Quantity</strong>
                                                <span>{{ $orderDetail->quantity }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Price</strong>
                                                <span>{{ number_format($orderDetail->price, 0, '.', ',') }} VND</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Tools</strong>
                                                <span>
                                                    <a href="/customer/order-history/order/{{$orderDetail->order_id}}/order-detail/{{$orderDetail->id}}">
                                                        <span class="badge bg-success"><i class="fas fa-edit"></i></span>
                                                    </a>
                                                    <a class="badge bg-danger" href="javascript:void(0)"
                                                        onclick="if(confirm('Are you sure to delete this item ?'))
                                                                        document.getElementById('destroy-form[{{$orderDetail->id}}]').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
    
                                                    <form id="destroy-form[{{$orderDetail->id}}]" action="/customer/order-history/order/{{$orderDetail->order_id}}/deleteOrderDetail/{{$orderDetail->id}}" method="POST" class="d-none">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div><a href="/customer/order-history" style="font-size: 18px; color: #C97F5F; text-decoration:none;" class="position-absolute bottom-0 end-0"><i class="fas fa-arrow-left"></i> Back to Order list</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>     
@endsection