@extends('layouts.sb-admin')

@section('content')
<style>
    .fas.fa-trash-alt {
        color: black;
        position: absolute;
        right: 30px;
        bottom: 100px;
        font-size: 30px;
    }
</style>

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
            </div>
            <div class="card-body">
                <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($product))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$product->id}}">
                    @endif
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $product->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            @php
                                $countCategory = 0;
                            @endphp
                            @foreach ($categories as $item)
                            @if (isset($product))
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="categories[]" value="{{$item->id}}" class="custom-control-input" id="category{{$item->id}}" @if(in_array($item->id, old('category', $product->categories->pluck('id')->toArray()))) checked @endif>
                                    <label class="custom-control-label" for="category{{$item->id}}">{{$item->name}}</label>
                                </div>
                            @else
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="categories[]" value="{{$item->id}}" class="custom-control-input" id="category{{$item->id}}" @if(in_array($item->id, old('category', []))) checked @endif>
                                    <label class="custom-control-label" for="category{{$item->id}}">{{$item->name}}</label>
                                </div>
                            @endif
                            @php
                                $countCategory+=1
                            @endphp
                            @endforeach
                            @error("category")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="images" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10 upload__img-box">
                            <input type="file" name="images[]" id="images" data-max_length="20" hidden multiple>
                            <div>
                                <button class="btn btn-primary" id="selectImages">Select Iamges</button>
                                @error("images.*")
                                      <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="gallery">
                                @if (isset($product))
                                    @foreach ($product->productImages as $image)
                                        <span class="old-image" style="position: relative"><img  data-image-id="{{$image->id}}" src="/product/{{$image->file_name}}" class="mr-2 mt-3 p-2 border rounded" width="200" alt=""><i class="fas fa-trash-alt"></i></span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="cost" class="col-sm-2 col-form-label">Cost</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cost" id="cost" value="{{old('cost', $product->cost ?? '')}}">
                            @error("cost")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" id="price" value="{{old('price', $product->price ?? '')}}">
                            @error("price")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description">{{old('description', $product->description ?? '')}}</textarea>
                            @error("description")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="material" class="col-sm-2 col-form-label">Material</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="material" id="material" value="{{old('material', $product->material ?? '')}}">
                            @error("material")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="weight" id="weight" value="{{old('weight', $product->weight ?? '')}}">
                            @error("weight")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brand" id="brand" value="{{old('brand', $product->brand ?? '')}}">
                            @error("brand")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option value="In Stock" @if (old('status', $product->status ?? '') == 'In Stock') selected @endif>In Stock</option>
                                <option value="Out Of Stock" @if (old('status', $product->status ?? '') == 'Out Of Stock') selected @endif>Out Of Stock</option>
                                <option value="Exprired" @if (old('status', $product->status ?? '') == 'Exprired') selected @endif>Exprired</option>
                            </select>
                            @error("status")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="visibility" class="col-sm-2 col-form-label">Visibility</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="visibility" id="visibility" aria-label="Default select example">
                                <option value="Display" @if (old('visibility', $product->visibility ?? '') == 'Display') selected @endif>Display</option>
                                <option value="Not Display" @if (old('visibility', $product->visibility ?? '') == 'Not Display') selected @endif>Not Display</option>
                            </select>
                            @error("visibility")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 text-center">
                        <div class="col">
                            <label for="stock" class="col-form-label">Stock</label>
                        </div>
                        <div class="col">
                            <label for="quantity" class="col-form-label">Quantity</label>
                        </div>
                        <div class="col">
                            <label for="expired" class="col-form-label">Expired</label>
                        </div>
                        <div class="col-2">
                            <label class="col-form-label">Delete</label>
                        </div>
                    </div>
                    <div class="mb-3 stockPackage">
                        @error("stockPackage")
                              <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                        @php
                            $count = 0
                        @endphp
                        @if (isset($product))
                            @foreach ($product->stocks as $key => $val)
                                    <div class="row mb-3" id="{{$count}}">
                                        <div class="col stock">
                                            <div>
                                                <select class="form-control" aria-label="Default select example" id="stock">
                                                    @foreach ($stocks as $stock)
                                                        @if (old('stockPackage['.$count.'][stock]', $val->id ?? '') == $stock->id)
                                                            <option value="{{ $stock->id }}" selected>{{ $stock->name }}</option>
                                                        @else
                                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error("stock")
                                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col quantity">
                                            <div>
                                                <input type="number" class="form-control" id="quantity" value="{{old('stockPackage['.$count.'][quantity]', $val->pivot->quantity)}}">
                                                @error("quantity")
                                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col expired">
                                            <div>
                                            <input type="datetime-local" class="form-control" id="expired" value="{{old('stockPackage['.$count.'][expired]', $val->pivot->out_of_date)}}">
                                            @error("expired")
                                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <span>
                                                <i style="font-size: 40px; color: red; position: absolute; left: 0; right: 0; text-align: center;" class="fas fa-minus-circle deleteStock"></i>
                                            </span>
                                        </div>
                                    </div>
                                @php
                                    $count+=1
                                @endphp
                            @endforeach
                        @else
                            <div class="row mb-3" id="0">
                                <div class="col stock">
                                    <div>
                                        <select class="form-control" aria-label="Default select example" name="stock" id="stock">
                                            @foreach ($stocks as $stock)
                                                @if (old('stock') == $stock->id)
                                                    <option value="{{ $stock->id }}" selected>{{ $stock->name }}</option>
                                                @else
                                                    <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error("stock")
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col quantity">
                                    <div>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="{{old('quantity')}}">
                                        @error("quantity")
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col expired">
                                    <div>
                                    <input type="datetime-local" class="form-control" name="expired" id="expired" value="{{old('expired')}}">
                                    @error("expired")
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <span>
                                        <i style="font-size: 40px; color: red; position: absolute; left: 0; right: 0; text-align: center;" class="fas fa-minus-circle"></i>
                                    </span>
                                </div>
                            </div>
                        @endif
                        <div class="text-center">
                            <span style="font-size: 40px">
                                <i class="fas fa-plus-circle addStock"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="stockPackage" id="stockArr">
                    </div>
                    <div>
                        <input type="hidden" name="deleteImageId" id="deleteImageId">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        var imagesPreview = function(input, placeToInsertImagePreview) {
            console.log(input.files);
            $('.new-image').remove()
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var html = '<span style="position: relative"><img  src="'+event.target.result+'" class="mr-2 mt-3 p-2 border rounded new-image" width="200" alt=""><i class="fas fa-trash-alt"></i></span>'
                    $(html).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

        };
        $('#selectImages').click(function (e) { 
            e.preventDefault();
            $('#images').click();
        });
        $('#images').change(function (e) { 
            e.preventDefault();

            imagesPreview(this, 'div.gallery');

        });
        var stockPackageId = '';

        var stockPackage = [];
        var stockPackageDefaultId = 0;
        @if (isset($product))
            stockPackageId = {{$product->stocks->count()}}
            console.log(stockPackageId);
            var StockArr = {{ Illuminate\Support\Js::from($product->stocks) }}
            StockArr.forEach(element => {
                stockPackage.push({'id': stockPackageDefaultId, 'stock': element.id, 'quantity': element.pivot.quantity, 'expired': element.pivot.out_of_date});
                $('#stockArr').val(JSON.stringify(stockPackage))
                stockPackageDefaultId++
            });
        @else
            stockPackageId = 1
            console.log(stockPackageId);
        @endif

        $( ".gallery" ).on( "mouseenter", '.fa-trash-alt', function() {
                $(this).prev().css('opacity', 0.5)
                
            });
        $( ".gallery" ).on( "mouseleave", '.fa-trash-alt', function() {
                $(this).prev().css('opacity', 1)
                
            });

        $('.gallery').on('click', '.fa-trash-alt', function() { 
            $(this).parent().remove()
            var src = $(this).prev().attr('src').split('/')
            if($(this).prev().attr('data-image-id') !== undefined)
            {
                var deleteImageId = $(this).prev().attr('data-image-id');
                var currentValue = $('#deleteImageId').val()
                if(!currentValue){
                    currentValue += deleteImageId
                }
                else{
                    currentValue += ',' + deleteImageId
                }
                $('#deleteImageId').val(currentValue)
                console.log($(this).prev().attr('data-image-id'));
            }
            filter = src.filter(src => src != '')
            // console.log(src);
        });

        $('.stockPackage').on('click', '.addStock', function() { 
            var html = ' <div class="row mb-3" id="'+stockPackageId+'">'+
            '<div class="col stock">'+
                                '<div>'+
                                    '<select class="form-control" aria-label="Default select example" name="stock" id="stock">'+
                                        '@foreach ($stocks as $stock)'+
                                        '@if (old("stock") == $stock->id)'+
                                            '<option value="{{ $stock->id }}" selected>{{ $stock->name }}</option>'+
                                                '@else'+
                                            '<option value="{{ $stock->id }}">{{ $stock->name }}</option>'+
                                                '@endif'+
                                            '@endforeach'+
                                        '</select>'+
                                    '@error("stock")'+
                                    '<div class="alert alert-danger mt-3">{{ $message }}</div>'+
                                          '@enderror'+
                                    '</div>'+
                                '</div>'+
                            '<div class="col quantity">'+
                                '<div>'+
                                    '<input type="number" class="form-control" name="quantity" id="quantity" value="{{old('quantity')}}">'+
                                    '@error("quantity")'+
                                    '<div class="alert alert-danger mt-3">{{ $message }}</div>'+
                                          '@enderror'+
                                    '</div>'+
                                '</div>'+
                            '<div class="col expired">'+
                                '<div>'+
                                    '<input type="datetime-local" class="form-control" name="expired" id="expired" value="{{old('expired')}}">'+
                                  '@error("expired")'+
                                  '<div class="alert alert-danger mt-3">{{ $message }}</div>'+
                                        '@enderror'+
                                  '</div>'+
                                '</div>'+
                            '<div class="col-2">'+
                                '<span>'+
                                    '<i style="font-size: 40px; color: red; position: absolute; left: 0; right: 0; text-align: center;" class="fas fa-minus-circle deleteStock"></i>'+
                                    '</span>'+
                                '</div>'
            var stockPlus = $(this).before(html);
            console.log($(this).parent().children('#'+stockPackageId));
            var stock = $(this).parent().children('#'+stockPackageId).children('.stock').children().children().val();
            var quantity = $(this).parent().children('#'+stockPackageId).children('.quantity').children().children().val();
            var expired = $(this).parent().children('#'+stockPackageId).children('.expired').children().children().val();
            var filter = stockPackage.filter(stockPackage => stockPackage.id != stockPackageId)
            stockPackage = filter
            stockPackage.push({'id': stockPackageId, 'stock': stock, 'quantity': quantity, 'expired': expired});
            $('#stockArr').val(JSON.stringify(stockPackage))
            // console.log($(this).parent().parent().parent().append(html));
            
            console.log(stockPackage);
            stockPackageId++
        });
        $('.stockPackage').on('change', '.row', function() {
            var id = $(this).attr('id')
            var stock = $(this).children('.stock').children().children().val();
            var quantity = $(this).children('.quantity').children().children().val();
            var expired = $(this).children('.expired').children().children().val();
            var filter = stockPackage.filter(stockPackage => stockPackage.id != id)
            stockPackage = filter
            stockPackage.push({'id': id, 'stock': stock, 'quantity': quantity, 'expired': expired});
            console.log(stockPackage);
            $('#stockArr').val(JSON.stringify(stockPackage))

        })
        $('.stockPackage').on('click', '.deleteStock', function() { 
            $(this).parent().parent().parent().remove();
            var deleteId = $(this).parent().parent().parent().attr('id')
            // console.log(deleteId);
            var deleteFilter = stockPackage.filter(stockPackage => stockPackage.id != deleteId)
            console.log(deleteId,'ssss');
            console.log($(this).parent().parent().parent().attr('id'));
            
            stockPackage = deleteFilter
            console.log(stockPackage);
            $('#stockArr').val(JSON.stringify(stockPackage))
        });
    </script>
    
@endsection