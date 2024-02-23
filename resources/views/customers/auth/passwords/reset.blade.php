@extends('customers.layouts.layout')

@section('content')
    <!-- Start breadcrumb section -->
    <div class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Account Page</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End breadcrumb section -->

    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container w-50">
            <form method="POST" action="{{ route('customer.password.update') }}">
                @csrf
                <div class="login__section--inner">
                    <div class="account__login">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-15">Reset Password</h2>
                            <p class="account__login--header__desc">Fill your new password</p>
                        </div>
                        <div class="account__login--inner">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <label>
                                <input id="email" type="email" class="account__login--input @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="password" type="password" class="account__login--input @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="password-confirm" type="password" class="account__login--input" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                            </label>
                            <button class="account__login--btn primary__btn" type="submit">{{ __('Reset Password') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>     
    </div>
    <!-- End login section  -->

    <!-- Start feature section -->
   <section class="feature__section section--padding pt-0">
        <div class="container">
            <div class="feature__inner d-flex justify-content-between">
                <div class="feature__items d-flex align-items-center">
                    <div class="feature__icon">  
                        <img src="{{ asset('/img/other/feature1.webp') }}" alt="img">
                    </div>
                    <div class="feature__content">
                        <h2 class="feature__content--title h3">Free Shipping</h2>
                        <p class="feature__content--desc">Free shipping over $100</p>
                    </div>
                </div>
                <div class="feature__items d-flex align-items-center">
                    <div class="feature__icon ">  
                        <img src="{{ asset('/img/other/feature2.webp') }}" alt="img">
                    </div>
                    <div class="feature__content">
                        <h2 class="feature__content--title h3">Support 24/7</h2>
                        <p class="feature__content--desc">Contact us 24 hours a day</p>
                    </div>
                </div>
                <div class="feature__items d-flex align-items-center">
                    <div class="feature__icon">  
                        <img src="{{ asset('/img/other/feature3.webp') }}" alt="img">
                    </div>
                    <div class="feature__content">
                        <h2 class="feature__content--title h3">100% Money Back</h2>
                        <p class="feature__content--desc">You have 30 days to Return</p>
                    </div>
                </div>
                <div class="feature__items d-flex align-items-center">
                    <div class="feature__icon">  
                        <img src="{{ asset('/img/other/feature4.webp') }}" alt="img">
                    </div>
                    <div class="feature__content">
                        <h2 class="feature__content--title h3">Payment Secure</h2>
                        <p class="feature__content--desc">We ensure secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature section -->
@endsection