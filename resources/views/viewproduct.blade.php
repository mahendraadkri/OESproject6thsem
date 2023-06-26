@extends('master')
@section('content')
@include('layouts.message')
    <div class="grid grid-cols-3 px-44 gap-10 my-10">
        <div>
            <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="w-full h-96 object-cover rounded-lg">
        </div>
        <div class="border-l-2 px-2 col-span-2">
            <h2 class="text-3xl">{{$product->name}}</h2>
            @if($product->oldprice != '')
            <p class="text-red-700 line-through text-lg">Rs. {{$product->oldprice}}/-</p>
            @endif
            <p class="text-red-700 text-2xl font-bold">Rs. {{$product->price}}/-</p>
            <p>Quantity</p>
            <form action="{{route('cart.store')}}" method="POST">
            <div class="mt-4 flex items-center">
                <span class="bg-gray-200 px-4 py-2 font-bold text-xl">-</span>
                <input class="h-11 w-12 px-0 text-center border-0 bg-gray-100" type="number" name="qty" value="1" readonly>
                <span class="bg-gray-200 px-4 py-2 font-bold text-xl">+</span>
            </div>
            <p>In Stock: {{$product->stock}}</p>

            <div class="mt-14">
                
                    @csrf

                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow">Add to Cart</button>
                
            </div>
        </form>
        </div>
    </div>


    <div class="px-44 my-10">
        <h2 class="font-bold text-2xl">About this product</h2>
        <p>{{$product->description}}</p>
    </div>

    <div class="px-44 my-10">
        <h2 class="font-bold text-2xl">Related Product</h2>

        <div class="grid grid-cols-4 gap-10 px-24 mb-10">

            @foreach($relatedproducts as $relatedproduct)
            <a href="{{route('viewproduct',$relatedproduct->id)}}">
                <div class="bg-gray-100 rounded-lg shadow-lg relative">
                    <img src="{{asset('images/products/'.$relatedproduct->photopath)}}" alt="" class="w-full h-72 object-cover rounded-t-lg">
                    <div class="p-2">
                        <p class="font-bold text-2xl">{{$relatedproduct->name}}</p>
                        <p class="font-bold text-2xl">
                            @if($relatedproduct->oldprice != '')
                            <span class="line-through text-gray-500 text-xl">{{$relatedproduct->oldprice}}/-</span> 
                            @endif
                            Rs. {{$relatedproduct->price}}/-</p>
                    </div>
                    @if($relatedproduct->oldprice != '')
                    @php
                        $discount = ($relatedproduct->oldprice - $relatedproduct->price) / $relatedproduct->oldprice * 100;
                        $discount = round($discount);
                    @endphp
                    <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-4 py-1">{{$discount}}% off</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>

        
    </div>

@endsection