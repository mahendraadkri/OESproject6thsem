<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function include()
    {
        if(!auth()->user())
        {
            return 0;
        }
        else
        {
            return Cart::where('user_id',auth()->user()->id)->count();
        }
    }
    public function home()
    {
        $itemsincart = $this->include();
        $products = Product::paginate(8);
        $categories = Category::orderBy('priority')->get();
        return view('welcome',compact('products','categories','itemsincart'));
    }

    public function about()
    {

        return view('about');
    }

    public function contactus()
    {
        $categories = Category::all();

        return view('contactus',compact('categories'));
    }

    public function viewproduct(Product $product)
    {
        $itemsincart = $this->include();
        // $product = Product::find($id);
        $categories = Category::orderBy('priority')->get();
        $relatedproducts = Product::where('category_id',$product->category_id)->whereNot('id',$product->id)->get();
       
        return view('viewproduct',compact('product','categories','itemsincart','relatedproducts'));
    }


    public function userlogin()
    {
        $itemsincart = $this->include();
        $categories = Category::orderBy('priority')->get();
        return view('userlogin',compact('categories','itemsincart'));
    }

    public function categoryproduct($id)
    {
        $category = Category::find($id);
        $itemsincart = $this->include();
        $products = Product::where('category_id',$id)->paginate(2);
        $categories = Category::orderBy('priority')->get();
        return view('categoryproduct',compact('products','categories','itemsincart','category'));
    }


}