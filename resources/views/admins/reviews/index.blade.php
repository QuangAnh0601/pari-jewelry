@extends('layouts.sb-admin')

@section('content')
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
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Review management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Create By</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Create By</th>
                                <th>Comments</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $products->count() > 0 )
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ asset('product/'.$product->getImage()) }}" width="100" alt=""></td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td>
                                            <a href="/admin/review/listComment/{{$product->id}}" class="badge badge-primary"><i style="font-size: 30px" class="fas fa-comment-dots"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>Chưa có sản phẩm trong hệ thông</h1>
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection