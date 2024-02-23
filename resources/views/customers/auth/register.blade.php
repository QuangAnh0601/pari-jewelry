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
            <form method="POST" action="{{ route('customer.register') }}">
                @csrf
                <div class="login__section--inner">
                    {{-- <div class="account__login">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-15">Login</h2>
                            <p class="account__login--header__desc">Login if you area a returning customer.</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input id="email" type="email" class="account__login--input @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="password" type="password" class="account__login--input @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                <div class="account__login--remember position__relative">
                                    <input class="checkout__checkbox--input"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <label class="checkout__checkbox--label login__remember--label" for="remember">
                                        {{ __('Remember Me') }}</label>
                                </div>
                                <button class="account__login--forgot"  type="submit">Forgot Your Password?</button>
                            </div>
                            <button class="account__login--btn primary__btn" type="submit">Login</button>
                            <div class="account__login--divide">
                                <span class="account__login--divide__text">OR</span>
                            </div>
                            <p class="account__login--signup__text">Don,t Have an Account? <button type="submit">Sign up now</button></p>
                        </div>
                    </div> --}}
                    <div class="account__login register">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-15">Create an Account</h2>
                            <p class="account__login--header__desc">Register here if you are a new customer</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input id="name" type="text" class="account__login--input @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="email" type="email" class="account__login--input @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="age" type="text" class="account__login--input @error('age') is-invalid @enderror" placeholder="{{ __('Age') }}" value="{{ old('age') }}" name="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label>
                                <input id="phone_number" type="text" class="account__login--input @error('phone_number') is-invalid @enderror" placeholder="{{ __('Phone Number') }}"value="{{ old('phone_number') }}" name="phone_number">

                                @error('phone_number')
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
                            <button class="account__login--btn primary__btn mb-10" type="submit">Submit & Register</button>
                            <div class="account__login--remember position__relative">
                                <input class="checkout__checkbox--input" id="check2" type="checkbox">
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label login__remember--label" for="check2">
                                    I have read and agree to the terms & conditions</label>
                            </div>
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