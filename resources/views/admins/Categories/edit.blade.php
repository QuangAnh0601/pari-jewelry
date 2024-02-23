@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            <div class="card-body">
                <form action="/admin/category/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($category))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$category->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $category->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description">{{old('description', $category->description ?? '')}}</textarea>
                            @error("description")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="visibility" class="col-sm-2 col-form-label">Visibility</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="visibility" id="visibility" aria-label="Default select example">
                                <option value="Display" @if (old('visibility', $category->visibility ?? '') == 'Display') selected @endif>Display</option>
                                <option value="Not Display" @if (old('visibility', $category->visibility ?? '') == 'Not Display') selected @endif>Not Display</option>
                            </select>
                            @error("visibility")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
                        <div class="col-sm-10">
                            <input type="file" name="thumbnail" id="thumbnail" hidden>
                            <a href="javascript:void(0)" id="choose_thumbnail" class="btn btn-info mb-3">Choose thumbnail</a>
                            <div id="thumb_image" class="w-25">
                                @if (isset($category))
                                    <img src="{{ asset('img/categories/'. $category->thumbnail) }}" style="max-width:100%" alt="thumb"/>
                                @endif
                            </div>
                            @error("thumbnail")
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
        $('#choose_thumbnail').click(function (e) { 
            e.preventDefault();
            $('#thumbnail').click()
        });
        $('#thumbnail').change(function (e) { 
            var file = e.target.files[0]
            if(file) {
                var formData = new FormData()
                formData.append('image', file)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/admin/category/cropImage",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#thumb_image').html('<img src="'+response.image_base64+'" style="max-width:100%" class="border rounded" alt="thumb">');
                    }
                });
            }
        });
    </script>
    
@endsection