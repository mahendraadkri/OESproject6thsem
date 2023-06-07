@extends('master')
@section('content')
@include('layouts.message')
    <div class="w-1/2 mx-auto p-6 rounded-lg bg-gray-200 shadow-lg my-5">
        <h2 class="font-bold text-4xl text-center my-4">Login</h2>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="text" name="email" id="email" placeholder="Email" class="w-full px-2 rounded-lg  my-4">
            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-2 rounded-lg  my-4">
            <input type="submit" value="Login" class="w-1/2 block p-2 rounded-lg mx-auto my-4 bg-indigo-600 text-white">
            <a href="{{route('user.register')}}">Don't have account!! Register Here</a>
        </form>
    </div>

@endsection
