<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Brands</h2>
    <ul class="widget__tagcloud">
        @foreach ($products as $product)
            <input type="checkbox" name="brand_filter[]" id="{{ $product->brandLink() }}" value="{{ $product->brandLink() }}"
            {{ in_array($product->brandLink(), Request::query('brand_filter', [])) ? 'checked' : '' }} hidden>
            <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="javascript:void(0)"
                style="{{ in_array($product->brandLink(), Request::query('brand_filter', [])) ? 'background-color:#C97F5F; color:#fff' : '' }}"
            >{{ $product->brand }}</a></li>
        @endforeach
    </ul>
</div>

@push('customize-js')
    <script>
        $(".widget__tagcloud--list").click(function () { 
            $(this).prev().click();
            $('#sortByFilter').submit();
        });
    </script>
@endpush