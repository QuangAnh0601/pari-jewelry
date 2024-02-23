@extends('layouts.sb-admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="/admin/order/edit" class="btn btn-success">Create <i class="fas fa-plus"></i></a>
                        
                    <input type="search" class="form-control float-right w-25" name="search" id="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Shipping Address</th>
                                <th>Ship</th>
                                <th>Payment</th>
                                <th>Coupon</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Shipping Address</th>
                                <th>Ship</th>
                                <th>Payment</th>
                                <th>Coupon</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ( $orders->count() > 0 )
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->name ?? 'guest' }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->shipping_address }}</td>
                                        <td>{{ $order->ship->name }}</td>
                                        <td>{{ $order->payment->name }}</td>
                                        <td>{{ $order->coupon->name ?? 'do not have coupon' }}</td>
                                        <td>
                                            <select name="status" id="status" data-order-id="{{ $order->id }}" style="border: 0; outline-color: transparent; color: inherit;">
                                                <option value="New" {{ $order->status == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="Delivering" {{ $order->status == 'Delivering' ? 'selected' : '' }}>Delivering</option>
                                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="Cancel" {{ $order->status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                                            </select>
                                        </td>
                                        <td>{{ $order->note }}</td>
                                        <td>
                                            <a href="/admin/order/edit/{{$order->id}}" class="badge badge-success"><i class="fas fa-edit"></i></a>
                                            
                                            <a class="badge badge-danger" href="javascript:void(0)"
                                                onclick="if(confirm('Chắc chắn muốn xóa không ?'))
                                                                document.getElementById('destroy-form[{{$order->id}}]').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="destroy-form[{{$order->id}}]" action="/admin/order/delete/{{$order->id}}" method="POST" class="d-none">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h1>không có lịch sử đặt hàng nào trong hệ thống</h1>
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

<script>
    $("#status").change(function () { 
        var status = $(this).val();
        var orderId = $(this).attr('data-order-id')
        if (!confirm("The system will automatically remove the products in the order from the stock if the status changes. Are you sure you want to change the status?")) {
            return false;
        }
        else
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/order/updateStatus",
                data: {
                    status: status,
                    id: orderId
                },
                success: function (response) {
                    alert(response.success)
                },
                error: function (err) {
                    alert(err.responseJSON.error)
                }
            });
        }
    });
</script>
@endsection