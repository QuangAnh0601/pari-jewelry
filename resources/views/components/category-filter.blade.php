{{-- Category Filter --}}
<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Categories</h2>
    <ul class="widget__categories--menu">
        @foreach ($categories as $category)
            <li class="widget__categories--menu__list">
                <input type="radio" name="category_filter" id="{{ $category->categoryLink() }}" value="{{ $category->categoryLink() }}" {{ $category->categoryLink() == Request::query('category_filter') ? 'checked' : ''}} hidden>
                <label class="widget__categories--menu__label d-flex align-items-center" for="{{ $category->categoryLink() }}" style="{{ $category->categoryLink() == Request::query('category_filter') ? 'color:#C97F5F' : ''}} ">
                    <img class="widget__categories--menu__img" src="{{ asset('/img/categories/'. $category->thumbnail) }}" alt="categories-img">
                    <span class="widget__categories--menu__text">{{ $category->name }}</span>
                </label>
            </li>
        @endforeach
    </ul>
</div>

@push('customize-js')
    <script>
        $('input[type="radio"][name="category_filter"]').change(function() {
            if ($(this).is(':checked')) {
                var selectedValue = $(this).val();
                console.log('Selected value:', selectedValue);
                $('#sortByFilter').submit()
            }
        });
    </script>
@endpush