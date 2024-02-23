    <!-- Start collection section -->
<section class="shop__collection--section section--padding">
    <div class="container">
        <div class="section__heading text-center mb-40">
            <h2 class="section__heading--maintitle">Shop By Category</h2>
        </div>
        <div class="shop__collection--column5 swiper">
            <div class="swiper-wrapper">
                @if (!empty($categories))
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="shop__collection--card text-center">
                                <a class="shop__collection--link" href="/shop/sortByFilter?category_filter={{ $category->categoryLink() }}">
                                    <img class="shop__collection--img" src="{{ asset('/img/categories/'. $category->thumbnail) }}" alt="icon-img">
                                    <h3 class="shop__collection--title mb-0">{{ $category->name }}</h3>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="swiper__nav--btn swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
            <div class="swiper__nav--btn swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </div>
        </div>
    </div>
</section>
<!-- End collection section -->