@extends('layouts.sb-admin')

@section('content')
    <style>
        .avatar img {
            border: 3px solid rgb(185, 184, 184);
            border-radius: 100px
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-4 ">
                <div class="border rounded shadow text-center p-3">
                    <div class="avatar">
                        <input type="file" name="image" id="image" data-max_length="20" hidden>
                        <img src="{{ asset('admin/img/user-images/'. $user->image) }}" width="200" alt="">
                    </div>
                    <div class="user-name">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="user-role">
                        @foreach ($user->roles as $role)
                            <span class="rounded-pill bg-info text-white px-2">{{$role->name}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="border rounded shadow p-3">
                    <form method="POST" action="/admin/user/update">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$user->id}}">
                        @endif
                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Name') }}</label>
        
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name ?? '') }}" required autocomplete="name" autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('Email Address') }}</label>
        
                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email ?? '') }}" required autocomplete="email">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="age" class="col-md-2 col-form-label text-md-end">Age</label>
        
                            <div class="col-md-10">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', $user->age ?? '') }}" required autocomplete="email">
        
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-2 col-form-label text-md-end">Phone Number</label>
        
                            <div class="col-md-10">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}" required autocomplete="email">
        
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="address" class="col-md-2 col-form-label text-md-end">Address</label>
        
                            <div class="col-md-10">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address ?? '') }}" required autocomplete="email">
        
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" d-flex justify-content-end"><button type="submit" class="btn btn-primary">Update</button></div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        // $(document).ready(function () {
        //     var imagesPreview = function(input, placeToInsertImagePreview) {
        //     console.log(input.files);
        //     if (input.files) {
        //         var filesAmount = input.files.length;

        //         for (i = 0; i < filesAmount; i++) {
        //             var reader = new FileReader();

        //             reader.onload = function(event) {
        //                 $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('class', 'mr-2 mt-3 p-2 border rounded').appendTo(placeToInsertImagePreview);
        //             }

        //             reader.readAsDataURL(input.files[i]);
        //         }
        //     }

        // };
        // });
        $('.avatar > img').click(function (e) { 
            $(this).prev().click()
        });
        $('#image').change(function (e) { 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData()
            formData.append('image', this.files[0]);
            console.log(formData)
            $.ajax({
                type: "post",
                url: "/admin/profile/updateImage",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });  
            if (this.files) {
                var filesAmount = this.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        // $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('class', 'mr-2 mt-3 p-2 border rounded').appendTo(placeToInsertImagePreview);
                        $('.avatar > img').attr('src', event.target.result);
                    }

                    reader.readAsDataURL(this.files[i]);
                }
            }
        });
    </script>
@endsection