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
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/customer/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Addresses Infor</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Addresses Infor</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $customers->count() > 0 )
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->age }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td class="text-center"><a href="/admin/customer/edit/{{$customer->id}}#customerAddress" class="badge badge-primary"><i style="font-size:18px" class="fas fa-address-card p-2"></i></a></td>
                                        <td>
                                            <a href="/admin/customer/edit/{{$customer->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$customer->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$customer->id}}]" action="/admin/customer/delete/{{$customer->id}}" method="POST" class="d-none">
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
                    
                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection