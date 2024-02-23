@extends('customers.layouts.layout')

@section('content')
    <x-slider></x-slider>
    <x-dynamic-component :component="'category'" />
    <x-dynamic-component :component="'banner1'" />
    <x-dynamic-component :component="'trending-product'" />
    <x-dynamic-component :component="'banner2'" />
    <x-dynamic-component :component="'product-by-type'" />
    <x-banner3></x-banner3>
    <x-blog></x-blog>
    <x-dynamic-component :component="'testimonial'" />
    <x-news-letter></x-news-letter>
    <x-quick-view-product></x-quick-view-product>
@endsection