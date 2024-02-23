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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/user/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Iamge</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Iamge</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th style="width:12%">Role</th>
                                <th style="width:8%">Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $users->count() > 0 )
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td align="center"><span><img src="{{ asset("/admin/img/user-images/$user->image") }}" width="100" alt="{{ $user->name }}"></span></td>
                                        <td>{{ $user->age }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="bagde badge-info rounded font-weight-bold p-1">{{$role->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="/admin/user/edit/{{$user->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$user->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$user->id}}]" action="/admin/user/delete/{{$user->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>không có nhân viên nào trong hệ thống</h1>
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection