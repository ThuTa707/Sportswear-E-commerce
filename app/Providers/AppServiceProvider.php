<?php

namespace App\Providers;

use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        $new_orders = Order::with('user', 'orderProducts')->where('order_status', 'New')->get();
        view()->share('new_orders', $new_orders);

        // $cart_products = Cart::all();
        // if(\Auth::check()){
        //     if($cart_products){
        //         $cart_products_count = Cart::where('user_email', \Auth::user()->email)->get()->count();
        //         view()->share('cart_products_count', $cart_products_count);
        //     }
    
        // }
       
        
    }
}
