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
                <div class="account__wrapper">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Orders History</h2>
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Order</th>
                                        <th class="account__table--header__child--items">Date</th>
                                        <th class="account__table--header__child--items">Fulfillment Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                        <th class="account__table--header__child--items">Create by</th>	 	
                                        <th class="account__table--header__child--items">Detail</th> 	 	
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    @foreach ($customer->orders as $order)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#{{ $order->id }}</td>
                                            <td class="account__table--body__child--items">{{ $order->created_at }}</td>
                                            <td class="account__table--body__child--items">{{ $order->status }}</td>
                                            <td class="account__table--body__child--items">{{ number_format($order->total_price, 0, '.', ',') }} VND</td>
                                            <td class="account__table--body__child--items"><small class="badge bg-info">@if ($order->create_by_type === 'App\Models\User')
                                                sale agent
                                            @else
                                                you
                                            @endif</small><p>{{ $order->createBy->name }}</p></td>
                                            <td class="account__table--body__child--items"><a href="/customer/order-history/showOrderDetail/{{$order->id}}" class="badge badge-success"><span><i style="font-size:30px; color:lightblue" class="fas fa-info-circle"></i></span></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    @foreach ($customer->orders as $order)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#{{ $order->id }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>{{ $order->created_at }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>{{ $order->status }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>{{ $order->total_price }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Create by</strong>
                                                <span>{{ $order->user }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Detail</strong>
                                                <span><a href="/customer/order-history/showOrderDetail/{{$order->id}}" class="badge badge-success"><span><i style="font-size:30px; color:lightblue" class="fas fa-info-circle"></i></span></a></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>     
@endsection