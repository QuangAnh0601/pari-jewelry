@extends('layouts.sb-admin')

@section('content')
    <!-- Begin Page Content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" permission="alert">
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
                <h6 class="m-0 font-weight-bold text-primary">Permission List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/permission/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-center">Role</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-center">Role</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $permissions->count() > 0 )
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->desciption }}</td>
                                        <td class="d-flex justify-around">
                                            @foreach ($roles as $role)
                                            <div class="form-check mx-auto">
                                                <input class="form-check-input givePermission" data-permissionId="{{$permission->id}}" type="checkbox" name="role" id="role-{{$role->id}}" value="{{$role->id}}" @if ($permission->roles->where('id', $role->id)->count() > 0)
                                                    checked
                                                @endif>
                                                <label class="form-check-label" for="role-{{$role->id}}">{{$role->name}}</label>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="/admin/permission/edit/{{$permission->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$permission->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$permission->id}}]" action="/admin/permission/delete/{{$permission->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>không có quyền nào trong hệ thống</h1>
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        $('.givePermission').change(function (e) {
            var permissionId = $(this).attr('data-permissionId');
            var roleId = $(this).val();
            var checked = $(this).is(':checked');
            displayCheckedType = checked ? 1 : 0
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/role/givePermissionTo",
                data: {
                    permission_id: permissionId,
                    role_id: roleId,
                    checked: displayCheckedType
                },
                success: function (response) {
                    console.log('====================================');
                    console.log(response);
                    console.log('====================================');
                },
                error: function (error) {
                    console.log('====================================');
                    console.log(error);
                    console.log('====================================');
                }
            });          
        });
    </script>
@endsection