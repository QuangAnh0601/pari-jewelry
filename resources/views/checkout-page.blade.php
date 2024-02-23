@extends('customers.layouts.layout')

@section('content')
    <x-title></x-title>
    <!-- Start checkout page area -->
    <div class="checkout__page--area section--padding">
        <div class="container">
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            <form action="/checkout/processCheckout">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="main checkout__mian">
                            <div class="checkout__content--step section__contact--information">
                                <div class="checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                    <h2 class="checkout__header--title h3">Contact information</h2>
                                    @if (!auth('customer')->check())
                                        <p class="layout__flex--item">
                                            Already have an account?
                                            <a class="layout__flex--item__link" href="/customer/login">Log in</a>  
                                        </p>
                                    @endif
                                </div>
                                <div class="customer__information">
                                    <div class="checkout__email--phone mb-12">
                                        <label>
                                            <label class="checkout__input--label mb-10" for="full_name">Email <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" name="email" value="{{ old('email', $customer->email ?? '') }}" placeholder="Email"  type="text">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="checkout__email--phone mb-12">
                                        <label>
                                            <label class="checkout__input--label mb-10" for="full_name">Phone Number <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" name="phone_number" value="{{ old('phone_number', $customer->phone_number ?? '') }}" placeholder="Phone Number"  type="text">
                                            @error('phone_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                    </div>
                                    {{-- <div class="checkout__checkbox">
                                        <input class="checkout__checkbox--input" id="get_new_notifications" name="get_new_notifications" type="checkbox" {{ old('get_new_notifications') ? 'checked' : '' }}>
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label" for="get_new_notifications">
                                            Email me with news and offers</label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="checkout__content--step section__shipping--address">
                                <div class="checkout__section--header mb-25">
                                    <h2 class="checkout__header--title h3">Billing Details</h2>
                                </div>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        {{-- <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list ">
                                                <label class="checkout__input--label mb-10" for="first_name">Fist Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" name="first_name" value="{{ old('first_name', ) }}" placeholder="First name" id="first_name"  type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="last_name">Last Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" name="last_name" value="{{ old('last_name') }}" placeholder="Last name" id="last_name"  type="text">
                                            </div>
                                        </div> --}}
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="full_name">Full Name <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" name="full_name" value="{{ old('full_name', isset($customer) ? $customer->fullName() : "") }}" placeholder="Full Name" id="full_name" type="text">
                                                @error('full_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="company">Company Name</label>
                                                <input class="checkout__input--field border-radius-5" name="company" value="{{ old('company') }}" placeholder="Company (optional)" id="company" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="shipping_address">Address <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" name="shipping_address" value="{{ old('shipping_address', $customer->address ?? "") }}" placeholder="No., Ward, District" id="address" type="text">
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="country">Country/region <span class="checkout__input--label__star">*</span></label>
                                                <div class="checkout__input--select select">
                                                    <select class="checkout__input--select__field border-radius-5" name="country" id="country">
                                                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Viet Nam</option>
                                                        <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                                        <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                                        <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                                        <option value="Islands" {{ old('country') == 'Islands' ? 'selected' : '' }}>Islands</option>
                                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                                    </select>
                                                </div>
                                                @error('country')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label mb-10" for="postal_code">Postal Code <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal code" id="postal_code" type="text">
                                                @error('postal_code')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <details>
                                    <summary class="checkout__checkbox mb-20">
                                        <input class="checkout__checkbox--input" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <span class="checkout__checkbox--label">Ship to a different address?</span>
                                    </summary>
                                    <div class="section__shipping--address__content">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list ">
                                                    <label class="checkout__input--label mb-10" for="input7">Fist Name <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="First name (optional)" id="input7"  type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input8">Last Name <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Last name" id="input8"  type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input9">Company Name <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="input9" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input10">Address <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Address1" id="input10" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <input class="checkout__input--field border-radius-5" placeholder="Apartment, suite, etc. (optional)"  type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input11">Town/City <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="City" id="input11" type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="country2">Country/region <span class="checkout__input--label__star">*</span></label>
                                                    <div class="checkout__input--select select">
                                                        <select class="checkout__input--select__field border-radius-5" id="country2">
                                                            <option value="1">India</option>
                                                            <option value="2">United States</option>
                                                            <option value="3">Netherlands</option>
                                                            <option value="4">Afghanistan</option>
                                                            <option value="5">Islands</option>
                                                            <option value="6">Albania</option>
                                                            <option value="7">Antigua Barbuda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input12">Postal Code <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Postal code" id="input12" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </details> --}}
                                {{-- @auth('customer')
                                    <div class="checkout__checkbox">
                                        <input class="checkout__checkbox--input" name="save_information" id="save_information" type="checkbox" {{ old('save_information') ? 'checked' : '' }}>
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label" for="save_information">
                                            Save this information for next time</label>
                                    </div>
                                @endauth --}}
                            </div>
                            <div class="order-notes mb-20">
                                <label class="checkout__input--label mb-10" for="note">Order Notes <span class="checkout__input--label__star"></span></label>
                                <textarea class="checkout__notes--textarea__field border-radius-5" id="note" name="note" placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false">{{ old('note') }}</textarea>
                            </div>
                            <div class="checkout__content--step__footer d-flex align-items-center">
                                <a class="continue__shipping--btn primary__btn border-radius-5" href="/home">Continue Shopping</a>
                                <a class="previous__link--content" href="cart.html">Return to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                            <div class="cart__table checkout__product--table">
                                <table class="cart__table--inner">
                                    <tbody class="cart__table--body">
                                        @foreach ($products as $key => $product)
                                            @auth('customer')
                                                <tr class="cart__table--body__items">
                                                    <td class="cart__table--body__list">
                                                        <div class="product__image two  d-flex align-items-center">
                                                            <div class="product__thumbnail border-radius-5">
                                                                <a class="display-block" href="/product-detail/show/{{ $product->id }}"><img class="display-block border-radius-5" src="{{ asset('/product//'. $product->getImage()) }}" alt="cart-product"></a>
                                                                <span class="product__thumbnail--quantity">{{ $product->pivot->quantity }}</span>
                                                            </div>
                                                            <div class="product__description">
                                                                <h4 class="product__description--name"><a href="/product-detail/show/{{ $product->id }}">{{ $product->name }}</a></h4>
                                                                <span class="product__description--variant">MATERIAL: {{ $product->material }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__table--body__list">
                                                        <span class="cart__price">{{ number_format($product->pivot->quantity * $product->price, 0, '.', ',') }} VND</span>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="order_detail[]" value="{{ json_encode(['product_id' => $product->id, 'quantity' => $product->pivot->quantity, 'price' => $product->pivot->quantity * $product->price]) }}">
                                            @else
                                                <tr class="cart__table--body__items">
                                                    <td class="cart__table--body__list">
                                                        <div class="product__image two  d-flex align-items-center">
                                                            <div class="product__thumbnail border-radius-5">
                                                                <a class="display-block" href="/product-detail/show/{{ $key }}"><img class="display-block border-radius-5" src="{{ asset('/product//'. $product['image']) }}" alt="cart-product"></a>
                                                                <span class="product__thumbnail--quantity">{{ $product['quantity'] }}</span>
                                                            </div>
                                                            <div class="product__description">
                                                                <h4 class="product__description--name"><a href="/product-detail/show/{{ $key }}">{{ $product['product_name'] }}</a></h4>
                                                                <span class="product__description--variant">MATERIAL: {{ $product['material'] }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__table--body__list">
                                                        <span class="cart__price">{{ number_format($product['total_price'], 0, '.', ',') }} VND</span>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="order_detail[]" value="{{ json_encode(['product_id' => $key, 'quantity' => $product['quantity'], 'price' => $product['total_price']]) }}">
                                            @endauth
                                        @endforeach
                                    </tbody>
                                </table> 
                            </div>
                            <div class="checkout__discount--code d-flex" style="position: relative;">
                                <label>
                                    <input class="checkout__discount--code__input--field border-radius-5" name="coupon_code" placeholder="Gift card or discount code"  type="text">
                                    @error('coupon_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </label>
                                <button class="checkout__discount--code__btn primary__btn border-radius-5" type="button">Apply</button>
                            </div>
                            <div class="shipping_method mb-4">
                                <h3>Shipping method</h3>
                                @foreach ($ships as $ship)
                                    <div class="form-check">
                                        <input class="form-check-input shipping-input" data-shipping-fee="{{ $ship->fee }}" type="radio" name="ship_id" id="ship-{{$ship->id}}" value="{{ $ship->id }}" {{ old('ship_id') == $ship->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ship-{{$ship->id}}">
                                            {{ $ship->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('ship_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Subtotal </td>
                                            @auth('customer')
                                                @php
                                                    $total_price = 0;
                                                    foreach ($products as $product) {
                                                        $total_price += $product->pivot->quantity * $product->price;
                                                    }
                                                @endphp
                                                <td class="checkout__total--amount text-right" data-subtotal="{{ $total_price }}">{{number_format($total_price, 0, '.', ',')}} VND</td>
                                            @else
                                                <td class="checkout__total--amount text-right" data-subtotal="{{number_format(collect($products)->sum('total_price'), 0, '.', '')}}">{{number_format(collect($products)->sum('total_price'), 0, '.', ',')}} VND</td>
                                            @endauth
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Shipping</td>
                                            <td class="checkout__total--calculated__text text-right">Calculated at next step</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__total--footer">
                                        <tr class="checkout__total--footer__items">
                                            <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total </td>
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            @auth('customer')
                                                @php
                                                    foreach ($products as $product) {
                                                        $total_price += $product->pivot->quantity * $product->price;
                                                    }
                                                @endphp
                                                <td class="checkout__total--footer__amount checkout__total--footer__list text-right" data-total-price="{{ $total_price }}">{{number_format($total_price, 0, '.', ',')}} VND</td>
                                            @else
                                                @php
                                                    $total_price += collect($products)->sum('total_price')
                                                @endphp
                                                <td class="checkout__total--footer__amount checkout__total--footer__list text-right" data-total-price="{{ $total_price }}">{{number_format($total_price, 0, '.', ',')}} VND</td>
                                            @endauth
                                        </tr>
                                        <input type="hidden" name="total_price" id="total_price" value="{{ $total_price }}">
                                        @error('total_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment__history mb-30">
                                <h3 class="payment__history--title mb-20">Payment</h3>
                                <ul class="payment__history--inner d-flex flex-wrap">
                                    @foreach ($payments as $payment)
                                        <li class="payment__history--list" style="margin-bottom: 1rem;">
                                            <input type="radio" name="payment_id" id="payment-{{ $payment->id }}" value="{{ $payment->id }}" hidden {{ old('payment_id') ==  $payment->id ? 'ckecked' : '' }}>
                                            <label class="payment__history--link primary__btn" for="payment-{{ $payment->id }}" style="{{ old('payment_id') ==  $payment->id ? 'background-color:#C97F5F;' : '' }}">{{ $payment->name }}</label>
                                        </li>
                                    @endforeach
                                    @error('payment_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </ul>
                            </div>
                            <button class="checkout__now--btn primary__btn" type="submit">Checkout Now</button>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End checkout page area -->
    <x-service></x-service>
    <script>
        var default_price = $('.checkout__total--amount').attr('data-subtotal')
        $('.shipping-input').click(function () { 
            var fee = $(this).attr('data-shipping-fee')
            var subTotal = $('.checkout__total--amount').attr('data-subtotal')
            $('.checkout__total--calculated__text').text(formatNumber(Number(fee)) + ' VND')
            $('.checkout__total--footer__amount').text(formatNumber(Number(fee) + Number(subTotal)) + ' VND')
            $('total_price').val(Number(fee) + Number(subTotal))
        });
        $('.payment__history--link').click(function () { 
            $('.payment__history--link').removeAttr('style');
            $(this).css('background-color', '#C97F5F')
        });
        $('.checkout__discount--code__btn').click(function () { 
            var coupon_code = $(this).prev().children().val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/checkout/applyCouponCode",
                data: {
                    coupon_code: coupon_code
                },
                success: function (response) {
                    var subTotal = default_price - (default_price * (response.discount_percent/100));
                    $('.checkout__total--amount').attr('data-subtotal', subTotal);
                    $('.checkout__total--amount').text(formatNumber(Number(subTotal)) + ' VND');
                    if($('.shipping-input:checked').val() == undefined)
                    {   
                        console.log('ssss',subTotal)
                        $('.checkout__total--footer__amount').val(subTotal)
                        $('total_price').val(Number(subTotal))
                    }
                    else
                    {
                        var fee = $('.shipping-input:checked').attr('data-shipping-fee')
                        console.log('aaaa',subTotal + fee)
                        $('.checkout__total--footer__amount').text(formatNumber(Number(fee) + Number(subTotal)) + ' VND')
                        $('total_price').val(Number(fee) + Number(subTotal))
                    }
                    alert(response.discount_percent)
                },
                error: function (err) {
                    console.log()
                    $('.checkout__discount--code__input--field').val('')
                    $('.checkout__total--amount').attr('data-subtotal', default_price);
                    $('.checkout__total--amount').text(formatNumber(Number(default_price)) + ' VND');
                    if($('.shipping-input:checked').val() == undefined)
                    {
                        $('.checkout__total--footer__amount').val(default_price)
                        $('total_price').val(Number(default_price))
                    }
                    else
                    {
                        var fee = $('.shipping-input:checked').attr('data-shipping-fee')
                        $('.checkout__total--footer__amount').text(formatNumber(Number(fee) + Number(default_price)) + ' VND')
                        $('total_price').val(Number(fee) + Number(default_price))
                    }
                    alert(err.responseJSON.errors.coupon_code[0])
                }
            });
                    console.log(default_price);
        });
    </script>
    @push('customize-js')
        <script>
            function formatNumber(number) {
                const parts = number.toFixed(2).toString().split('.');
                const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                const decimalPart = parts[1];
                return integerPart;
            }
        </script>
    @endpush
    <script src="https://www.paypal.com/sdk/js?client-id=env('PAYPAL_SANDBOX_CLIENT_ID')"></script>
@endsection