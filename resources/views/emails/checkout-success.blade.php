<x-mail::message>
<style>
.order-list {
  border-collapse: collapse;
  width: 100%;
}
.order-list thead {
    color: whitesmoke;
    background-color: darkslategrey;
}
.order-list th {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
.order-list td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}


</style>
# Successfull purchase

Dear {{$order->full_name}},

Thank you for your order.

We truly value our loyal customers. Thanks for making us who we are!
Here’s what you ordered this time:
<table class="order-list">
    <thead>
        <tr>
            <th>Name</th>
            <th>quantity</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
    @php
        $count = 0;
    @endphp
    @foreach ($order->orderDetails as $orderDetail)
    <tr>
        <td>{{ $orderDetail->product->name }}</td>
        <td>{{ $orderDetail->quantity }}</td>
        <td>{{ number_format($orderDetail->price, 0, '.', ',') }} VND</td>
    </tr>
    @php
        $count += 1
    @endphp
    @endforeach
    </tbody>
</table>
<h2>Total: {{ number_format($order->total_price, 0, '.', ',') }} VND</h2>
<x-mail::button :url="'http://paris.jewelry.com'">
Continue Shopping
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
