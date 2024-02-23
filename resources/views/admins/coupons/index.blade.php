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
                <h6 class="m-0 font-weight-bold text-primary">Coupon List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/coupon/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Out Of Date</th>
                                <th>Discount Percent</th>
                                <th>Status</th>
                                <th>Create By</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Out Of Date</th>
                                <th>Discount Percent</th>
                                <th>Status</th>
                                <th>Create By</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $coupons->count() > 0 )
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->name }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->quantity }}</td>
                                        <td>{{ $coupon->out_of_date }}</td>
                                        <td>{{ $coupon->discount_percent }}</td>
                                        <td>{{ $coupon->status }}</td>
                                        <td>{{ $coupon->user->name }}</td>
                                        <td>
                                            <a href="/admin/coupon/edit/{{$coupon->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$coupon->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$coupon->id}}]" action="/admin/coupon/delete/{{$coupon->id}}" method="POST" class="d-none">
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
                    
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection