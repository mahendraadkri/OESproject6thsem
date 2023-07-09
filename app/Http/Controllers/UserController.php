<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $categories= Category::all();
        return view('myprofile',compact('categories'));
    }
    public function userregister()
    {
        $categories = Category::orderBy('priority')->get();
        return view('userregister',compact('categories'));
    }
    public function userstore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email:filter',
            'address' => 'required',
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';
        
        User::create($data);
        return redirect(route('home'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        $data['password'] = Hash::make($data['password']);


        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $name);
            $data['image_url'] = $name;
        }

        $user = User::find($id);
        $user->update($data);
       

        return redirect(route('myprofile'))->with('success', 'Profile updated successfully!');
    }
    public function edit(string $id)
    {
        dd($id);
    }
}
