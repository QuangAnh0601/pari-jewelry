@extends('layouts.sb-admin')

@section('content')
    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
            </div>
            <div class="card-body">
                <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{(old('name')) ? old('name') : $product->name}}">
                            @error("name")
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
                                @foreach ($product->productImages as $image)
                                    <img src="/product/{{$image->file_name}}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="cost" class="col-sm-2 col-form-label">Cost</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cost" id="cost" value="{{(old('cost')) ? old('cost') : $product->cost}}">
                            @error("cost")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" id="price" value="{{(old('price')) ? old('price') : $product->price}}">
                            @error("price")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description">{{(old('description')) ? old('description') : $product->description}}</textarea>
                            @error("description")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="material" class="col-sm-2 col-form-label">Material</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="material" id="material" value="{{(old('material')) ? old('material') : $product->material}}">
                            @error("material")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="weight" id="weight" value="{{(old('weight')) ? old('weight') : $product->weight}}">
                            @error("weight")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brand" id="brand" value="{{(old('brand')) ? old('brand') : $product->brand}}">
                            @error("brand")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option value="In Stock" @if (old('status', $product->status) == 'In Stock') selected @endif>In Stock</option>
                                <option value="Out Of Stock" @if (old('status', $product->status) == 'Out Of Stock') selected @endif>Out Of Stock</option>
                                <option value="Exprired" @if (old('status', $product->status) == 'Exprired') selected @endif>Exprired</option>
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
                                <option value="Display" @if (old('visibility', $product->visibility) == 'Display') selected @endif>Display</option>
                                <option value="Not Display" @if (old('visibility', $product->visibility) == 'Not Display') selected @endif>Not Display</option>
                            </select>
                            @error("visibility")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="my-3 row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="quantity" id="quantity" value="{{(old('quantity')) ? old('quantity') : $product->stocks}}">
                          @error("quantity")
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
        
                    <div class="my-3 row">
                        <label for="expired" class="col-sm-2 col-form-label">Expired</label>
                        <div class="col-sm-10">
                          <input type="datetime-local" class="form-control" name="expired" id="expired" value="{{old('expired')}}">
                          @error("expired")
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            {{$product->stocks->pluck('id')}}
                            <select class="form-control" aria-label="Default select example" name="stock" id="stock">
                                @foreach ($stocks as $stock)
                                    @if (in_array($stock->id, old('stock', $product->stocks->pluck('id')->toArray())))
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        var imagesPreview = function(input, placeToInsertImagePreview) {
            console.log(input.files);
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('class', 'mr-2 mt-3 p-2 border rounded').appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
        // $('body').on('click', ".upload__img-close", function (e) {
        //     var file = $(this).parent().data("file");
        //     for (var i = 0; i < imgArray.length; i++) {
        //     if (imgArray[i].name === file) {
        //         imgArray.splice(i, 1);
        //         break;
        //     }
        //     }
        //     $(this).parent().parent().remove();
        // });

        };
        $(document).ready(function () {
            
        });
        $('#selectImages').click(function (e) { 
            e.preventDefault();
            $('#images').click();
        });
        $('#images').change(function (e) { 
            e.preventDefault();

            imagesPreview(this, 'div.gallery');

        });
    </script>
    <script>
        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                imgArray.splice(i, 1);
                break;
            }
            }
            $(this).parent().parent().remove();
        });

    </script>
@endsection