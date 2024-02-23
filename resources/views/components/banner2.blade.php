    <!-- Start banner section -->
    <section class="banner__section section--padding pt-0">
    <div class="container-fluid p-0">
        <div class="row no-gutter mb--n30">
            @foreach ($categories as $category)
                <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                    <div class="banner__box border-radius-5 position-relative">
                        <a class="display-block" href="/shop/sortByFilter?category_filter={{ $category->categoryLink() }}"><img class="banner__box--thumbnail border-radius-5" src="{{ asset('/img/categories/'. $category->thumbnail) }}" alt="banner-img">
                            <div class="fullwidth__banner--box__content left">
                                {{-- <p class="fullwidth__banner--box__subtitle">{{ $category->name }}</p> --}}
                                <h2 class="fullwidth__banner--box__title ">{{ $category->name }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                <div class="banner__box border-radius-5 position-relative">
                    <a class="display-block" href="shop.html"><img class="banner__box--thumbnail border-radius-5" src="{{ asset('/img/banner/banner16.webp') }}" alt="banner-img">
                        <div class="fullwidth__banner--box__content right">
                            <p class="fullwidth__banner--box__subtitle">Store Beautlux</p>
                            <h2 class="fullwidth__banner--box__title ">Rings <br>
                                Collections</h2>
                            <span class="banner__box--content__btn primary__btn">SHOP NOW </span>
                        </div>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- End banner section -->