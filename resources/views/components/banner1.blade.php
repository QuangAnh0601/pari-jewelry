<!-- Start grid banner section -->
<section class="grid__banner--section section--padding pt-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="grid__banner--thumbnail">
                    @if ($products->count() > 0)
                        <img src="{{ asset('product/'. $products[0]->getImage()) }}" alt="banner-img">
                    @else
                        <img src="{{ asset('product/no-image') }}" alt="banner-img">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                @if ($products->count() > 0)
                    <div class="grid__banner--content margin__left">
                        <h2 class="grid__banner--title">{{ $products[0]->name }}</h2>
                        <p class="grid__banner--desc">{{ $products[0]->description }}</p>
                        <a class="grid__banner--btn primary__btn" href="/product-detail/show/{{ $products[0]->id }}">SHOP NOW</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End grid banner section -->

<!-- Start grid banner section -->
<section class="grid__banner--section">
    <div class="container">
        <div class="row row_sm_u_reverse align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6">
                @if ($products->count() > 1)
                    <div class="grid__banner--content margin__left">
                        <h2 class="grid__banner--title">{{ $products[1]->name }}</h2>
                        <p class="grid__banner--desc">{{ $products[1]->description }}</p>
                        <a class="grid__banner--btn primary__btn" href="/product-detail/show/{{ $products[1]->id }}">SHOP NOW</a>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="grid__banner--thumbnail">
                    @if ($products->count() > 1)
                        <img src="{{ asset('product/'. $products[1]->getImage()) }}" alt="banner-img">
                    @else
                        <img src="{{ asset('product/no-image') }}" alt="banner-img">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End grid banner section -->