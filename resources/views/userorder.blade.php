@extends('master')
@section('content')

<table>
    <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Order Date</th>
        <th>Price</th>
        <th>Status</th>
    </tr>
    @foreach ($orders as $order)
    @foreach ($order->carts as $cart )
    <tr>
        <td><img class="w-16" src="{{asset('images/products/'.$cart->product->photopath)}}" alt=""></td>
        <td>
            {{$cart->product->name}}
        </td>
        <td>
            {{$order->order_date}}
        </td>
        <td>{{$cart->product->price}}</td>
        <td>{{$order->status}}</td>
        
    </tr>
        
    @endforeach
        
    @endforeach
</table>
@endsection
