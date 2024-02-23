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
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/product/create" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Visibility</th>
                                <th>Create By</th>
                                <td>Tools</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Visibility</th>
                                <th>Create By</th>
                                <td>Tools</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $products->count() > 0 )
                                @foreach ($products as $product)
                                    <tr>
                                        @if ($product->productImages->first() == null)
                                            <td><span><img src="{{ asset('product/no-image.png') }}" width="100" alt="{{ $product->name }}"></span></td>
                                        @else
                                            <td><span><img src="{{ asset('product/'.$product->productImages->first()->file_name) }}" width="100" alt="{{ $product->name }}"></span></td>
                                        @endif
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, '.', ',') }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->visibility }}</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td>
                                            <a href="/admin/product/edit/{{$product->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$product->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$product->id}}]" action="/admin/product/destroy/{{$product->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>không có sản phẩm nào trong hệ thống</h1>
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