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
                <h6 class="m-0 font-weight-bold text-primary">Review List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/review/editProductReview/{{$product->id}}" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div id="product" class="row mb-3">
                    <div class="col-md-3 text-center">
                        <h3>{{ $product->name }}</h3>
                        <span><img style="border: 2px solid rgb(194, 194, 194); border-radius: 10px" src="{{ asset('product/'.$product->getImage()) }}" width="200" alt="{{ $product->name }}"></span>
                    </div>
                    <div class="col-md-3 d-flex flex-column justify-content-end">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Guest</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>Rating</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Guest</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>Rating</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $reviews->count() > 0 )
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->content }}</td>
                                        <td>
                                            <nav>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <span class=""><i class="fas fa-star" style="color: #FF9800"></i></span>
                                                    @else
                                                        <span class=""><i class="far fa-star" style="color: #FF9800"></i></span>
                                                    @endif
                                                @endfor
                                            </nav>
                                        </td>
                                        <td>
                                            <a href="/admin/review/editProductReview/{{$product->id}}/{{$review->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$review->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$review->id}}]" action="/admin/review/delete/{{$review->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>Chưa có bình luận nào cho sản phẩm này</h1>
                            @endif
                        </tbody>
                    </table>
                    <div><a href="/admin/review" class="btn btn-primary">Back to Product List</a></div>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection