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
                <h6 class="m-0 font-weight-bold text-primary">Role List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/role/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $roles->count() > 0 )
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->desciption }}</td>
                                        <td>
                                            <a href="/admin/role/edit/{{$role->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$role->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$role->id}}]" action="/admin/role/delete/{{$role->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>không có vai trò nào trong hệ thống</h1>
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $roles->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection