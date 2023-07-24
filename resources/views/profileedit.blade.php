    
@extends('master')
@section('content')
@include('layouts.message')

    <div class="grid grid-cols-2">
        <img src="https://icon-library.com/images/profile-icon/profile-icon-17.jpg ">
        <div class="flex justify-center items-center">
            <div class="text-center w-full">
                <h2 class="font-bold text-4xl">Edit Profile</h2>
                
                <form action="{{route('profileedit.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="text" class="block border border-grey-ligh t w-full p-3 rounded mb-4"
                                name="name" placeholder="Full Name" value="{{ auth()->user()->name }}" />
                                @error('name')
                                <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                            @enderror

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="email" placeholder="Email" value="{{ auth()->user()->email }}" />
                                @error('email')
                                <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                            @enderror

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="address" placeholder="Address" value="{{ auth()->user()->address }}" />
                                @error('address')
                                <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                            @enderror

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="phone" placeholder="Phone" value="{{ auth()->user()->phone }}" />
                                @error('phone')
                                 <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                                @enderror
                                    
                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password"
                            placeholder="Password" />
                            @error('password')
                            <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                            @enderror

                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4"
                            name="password_confirmation" placeholder="Confirm Password" />
                            @error('password_confirmation')
                            <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
                        @enderror


                           <a href="{{ route('profileedit', auth()->user()->id) }}" type="submit"
                                class="text-center ml-24 px-2 py-3 bg-yellow-500 rounded bg-green text-black hover:bg-green-dark focus:outline-none my-1">Update Account</a>

                    
                </form>
             

            </div>
        </div>
    </div>
    @endsection
