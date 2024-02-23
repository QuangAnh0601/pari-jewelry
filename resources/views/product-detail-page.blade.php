@extends('customers.layouts.layout')

@section('content')
    <style>
        .fa-star{
            font-size: 20px;
        }
        .loading-review {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        .loading-review button {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: #C97F5F;
            border: none;
            background: transparent;
            font-size: 1rem;
            line-height: 1.5rem;
            padding: 1rem 2rem;
        }

        .loading-review button > svg {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .loading-review button > svg > rect {
            fill: none;
            stroke: #C97F5F;
            stroke-width: 2px;
            stroke-dasharray: 240 160 240 160;
            stroke-dashoffset: 0;
            animation: pathRect 2s linear infinite;
            width: calc(100% - 2px);
            height: calc(100% - 2px);
        }

        @keyframes pathRect {
            25% {
                stroke-dashoffset: 100;
            }

            50% {
                stroke-dashoffset: 200;
            }

            75% {
                stroke-dashoffset: 300;
            }

            100% {
                stroke-dashoffset: 400;
            }
        }
    </style>
    <x-title></x-title>
    <!-- Start product details section -->
    <section class="product__details--section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details--media">
                        <div class="single__product--preview bg__gray  swiper mb-18">
                            <div class="swiper-wrapper">
                                @for ($i = 0; $i < 5; $i++)
                                    @isset($product->productImages[$i])
                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="{{ asset('/product//'.$product->productImages[$i]->file_name) }}"><img class="product__media--preview__items--img" src="{{ asset('/product//'.$product->productImages[$i]->file_name) }}" alt="product-media-img"></a>
                                                <div class="product__media--view__icon">
                                                    <a class="product__media--view__icon--link glightbox" href="{{ asset('/product//'.$product->productImages[$i]->file_name) }}" data-gallery="product-media-preview">
                                                        <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                                                        <span class="visually-hidden">product view</span> 
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    @else
                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="{{ asset('/product/no-image.png') }}"><img class="product__media--preview__items--img" src="{{ asset('/product/no-image.png') }}" alt="product-media-img"></a>
                                                <div class="product__media--view__icon">
                                                    <a class="product__media--view__icon--link glightbox" href="{{ asset('/product/no-image.png') }}" data-gallery="product-media-preview">
                                                        <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                                                        <span class="visually-hidden">product view</span> 
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    @endisset
                                @endfor
                            </div>
                        </div>
                        <div class="single__product--nav swiper">
                            <div class="swiper-wrapper">
                                @for ($i = 0; $i < 5; $i++)
                                    @isset($product->productImages[$i])
                                        <div class="swiper-slide">
                                            <div class="product__media--nav__items">
                                                <img class="product__media--nav__items--img" src="{{ asset('/product//'. $product->productImages[$i]->file_name) }}" alt="product-nav-img">
                                            </div>
                                        </div>
                                    @else
                                        <div class="swiper-slide">
                                            <div class="product__media--nav__items">
                                                <img class="product__media--nav__items--img" src="{{ asset('/product/no-image.png') }}" alt="product-nav-img">
                                            </div>
                                        </div>
                                    @endisset
                                @endfor
                            </div>
                            <div class="swiper__nav--btn swiper-button-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                            <div class="swiper__nav--btn swiper-button-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                            </div>
                        </div>
                    </div>  
                </div> 
                <div class="col-lg-6 col-md-6">
                    <div class="product__details--info">
                        <form action="#">
                            <h2 class="product__details--info__title mb-15">{{ $product->name }} </h2>
                            <div class="product__details--info__price mb-12">
                                <span class="current__price">{{ number_format($product->price, 0, '.', ',') }} VND</span>
                                {{-- <span class="old__price">$68.00</span> --}}
                            </div>
                            <ul class="rating product__card--rating mb-15 d-flex">
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon"> 
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"/>
                                            </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon"> 
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"/>
                                            </svg>
                                    </span>
                                </li>
                                <li>
                                    <span class="rating__review--text">(126) Review</span>
                                </li>
                            </ul>
                            <p class="product__details--info__desc mb-15">{{ $product->description }}</p>
                            <div class="product__variant">
                                <div class="product__variant--list mb-15">
                                    <fieldset class="variant__input--fieldset">
                                        <legend class="product__variant--title mb-8">Material : {{ $product->material }}</legend>
                                        {{-- <div class="variant__color d-flex">
                                            <div class="variant__color--list">
                                                <input id="color-red5" name="color" type="radio" checked>
                                                <label class="variant__color--value red" for="color-red5" title="Red"><img class="variant__color--value__img" src="{{ asset('/img/product/small-product/product1.webp') }}" alt="variant-color-img"></label>
                                            </div>
                                            <div class="variant__color--list">
                                                <input id="color-red6" name="color" type="radio">
                                                <label class="variant__color--value red" for="color-red6" title="Black"><img class="variant__color--value__img" src="{{ asset('/img/product/small-product/product2.webp') }}" alt="variant-color-img"></label>
                                            </div>
                                            <div class="variant__color--list">
                                                <input id="color-red7" name="color" type="radio">
                                                <label class="variant__color--value red" for="color-red7" title="Pink"><img class="variant__color--value__img" src="{{ asset('/img/product/small-product/product3.webp') }}" alt="variant-color-img"></label>
                                            </div>
                                            <div class="variant__color--list">
                                                <input id="color-red8" name="color" type="radio">
                                                <label class="variant__color--value red" for="color-red8" title="Orange"><img class="variant__color--value__img" src="{{ asset('/img/product/small-product/product4.webp') }}" alt="variant-color-img"></label>
                                            </div>
                                        </div> --}}
                                    </fieldset>
                                </div>
                                <div class="product__variant--list mb-20">
                                    <fieldset class="variant__input--fieldset">
                                        <legend class="product__variant--title mb-8">Weight : {{ $product->weight }}</legend>
                                        {{-- <ul class="variant__size d-flex">
                                            <li class="variant__size--list">
                                                <input id="weight4" name="weight" type="radio" checked>
                                                <label class="variant__size--value red" for="weight4">5 kg</label>
                                            </li>
                                            <li class="variant__size--list">
                                                <input id="weight5" name="weight" type="radio">
                                                <label class="variant__size--value red" for="weight5">3 kg</label>
                                            </li>
                                            <li class="variant__size--list">
                                                <input id="weight6" name="weight" type="radio">
                                                <label class="variant__size--value red" for="weight6">2 kg</label>
                                            </li>
                                        </ul> --}}
                                    </fieldset>
                                </div>
                                <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                    <div class="quantity__box">
                                        <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                        <label>
                                            <input type="number" class="quantity__number quickview__value--number" value="1" data-counter />
                                        </label>
                                        <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                                    </div>
                                    <button class="primary__btn quickview__cart--btn product_detail-add_to_cart" data-product-id="{{ $product->id }}" type="button">Add To Cart</button>  
                                </div>
                                <div class="product__variant--list mb-20">
                                    <a class="variant__wishlist--icon mb-15" href="javascript:void(0)" title="Add to wishlist"
                                        onclick="event.preventDefault();
                                        document.getElementById('wishlist-form[{{$product->id}}]').submit();">
                                        <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="@if (auth()->guard('customer')->check() && auth('customer')->user()->checkWishList(11) !== null)
                                            #C97F5F
                                        @else
                                            none
                                        @endif" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                                        Add to Wishlist
                                    </a>                                                                
                                    <form id="wishlist-form[{{$product->id}}]" action="/customer/wish-list/addToWishList/{{$product->id}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <button class="variant__buy--now__btn primary__btn" type="submit">Buy it now</button>
                                </div>
                            </div>
                            <div class="quickview__social d-flex align-items-center mb-20">
                                <label class="quickview__social--title">Social Share:</label>
                                <ul class="quickview__social--wrapper mt-0 d-flex">
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.facebook.com">
                                            <svg  xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524" viewBox="0 0 7.667 16.524">
                                                <path  data-name="Path 237" d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z" transform="translate(-960.13 -345.407)" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">Facebook</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://twitter.com">
                                            <svg  xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384" viewBox="0 0 16.489 13.384">
                                                <path  data-name="Path 303" d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z" transform="translate(-951.23 -1140.849)" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">Twitter</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.instagram.com">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492" viewBox="0 0 19.497 19.492">
                                                <path  data-name="Icon awesome-instagram" d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z" transform="translate(0.004 -1.492)" fill="currentColor"></path>
                                            </svg>
                                            <span class="visually-hidden">Instagram</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank" href="https://www.youtube.com">
                                            <svg  xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                                <path  data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">Youtube</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="guarantee__safe--checkout mb-30">
                                <h5 class="guarantee__safe--checkout__title">Guaranteed Safe Checkout</h5>
                                <img class="guarantee__safe--checkout__img" src="{{ asset('/img/other/guaranteed.png') }}" alt="Payment Image">
                            </div>
                            <div class="product__details--accordion">
                                <div class="product__details--accordion__list">
                                    <details>
                                        <summary class="product__details--summary">
                                            <h2 class="product__details--summary__title">Product Reviews
                                                <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
                                            </h2>
                                        </summary>
                                        <div class="product__details--summary__wrapper" id="customer_review_area">
                                            <div class="product__reviews">
                                                <div class="product__reviews--header">
                                                    <h2 class="product__reviews--header__title h3 mb-20">Customer Reviews</h2>
                                                    <div class="reviews__ratting d-flex align-items-center">
                                                        @if (!is_null($product->getRating()))
                                                            <ul class="rating d-flex">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= round($product->getRating()->avg_rating, 0))
                                                                        <li class="rating__list">
                                                                            <span class="rating__icon">
                                                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                                                                </svg>
                                                                            </span>
                                                                        </li>
                                                                    @else
                                                                        <li class="rating__list">
                                                                            <span class="rating__icon"> 
                                                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"/>
                                                                                    </svg>
                                                                            </span>
                                                                        </li>
                                                                    @endif
                                                                @endfor
                                                            </ul>
                                                            
                                                        @endif
                                                        <span class="reviews__summary--caption">Based on {{ $product->reviews->count() }} reviews</span>
                                                    </div>
                                                    <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A Review</a>
                                                </div>
                                                <div class="reviews__comment--area">
                                                    @foreach ($product->reviews()->orderBy('reviews.created_at', 'desc')->take(5)->get() as $review)
                                                        <div class="reviews__comment--list d-flex">
                                                            <div class="reviews__comment--thumb">
                                                                <img src="{{ asset('/admin/img/user-images/no-image.png') }}" alt="comment-thumb">
                                                            </div>
                                                            <div class="reviews__comment--content">
                                                                <div class="reviews__comment--top d-flex justify-content-between">
                                                                    <div class="reviews__comment--top__left">
                                                                        <h3 class="reviews__comment--content__title h4">{{ $review->name }}</h3>
                                                                        <ul class="rating d-flex">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($i <= $review->rating)
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__icon">
                                                                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                @else
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__icon"> 
                                                                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"/>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                @endif
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                    <span class="reviews__comment--content__date">{{ date('d M Y', strtotime($review->created_at)) }}</span>
                                                                </div>
                                                                <p class="reviews__comment--content__desc">{{ $review->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div id="writereview" style="position: relative" class="reviews__comment--reply__area">
                                                    <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>
                                                    <div class="reviews__ratting mb-20">
                                                        <ul class="rating d-flex stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <li class="rating__list star{{ $i }}">
                                                                    <span class="rating__icon"><i class="fas fa-star"></i></span>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                        <input type="hidden" name="rating" id="review_rating" value="5">
                                                    </div>
                                                    <input type="hidden" name="product_id" id="review_rating_product" value="{{$product->id}}">
                                                    <div class="row">
                                                        <div class="loading-review" style="display:none">
                                                            <button>Loading ...
                                                                <svg>
                                                                    <rect x="1" y="1"></rect>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mb-10">
                                                            <textarea class="reviews__comment--reply__textarea" name="content" id="review_content" placeholder="Your Comments...." ></textarea>
                                                        </div> 
                                                        <div class="col-lg-6 col-md-6 mb-15">
                                                            <label>
                                                                <input class="reviews__comment--reply__input" name="name" id="review_name" placeholder="Your Name...." type="text">
                                                            </label>
                                                        </div>  
                                                        <div class="col-lg-6 col-md-6 mb-15">
                                                            <label>
                                                                <input class="reviews__comment--reply__input" name="email" id="review_email" placeholder="Your Email...." type="email">
                                                            </label>
                                                        </div>  
                                                    </div>
                                                    <button class="primary__btn text-white" id="sendReview" data-hover="Submit" type="button">SUBMIT</button> 
                                                </div>
                                            </div> 
                                        </div>
                                    </details>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- End product details section -->
    <x-recommendProduct></x-recommendProduct>
    <x-service></x-service>

    <script>
        $('.product_detail-add_to_cart').click(function (e) { 
                e.preventDefault();
            var id = $(this).attr('data-product-id');
            var quantity = $(this).prev().children().children().val()
            console.log('quantity',quantity);
            if(quantity == undefined)
            {
                quantity = 1
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/cart/addToCart",
                data: {
                    productId: id,
                    quantity: quantity 
                },
                success: function (response) {
                    console.log(response.cartQuantity);
                    $(".minicart__open--btn").addClass('shake-the-cart');
                    console.log(response.product_id);
                    if($('.minicart__product').children('.product-'+response.product_id).length === 0)
                    {
                        $('.minicart__product').append(getHtml(response.product_id, response.cart_detail.image, response.cart_detail.product_name, response.cart_detail.material, response.cart_detail.total_price, response.cart_detail.quantity))
                        $(".header__account--btn.minicart__open--btn").children('.items__count').text(response.cartQuantity)
                    }
                    else
                    {
                        $('.minicart__product').children('.product-'+response.product_id).replaceWith(getHtml(response.product_id, response.cart_detail.image, response.cart_detail.product_name, response.cart_detail.material, response.cart_detail.total_price, response.cart_detail.quantity))
                    }
                },
                error: function (err) {
                    alert(err.responseJSON);
                },
            });
            function getHtml (key, image, productName, material, totalPrice, quantity)
            {
                var html = `<div class="minicart__product--items product-`+key+` d-flex">
                    <div class="minicart__thumb">
                        <a href="/product-detail/show/`+key+`"><img src="{{ asset("/product/`+image+`") }}" alt="prduct-img"></a>
                    </div>
                    <div class="minicart__text">
                        <h4 class="minicart__subtitle"><a href="product-details.html">`+productName+`</a></h4>
                        <span class="color__variant"><b>material:</b>`+material+`</span>
                        <div class="minicart__price">
                            <span class="minicart__current--price">`+totalPrice+` VND</span>
                        </div>
                        <div class="minicart__text--footer d-flex align-items-center">
                            <div class="quantity__box minicart__quantity">
                                <button type="button" class="quantity__value decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                <label>
                                    <input type="number" data-product-id="`+key+`" class="quantity__number" value="`+quantity+`" data-counter />
                                </label>
                                <button type="button" class="quantity__value increase" aria-label="quantity value" value="Increase Value">+</button>
                            </div>
                            <button class="minicart__product--remove" data-product-id="`+key+`" type="button">Remove</button>
                        </div>
                    </div>
                </div>`;
                return html;
            }
        });

        $(".star1").click(function () { 
            $('.fa-star').attr('class', 'far fa-star')
            $('.star1').children().children().attr('class', 'fas fa-star')
            $('#review_rating').val(1)
        });
        
        $(".star2").click(function () { 
            $('.fa-star').attr('class', 'far fa-star')
            $('.star1, .star2').children().children().attr('class', 'fas fa-star')
            $('#review_rating').val(2)
        });
        
        $(".star3").click(function () { 
            $('.fa-star').attr('class', 'far fa-star')
            $('.star1, .star2, .star3').children().children().attr('class', 'fas fa-star')
            $('#review_rating').val(3)
        });
        
        $(".star4").click(function () { 
            $('.fa-star').attr('class', 'far fa-star')
            $('.star1, .star2, .star3, .star4').children().children().attr('class', 'fas fa-star')
            $('#review_rating').val(4)
        });
        
        $(".star5").click(function () { 
            $('.fa-star').attr('class', 'far fa-star')
            $('.star1, .star2, .star3, .star4, .star5').children().children().attr('class', 'fas fa-star')
            $('#review_rating').val(5)
        });
        $('#sendReview').click(function (e) { 
            e.preventDefault();
            var rating = $('#review_rating').val();
            var content = $('#review_content').val();
            console.log('content', content);
            var name = $('#review_name').val();
            var email = $('#review_email').val();
            var product_id = $('#review_rating_product').val()
            var formData = new FormData();
            formData.append('rating', rating);
            formData.append('content', content);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('product_id', product_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/review/create',
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if(response.data.content == null)
                    {
                        response.data.content = ''
                    }
                    $('.reviews__comment--area').prepend(reviewHtml(response.data.name, response.data.rating, response.data.created_at, response.data.content));
                },
                error: function (err) {
                    console.log(err)
                },
            });
            function reviewHtml (reviewName, reviewRating, reviewTime, reviewContent)
            {
                var ratingHtml= ''
                for (let i = 1; i <= 5; i++){
                    if (i <= Number(reviewRating))
                    {
                    ratingHtml+=`<li class="rating__list">
                            <span class="rating__icon">
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </li>`;
                    }
                    else{
                        ratingHtml+=`<li class="rating__list">
                                <span class="rating__icon"> 
                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </li>`;
                    }
                }
                var html = `<div class="reviews__comment--list d-flex">
                                <div class="reviews__comment--thumb">
                                    <img src="{{ asset('/admin/img/user-images/no-image.png') }}" alt="comment-thumb">
                                </div>
                                <div class="reviews__comment--content">
                                    <div class="reviews__comment--top d-flex justify-content-between">
                                        <div class="reviews__comment--top__left">
                                            <h3 class="reviews__comment--content__title h4">`+reviewName+`</h3>
                                            <ul class="rating d-flex">`+ratingHtml+
                                            `</ul>
                                        </div>
                                        <span class="reviews__comment--content__date">{{ date('d M Y', strtotime(`+reviewTime+`)) }}</span>
                                    </div>
                                    <p class="reviews__comment--content__desc">`+reviewContent+`</p>
                                </div>
                            </div>`;
                return html
            }
        });
        $(document).ajaxStart(function() {
            $(".loading-review").show();
        });
        $(document).ajaxStop(function() {
            $(".loading-review").hide();

            var position = $('details').offset().top;

            $("body, html").animate({
                scrollTop: position
            } /* speed */ );
        });
    </script>
@endsection