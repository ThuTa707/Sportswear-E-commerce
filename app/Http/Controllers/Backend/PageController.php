<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $active_users_count = User::where('status', '1')->count();
        $active_admins_count = Admin::where('status', '1')->count();
        $total_orders_count = Order::get()->count();
        $today_orders_count = Order::whereDate('created_at', date('Y-m-d'))->get()->count();
        $total_revenue = Order::sum('grand_total');
        $today_revenue = Order::whereDate('created_at', date('Y-m-d'))->sum('grand_total');
        $latest_orders = Order::with('orderProducts')->latest()->get()->take(10);
        $best_selling_product = Product::orderBy('sold_stock', 'DESC')->first();

        $customers = User::where('status', '1')->get();
        $categories = Category::where('status', '1')->get();

        return view('backend.home', compact('active_users_count', 'active_admins_count', 'total_orders_count','today_orders_count', 'total_revenue', 'today_revenue', 'latest_orders', 'best_selling_product', 'customers', 'categories'));
    }
}
