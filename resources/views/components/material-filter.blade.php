<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Material</h2>
    <ul class="widget__form--check">
        @foreach ($products as $product)
            <li class="widget__form--check__list">
                <label class="widget__form--check__label" for="{{ $product->materialLink() }}">{{ $product->material }}</label>
                <input class="widget__form--check__input" id="{{ $product->materialLink() }}" name="material_filter[]" type="checkbox" value="{{ $product->materialLink() }}"
                    {{ in_array($product->materialLink(), Request::query('material_filter', [])) ? 'checked' : '' }}
                >
                <span class="widget__form--checkmark"></span>
            </li>
        @endforeach
    </ul>
</div>

@push('customize-js')
    <script>
        $('input[type="checkbox"][name="material_filter[]"]').change(function () { 
            $('#sortByFilter').submit()
        });
    </script>
@endpush