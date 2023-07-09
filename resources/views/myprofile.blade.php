@extends('master')
@section('content')
@include('layouts.message')
    

    <div>
      <div class="grid grid-cols-2 gap-4">            
            <div class="bg-grey-lighter min-h-screen flex flex-col">
                <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
                    <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <h1 class="mb-8 text-3xl text-center">Edit Profile</h1>
                            <input type="text" class="block border border-grey-ligh t w-full p-3 rounded mb-4"
                                name="name" placeholder="Full Name" value="{{ auth()->user()->name }}" />

                            <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="email" placeholder="Email" value="{{ auth()->user()->email }}" />

                            <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="address" placeholder="Address" value="{{ auth()->user()->address }}" />

                            <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="phone" placeholder="Phone" value="{{ auth()->user()->phone }}" />

                           <a href="{{ route('profileedit', auth()->user()->id) }}" type="submit"
                                class="text-center ml-24 px-2 py-3 bg-red-500 rounded bg-green text-black hover:bg-green-dark focus:outline-none my-1">Edit Account</a>

                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

    
