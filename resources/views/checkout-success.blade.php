@extends('customers.layouts.layout')

@section('content')
    <x-title></x-title>
    <div class="checkout__page--area section--padding">
        <div class="container border p-5 rounded-3 shadow text-center">
            <h2 class="m-3" style="color:#C97F5F">Congratulations on your successful purchase</h2>
            <a class="continue__shipping--btn primary__btn border-radius-5 m-3" href="/home">Continue Shopping</a>
        </div>
    </div>
    <x-service></x-service>
@endsection