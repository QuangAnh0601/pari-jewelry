<div class="single__widget price__filter widget__bg">
    <h2 class="widget__title h3">Filter By Price</h2>
    <div class="price__filter--form__inner mb-15">
        <div class="price__filter--group" style="width:80%">
            <label class="price__filter--label" for="Filter-Price-GTE2">From</label>
            <div class="price__filter--input border-radius-5 d-flex align-items-center">
                <input class="price__filter--input__field border-0" name="price_from" value="{{ Request::query('price_from') }}" id="Filter-Price-GTE2" type="number" placeholder="0" min="0" max="1000000000.00">
                <span class="price__filter--currency">VND</span>
            </div>
        </div>
        <div class="price__divider">
            <span>-</span>
        </div>
        <div class="price__filter--group" style="width:80%">
            <label class="price__filter--label" for="Filter-Price-LTE2">To</label>
            <div class="price__filter--input border-radius-5 d-flex align-items-center">
                <input class="price__filter--input__field border-0" name="price_to" value="{{ Request::query('price_to') }}" id="Filter-Price-LTE2" type="number" min="10000000" placeholder="10000000" max="1000000000.00"> 
                <span class="price__filter--currency">VND</span>
            </div>	
        </div>
    </div>
    <button class="primary__btn price__filter--btn" type="submit">Filter</button>
</div>