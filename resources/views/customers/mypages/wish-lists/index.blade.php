@extends('customers.layouts.layout')

@section('content')
    <x-title></x-title>
    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <div class="my__account--section__inner border-radius-10 d-flex">
                <x-customers.sidebar :customer="$customer"></x-customers.sidebar>
                <div class="account__wrapper">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Addresses</h2>
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list text-center">STOCK STATUS</th>
                                        <th class="cart__table--header__list text-right">ADD TO CART</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    @foreach ($customer->products as $product)
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <button class="cart__remove--btn" aria-label="search button" type="button"
                                                    onclick="if(confirm('Are you sure to delete this item ?'))
                                                                    document.getElementById('delete-form[{{$product->id}}]').submit();">
                                                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                    </button>
                                                    <form id="delete-form[{{$product->id}}]" action="/customer/wish-list/delete/{{$product->id}}" method="POST" class="d-none">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                    <div class="cart__thumbnail">
                                                        @php
                                                            $productImage = $product->productImages->first() ? $product->productImages->first()->file_name : 'no-image.png';
                                                        @endphp
                                                        <a href="/product-detail/show/{{$product->id}}"><img class="border-radius-5" src="{{ asset("/product/$productImage") }}" alt="cart-product"></a>
                                                    </div>
                                                    <div class="cart__content">
                                                        <h3 class="cart__content--title h4"><a href="/product-detail/show/{{$product->id}}">{{$product->name}}</a></h3>
                                                        <span class="cart__content--variant">MATERIAL: {{$product->material}}</span>
                                                        <span class="cart__content--variant">WEIGHT: {{$product->weight}} g</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price">{{number_format($product->price, 0, '.', ',')}}</span>
                                            </td>
                                            <td class="cart__table--body__list text-center">
                                                <span class="in__stock text__secondary">{{$product->status}}</span>
                                            </td>
                                            <td class="cart__table--body__list text-right">
                                                <a class="wishlist__cart--btn primary__btn" data-product-id="{{$product->id}}" href="javascript:void(0)">Add To Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($customer->products->count() < 1)
                                <h2 style="color:#C97F5F">You haven't liked any products in the store yet</h2>
                            @endif 
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="/">Continue shopping</a>
                                <a class="continue__shopping--clear" href="/shop">View All Products</a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-recommend-product></x-recommend-product>
    <x-service></x-service>
@endsection