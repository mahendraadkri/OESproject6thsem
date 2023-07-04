<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\cart;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
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

    public function contactpage()
    {
        $itemsincart = $this->include();

        return view('user.contact',compact('itemsincart'));
    }


    public function index()
    {
        $contacts=Contact::all();
        $categories= Category::all();
        //  dd($categories);

        return view('contact.index',compact('contacts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email:filter',
            'message'=>'required',

        ]);
        Contact::create($data);
        return redirect(route('contact'))->with('success','Feedback sent sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
