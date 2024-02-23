@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Comment</h6>
            </div>
            <div class="card-body">
                <form action="/admin/review/updateProductReview" method="POST">
                    @csrf
                    @if (isset($review))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$review->id}}">
                    @endif
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            <strong>{{ $product->name }}</strong>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Guest</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $review->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            @isset($review)
                                <strong>{{ $review->email }}</strong>
                                <input type="hidden" name="email" id="email" value="{{old('email', $review->email ?? '')}}">
                                @error("email")
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            @else
                                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                                @error("email")
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            @endisset
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="content" id="content">{{old('content', $review->content ?? '')}}</textarea>
                            @error("content")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="1" name="rating" min="1" max="5" id="rating" value="{{old('rating', $review->rating ?? '')}}">
                            @error("rating")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection