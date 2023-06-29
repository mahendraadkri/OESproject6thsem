<?php

namespace App\Http\Controllers;


use App\Models\cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::all();
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function details($orderid)
    {
        $order = Order::find($orderid);
        $carts = Cart::whereIn('id',explode(',',$order->cart_id))->get();
        return view('orders.details',compact('carts','order'));
    }

    public function status($id,$status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
        return redirect(route('order.index'))->with('success','Status changed to ',$status);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'payment_method' => 'required',
            'shipping_address' => 'required',
            'phone' => 'required',
            'person_name' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['order_date'] = date('Y-m-d');
        $data['status'] = 'Pending';
        $carts = Cart::where('user_id', auth()->user()->id)->where('is_ordered',false)->get();
        $totalamount = 0;
        foreach($carts as $cart) {
            $total = $cart->product->price * $cart->qty;
            $totalamount += $total;
        }
        $data['amount'] = $totalamount;
        $ids = $carts->pluck('id')->toArray();
        $data['cart_id'] = implode(',', $ids);
        Order::create($data);
        Cart::whereIn('id', $ids)->update(['is_ordered' => true]);
        //mail when order is placed
        $data = [
            'name' => auth()->user()->name,
            'mailmessage' => 'New Order has been placed.',
        
        ];
        Mail::send('email.email',$data, function($message){
            $message->to(auth()->user()->email)->subject('New Order Placed');
        });
            
        


        return redirect()->route('home')->with('success', 'Order has been placed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}