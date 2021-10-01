<?php

namespace App\Http\Controllers\Backend;

use App\Address;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::with('orderProducts')->get();
        return view('backend.orders.order', compact('orders'));
    }

    public function orderDetail($id){

        $order = Order::find($id);
        $user = User::with('address')->find($order->user_id);

        return view('backend.orders.order-detail', compact('order', 'user'));
    }

    public function UpdateStatus(Request $request,$id){

        $order = Order::find($id);
        $order->order_status = $request->status;
        $order->update();

        return redirect()->route('admin.orders')->with('toast', ['icon' => 'success', 'title' => 'Order Status is updated.!!!']);

    }

    public function GenerateInvoice($id){

        $order = Order::find($id);
        $user = User::find($order->user_id);
        $address = Address::where('user_id', $order->user_id)->first();
        return view('backend.orders.order-invoice', compact('order', 'user', 'address'));
    }
}
