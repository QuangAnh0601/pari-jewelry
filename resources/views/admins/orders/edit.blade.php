@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Order</h6>
            </div>
            <div class="card-body">
                <form action="/admin/order/update" method="POST">
                    @csrf
                    @if (isset($order))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$order->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="customer" class="col-sm-2 col-form-label">Customer</label>
                        <div class="col-sm-10">
                            <select name="customer_id" id="customer" class="form-control">
                                @foreach ($customers as $customer)
                                @if (isset($order))
                                    <option data-address="{{$customer->address}}" value="{{ $customer->id }}" @if (old('customer_id', $order->customer_id) == $customer->id)
                                        selected
                                    @endif>{{ $customer->name}}</option>
                                @else
                                    <option data-address="{{$customer->address}}" value="{{ $customer->id }}" @if (old('customer_id') == $customer->id)
                                        selected
                                    @endif>{{ $customer->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            @error("customer_id")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{old('full_name', $order->full_name ?? $customer->addresses()->firstWhere('is_default', 1)->full_name ?? '')}}">
                            @error("full_name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{old('email', $order->email ?? $customer->email ?? '')}}">
                            @error("email")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{old('phone_number', $order->phone_number ?? $customer->phone_number ?? '')}}">
                            @error("phone_number")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="company" class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company" id="company" value="{{old('company', $order->company ?? '')}}">
                            @error("company")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="country" id="country">
                                <option value="Vietnam" {{ old('country', isset($order) ? $order->country : '') == 'Vietnam' ? 'selected' : '' }}>Viet Nam</option>
                                <option value="United States" {{ old('country', isset($order) ? $order->country : '') == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="Netherlands" {{ old('country', isset($order) ? $order->country : '') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                <option value="China" {{ old('country', isset($order) ? $order->country : '') == 'China' ? 'selected' : '' }}>China</option>
                                <option value="Islands" {{ old('country', isset($order) ? $order->country : '') == 'Islands' ? 'selected' : '' }}>Islands</option>
                                <option value="Canada" {{ old('country', isset($order) ? $order->country : '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Australia" {{ old('country', isset($order) ? $order->country : '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                            </select>
                            @error("country")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="postal_code" class="col-sm-2 col-form-label">Postal code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{old('postal_code', $order->postal_code ?? '')}}">
                            @error("postal_code")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="product" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            <select name="product[]" id="product" class="form-control mb-3" multiple>
                                @foreach ($products as $product)
                                @php
                                    $selected = '';
                                    $quantity = 1;
                                    $price = (float)number_format($product->price, 0, '.', '');
                                    $image = ($product->productImages->count() > 0) ? $product->productImages->first()->file_name : 'no-image.png';

                                    // Kiểm tra nếu sản phẩm có trong old('product')
                                    if (old('product', $order->orderDetails ?? '')) {
                                        $selectedProduct = collect(old('product', $order->orderDetails ?? ''))->first(function ($item) use ($product) {
                                            return json_decode($item)->product_id == $product->id;
                                        });

                                        if ($selectedProduct) {
                                            $selected = 'selected';
                                            $selectedProduct = json_decode($selectedProduct);
                                            $quantity = $selectedProduct->quantity;
                                            $price = $selectedProduct->price;
                                            if (property_exists($selectedProduct, 'image')) {
                                                $image = $selectedProduct->image;
                                            } else {
                                                $image = $image; // Hoặc giá trị mặc định khác nếu thích
                                            }
                                        }
                                    }

                                    $optionValue = json_encode([
                                        'product_id' => $product->id,
                                        'quantity' => $quantity,
                                        'price' => $price,
                                        'image' => $image,
                                    ]);
                                @endphp
                                    <option value="{{ $optionValue }}" {{ $selected }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error("product")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                            <div class="listProduct">
                                @if ( old('product') )
                                    @foreach (old('product',[]) as $item)
                                        @php
                                            $productInfo = json_decode($item);
                                        @endphp
                                        <div class="border rounded d-flex justify-content-around shadow mb-1 align-items-center" id="product-{{$productInfo->product_id}}">
                                            <div class="mx-auto"><img class="p-2 m-2 border rounded" src="{{ asset('product/'.$productInfo->image) }}" width="100" alt=""></div>
                                            <div class="mx-auto"><label for="quantity">Quantity</label><input class="form-control" value="{{$productInfo->quantity}}" type="number" name="" id="quantity"></div>
                                            <div class="mx-auto"><label for="price">Price</label><input data-default-price="{{number_format($productInfo->price, 0, '.', '')}}" class="form-control" type="text" value="{{number_format($productInfo->price, 0, '.', '')}}" name="" id="price" disabled></div>
                                        </div>
                                    @endforeach
                                @elseif (isset($order) && !old('product'))
                                    @foreach ($order->orderDetails as $item)
                                        @php
                                            $orderDetailIamge = ($item->product->productImages->count() > 0) ? $product->productImages->first()->file_name : 'no-image.png';
                                        @endphp
                                        <div class="border rounded d-flex justify-content-around shadow mb-1 align-items-center" id="product-{{$item->product_id}}">
                                            <div class="mx-auto"><img class="p-2 m-2 border rounded" src="{{ asset('product/'.$orderDetailIamge) }}" width="100" alt=""></div>
                                            <div class="mx-auto"><label for="quantity">Quantity</label><input class="form-control" value="{{$item->quantity}}" type="number" name="" id="quantity"></div>
                                            <div class="mx-auto"><label for="price">Price</label><input data-default-price="{{number_format($item->price, 0, '.', '')}}" class="form-control" type="text" value="{{number_format($item->price, 0, '.', '')}}" name="" id="price" disabled></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="coupon_code" class="col-sm-2 col-form-label">Coupon Code</label>
                        <div class="col-sm-10">
                            <select name="coupon_code" id="coupon_code" class="form-control">
                            @foreach ($coupons as $coupon)
                                @if (isset($order))
                                <option data-percent="{{$coupon->discount_percent}}" value="{{ $coupon->code }}" @if (old('coupon_code', $order->coupon_code) == $coupon->code)
                                    selected
                                    @endif>{{ $coupon->name}}</option>
                                @else
                                    <option data-percent="{{$coupon->discount_percent}}" value="{{ $coupon->code }}" @if (old('coupon_code') == $coupon->code)
                                        selected
                                    @endif>{{ $coupon->name}}</option>
                                @endif
                            @endforeach
                            </select>
                            @error("coupon_code")
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="total_price" id="total_price" value="{{old('total_price', $order->total_price ?? '')}}">
                            @error("total_price")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="shipping_address" class="col-sm-2 col-form-label">Shipping Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="shipping_address" id="shipping_address" value="{{old('shipping_address', $order->shipping_address ?? '')}}">
                            @error("shipping_address")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ship_id" class="col-sm-2 col-form-label">Delivery</label>
                        <div class="col-sm-10">
                            @foreach ($ships as $ship)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ship_id" id="{{$ship->name}}" value="{{$ship->id}}" {{old('ship_id', $order->ship_id ?? '') == $ship->id  ? 'checked' : ''}}>
                                    <label class="form-check-label" for="{{$ship->name}}">
                                        {{$ship->name}}
                                    </label>
                                </div>
                            @endforeach
                            @error("ship_id")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="payment_id" class="col-sm-2 col-form-label">Payment</label>
                        <div class="col-sm-10">
                            @foreach ($payments as $payment)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_id" id="{{$payment->name}}" value="{{$payment->id}}" {{old('payment_id', $order->payment_id ?? '') == $payment->id ? 'checked' : ''}}>
                                    <label class="form-check-label" for="{{$payment->name}}">
                                        {{$payment->name}}
                                    </label>
                                </div>
                            @endforeach
                            @error("payment_id")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="note" id="note">{{old('note', $order->note ?? '')}}</textarea>
                            @error("note")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            var address = $('#customer option:selected').attr('data-address')
                $('#shipping_address').val(address)
            
            $('#customer').change(function () { 
                address = $('#customer option:selected').attr('data-address')
                console.log(address);
                $('#shipping_address').val(address)
            });
            var totalPrice = 0
            var percent = $('#coupon_code option:selected').attr('data-percent')
            var priceWithCode = totalPrice - ((percent/100) * totalPrice)
            @if (old('total_price', $order->total_price ?? ''))
                priceWithCode = {{old('total_price', $order->total_price ?? '')}}
            @endif
            $('#total_price').val(priceWithCode)
            $("#product").change(function (e) { 
                var products = {{ Js::from($products) }}
                var html = '';
                $(".listProduct").html(html);
                var newProducts = $(this).val()
                console.log($(this).val())
                var defaultPrice = 0
                newProducts.forEach(element => {
                    var parseJson = JSON.parse(element)
                    defaultPrice += Number(parseJson.price)
                    console.log('====================================');
                    console.log(parseJson);
                    console.log('====================================');
                    html = `<div class="border rounded d-flex justify-content-around shadow mb-1 align-items-center" id="product-`+parseJson.product_id+`">
                                <div class="mx-auto"><span><img class="p-2 m-2 border rounded" src="{{ asset('product/`+parseJson.image+`') }}" width="100" alt=""></span></div>
                                <div class="mx-auto"><label for="quantity">Quantity</label><input class="form-control" value="`+parseJson.quantity+`" type="number" name="" id="quantity"></div>
                                <div class="mx-auto"><label for="price">Price</label><input class="form-control getPrice" data-default-price="`+Number(parseJson.price)+`" type="text" value="`+Number(parseJson.price)+`" name="" id="price" disabled></div>
                            </div>`
                    $(".listProduct").append(html);
                });
                totalPrice = defaultPrice
                priceWithCode = totalPrice - ((percent/100) * totalPrice)
                $('#total_price').val(priceWithCode);

            });
            $('#coupon_code').change(function () { 
                percent = $('#coupon_code option:selected').attr('data-percent')
                priceWithCode = totalPrice - ((percent/100) * totalPrice)
                $('#total_price').val(priceWithCode);
            });
            $('.listProduct').on('change', '#quantity', function(){
                var quantity = $(this).val();
                var currentPrice = $(this).parent().next().children('#price').attr('data-default-price')
                console.log(currentPrice);
                var newPrice = parseFloat(quantity * currentPrice)
                console.log('ssssss',newPrice);
                $(this).parent().next().children('#price').val(newPrice)
                var parentId = $(this).parent().parent().attr('id');
                var splitId = parentId.split('-');
                var getId = splitId[1];
                $('#product option').each(function() {
                var optionValue = JSON.parse($(this).val());
                if (optionValue.product_id == getId) {
                    optionValue.quantity = Number(quantity);
                    optionValue.price = Number(newPrice);
                    $(this).val(JSON.stringify(optionValue));
                    return false; // Dừng vòng lặp sau khi tìm thấy option
                }
                });
                
                var getAllPrice = 0
                $('#product option:selected').each(function () {
                    var optionValueChecked = JSON.parse($(this).val());
                    console.log('aaa', optionValueChecked);
                    getAllPrice += Number(optionValueChecked.price)
                })
                console.log(getAllPrice);
                totalPrice = getAllPrice
                priceWithCode = totalPrice - ((percent/100) * totalPrice)
                $('#total_price').val(priceWithCode);
            });
        });
    </script>
@endsection