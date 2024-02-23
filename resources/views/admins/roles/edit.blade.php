@extends('layouts.sb-admin')

@section('content')

    <div class="container-fluid">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
            </div>
            <div class="card-body">
                <form action="/admin/role/update" method="POST">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$role->id}}">
                    @endif

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $role->name ?? '')}}">
                            @error("name")
                                  <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="desciption" id="description">{{old('desciption', $role->desciption ?? '')}}</textarea>
                            @error("desciption")
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