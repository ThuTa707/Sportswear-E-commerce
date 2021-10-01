<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\City;
use App\User;
use App\Cupon;
use App\Order;
use Exception;
use App\Banner;
use App\Address;
use App\Product;
use App\Category;
use App\ProductAttr;
use App\OrderProduct;
use App\DeliveryAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ProductRating;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::all();
        $categories = Category::where('status', '1')->get();
        $products = Product::with('category')->where('status', '1')->paginate(3);

        return view('frontend.index', compact('banners', 'categories', 'products'));
    }

    public function detail($id)
    {

        $product = Product::with('attributes')->find($id);
        $product_stock_total = ProductAttr::where('product_id', $id)->sum('stock');
        // $product_sold_total = ProductAttr::where('product_id', $id)->sum('sold_stock');
        $featured_products = Product::with('attributes')->where('feature', '1')->get();

        // For Product Rating
        $product_rating_count = ProductRating::where('product_id', $id)->get()->count();
        $product_rating_sum = ProductRating::where('product_id', $id)->sum('product_rating');

        if($product_rating_count > 0){
            $average_rating = $product_rating_sum/$product_rating_count;
            $average_rating = number_format($average_rating);
        } else {
            $average_rating = 0;
        }

        return view('frontend.product-detail', compact('product', 'featured_products', 'product_stock_total', 'product_rating_count', 'average_rating'));
    }

    public function filter(Request $request)
    {

        $banners = Banner::all();
        $categories = Category::where('status', '1')->get();
        $products = Product::with('category');

        if ($request->category) {
            $products = $products->where('category_id', $request->category);
        }

        if ($request->searchProduct) {
            $products = $products->where('name', 'LIKE', "%$request->searchProduct%");
        }

        if ($request->sorting) {
            if ($request->sorting == 1) {
                $products = $products->orderBy('sold_stock', 'DESC');
            }
            if ($request->sorting == 2) {
                $products = $products->orderBy('price', 'DESC');
            }
            if ($request->sorting == 3) {
                $products = $products->orderBy('price', 'ASC');
            }
        }

        $products = $products->where('status', '1')->paginate(3);

        return view('frontend.index', compact('banners', 'categories', 'products'));
    }

    public function getPrice(Request $request)
    {

        $product = ProductAttr::find($request->size);

        if ($product) {
            $data = $product->price;
            return response()->json([

                'status' => 'success',
                'data' => $data,
            ]);
        }


        return response()->json([

            'status' => 'fail',
            'message' => 'Invalid Size'
        ]);
    }


    // Cart Starts
    public function addToCart(Request $request)
    {

        // Validation
        if ($request->size == 0 || $request->quantity == 0) {
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Please kindly choose your size or kit quantity']);
        }

        $cart_product = new Cart();
        $attr = ProductAttr::find($request->size);

        // Checking Duplicate product in cart
        $duplicate_check = Cart::where('user_email', Auth::user()->email)->where('product_id', $request->product_id)->where('size', $attr->size)->count();
        if ($duplicate_check >= 1) {

            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Your Product already exist in cart']);
        }






        if (Session::get('session_id')) {
            $session_id = Session::get('session_id');
            $cart_product->session_id = $session_id;
        } else {
            $session_id = Str::random(40);
            Session::put('session_id', $session_id);
            $cart_product->session_id = $session_id;
        }


        // Checking Out of Stock
        if ($attr->stock < ($attr->sold_stock + $request->quantity)) {
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => $request->name . '(' . $attr->size . ') is only avaliable ' . ($attr->stock - $attr->sold_stock) . ' now.']);
        }

        $cart_product->name = $request->name;
        $cart_product->product_code = $request->product_code;
        $cart_product->product_attr_code = $attr->code;
        $cart_product->product_id = $request->product_id;
        $cart_product->price = $request->price;
        $cart_product->size = $attr->size;
        $cart_product->quantity = $request->quantity;
        $cart_product->image = $request->image;
        $cart_product->user_email = Auth::user()->email;

        $cart_product->save();
        return redirect()->route('home')->with('toast', ['icon' => 'success', 'title' => 'Your produt is added to your cart!!']);
    }

    public function cart()
    {
        $cart_products_count = Cart::where('user_email', Auth::user()->email)->count();
        if ($cart_products_count < 1) {
            Session::forget('cupon_amount');
        }

        if (Auth::check()) {
            $cart_products = Cart::where('user_email', Auth::user()->email)->get();
        } else {
            $session_id = Session::get('session_id');
            $cart_products = Cart::where('session_id', $session_id)->get();
        }

        return view('frontend.cart', compact('cart_products', 'cart_products_count'));
    }


    public function deleteFromCart($id)
    {
        $cartProduct = Cart::find($id);
        $cartProduct->delete();
        return redirect()->back();
    }


    // WishList Starts
    public function wishlist()
    {
        $products = Wishlist::all();
        $products_count = Wishlist::where('user_id', Auth::id())->get()->count();
        return view('frontend.wishlist', compact('products', 'products_count'));
    }


    public function addToWishlist(Request $request)
    {

        $product = Product::find($request->id);
        if ($product) {

            $duplicate_check = Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->count();
            if ($duplicate_check >= 1) {
                return response()->json([
                    'status' => 'fail',
                    'icon' => 'error',
                    'info' => $product->name . ' already exists in wishList!!',
                ]);
            }

            $wishList = new Wishlist();
            $wishList->product_name = $product->name;
            $wishList->product_price = $product->price;
            $wishList->product_image = $product->image;
            $wishList->product_id = $product->id;
            $wishList->user_id = Auth::id();
            $wishList->save();

            return response()->json([
                'status' => 'success',
                'info' => $product->name . ' has been added to wishList!!',
            ]);
        }
    }



    public function wishListCount()
    {

        $products_count = Wishlist::where('user_id', Auth::id())->count();

        if ($products_count) {
            return response()->json([

                'status' => 'success',
                'count' => $products_count,
            ]);
        } else {
            return response()->json([

                'status' => 'fail',
                'count' => '',
            ]); 
        }
    }


    public function deleteFromWishlist($id)
    {   
        $wish_product = Wishlist::find($id);
        $wish_product->delete();
        return redirect()->back();
    }



    // Product Rating Starts
    public function productRating(Request $request){

        $purchase_verified = OrderProduct::where('user_id', Auth::id())->where('product_id', $request->id)->exists();
        if($purchase_verified){

            $product_rating = ProductRating::where('user_id', Auth::id())->where('product_id', $request->id)->first();
            if($product_rating){

                $product_rating->product_rating = $request->product_rating;
                $product_rating->product_id = $request->id;
                $product_rating->user_id = Auth::id();
                $product_rating->update();
            } else {
                $product_rating = new ProductRating();
                $product_rating->product_rating = $request->product_rating;
                $product_rating->product_id = $request->id;
                $product_rating->user_id = Auth::id();
                $product_rating->save();
            }

            

            return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Thanks alots for your rating.']);

        } else {
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'You can not give rating this product.']);
        }

 
    }


    public function updateQuantity(Request $request)
    {

        $product = Cart::find($request->id);

        if ($product) {
            $product->quantity = $request->quantity;
            $product->save();
            return response()->json([

                'status' => 'success',
                'data' => $product
            ]);
        } else {
            return response()->json([

                'status' => 'success',
                'message' => 'Invalid Product'
            ]);
        }

        // With Laravel Increment Method
        //     if ($product) {
        //         $product->increment('quantity', $request->quantity);

        //         return response()->json([

        //             'status' => 'success',
        //             'data' => $product
        //         ]);
        //     } else {
        //         return response()->json([

        //             'status' => 'success',
        //             'message' => 'Invalid Product' 
        //         ]);
        //     }
        // }
    }

    public function applyCupon(Request $request)
    {
        $cupon = Cupon::where('cupon_code', $request->cupon)->first();
        if (empty($cupon)) {
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Cupon Code does not exist']);
        }

        if ($cupon) {
            if ($cupon->status != '1') {
                return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Cupon Code is not active']);
            }

            $current_date = date('Y-m-d');
            $expire_date = $cupon->expire_date;
            if ($current_date > $expire_date) {
                return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Cupon Code is already expired']);
            }

            $session_id = Session::get('session_id');
            $products = Cart::where('session_id', $session_id)->get();
            $total_amount = 0;

            foreach ($products as $product) {
                $total_amount = $total_amount + $product->price * $product->quantity;
            }

            // When Cupon code is ready
            $type = $cupon->amount_type;
            if ($type == 1) {
                $cupon_amount = $total_amount * ($cupon->amount / 100);
            } else {
                $cupon_amount = $cupon->amount;
            }

            Session::put('cupon_amount', $cupon_amount);
            return redirect()->route('products.cart')->with('toast', ['icon' => 'success', 'title' => 'Cupon Code is successfully applied!!!']);
        }
    }

    public function user()
    {
        return view('frontend.users.user');
    }


    // Edit Password
    public function password()
    {
        return view('frontend.users.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('home')->with('toast', ['icon' => 'success', 'title' => 'Your Password is updated!!!']);
    }

    // Edit Address
    public function address()
    {
        $address = Address::where('user_id', Auth::id())->first();
        $cities = City::all();
        return view('frontend.users.change-address', compact('cities', 'address'));
    }



    public function updateAddress(Request $request)
    {
        $request->validate([

            'address' => 'required',
            'township' => 'required',
            'city' => 'required',
        ]);

        $address = Address::where('user_id', Auth::id())->first();
        $address->address = $request->address;
        $address->township = $request->township;
        $address->city_id = $request->city;
        $address->user_id = Auth::id();
        $address->update();

        return redirect()->route('home')->with('toast', ['icon' => 'success', 'title' => 'Your address is updated!!!']);
    }

    public function checkout()
    {

        $cart_count = Cart::where('user_email', Auth::user()->email)->get()->count();
        if($cart_count < 1){
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => 'Please Choose Product to Check out!!']);
        }
        $address = Address::with('user')->where('user_id', Auth::id())->first();
        $cities = City::all();
        return view('frontend.checkout', compact('cities', 'address'));
    }

    public function usersCheckout(Request $request)
    {

        // For user Address
        $count = Address::where('user_id', Auth::id())->count();
        if ($count > 0) {
            $address =  Address::where('user_id', Auth::id())->first();
            $address->address = $request->address;
            $address->township = $request->township;
            $address->city_id = $request->city;
            $address->user_id = Auth::id();
            $address->update();
        } else {
            $address = new Address();
            $address->address = $request->address;
            $address->township = $request->township;
            $address->city_id = $request->city;
            $address->user_id = Auth::id();
            $address->save();
        }

        // For Delivery Address
        $count = DeliveryAddress::where('user_id', Auth::id())->count();
        if ($count > 0) {
            $address =  DeliveryAddress::where('user_id', Auth::id())->first();
            $address->address = $request->shipping_address;
            $address->township = $request->shipping_township;
            $address->city_id = $request->shipping_cities;
            $address->name = $request->shipping_name;
            $address->phone = $request->shipping_phone;
            $address->user_id = Auth::id();
            $address->update();
        } else {
            $address = new DeliveryAddress();
            $address->address = $request->shipping_address;
            $address->township = $request->shipping_township;
            $address->city_id = $request->shipping_cities;
            $address->name = $request->shipping_name;
            $address->phone = $request->shipping_phone;
            $address->user_id = Auth::id();
            $address->save();
        }

        return redirect()->route('orderReview');
    }

    public function orderReview()
    {

        $address = Address::with('city', 'user')->where('user_id', Auth::id())->first();
        $deli_address = DeliveryAddress::with('city', 'user')->where('user_id', Auth::id())->first();
        $products = Cart::where('user_email', Auth::user()->email)->get();
        return view('frontend.order-review', compact('products', 'address', 'deli_address'));
    }

    public function orderConfirm(Request $request)
    {

        $user = User::find(Auth::id());
        $user_id = $user->id;
        $user_name = $user->name;
        $user_email = $user->email;
        $user_phone = $user->phone;

        // For Shipping Address

        try {
            DB::beginTransaction();
            $shipping_address = DeliveryAddress::where('user_id', $user_id)->first();
            $order = new Order();
            $order->user_id = $user_id;
            $order->shipping_name = $shipping_address->name;
            $order->shipping_phone = $shipping_address->phone;
            $order->email = $user_email;
            $order->shipping_address = $shipping_address->address;
            $order->shipping_township = $shipping_address->township;
            $order->shipping_city = $shipping_address->city->city;
            $order->cupon_amount = Session::get('cupon_amount') ? Session::get('cupon_amount') : 0;
            $order->cupon_code = Session::get('cupon_code') ? Session::get('cupon_code') : "None";
            $order->payment_method = $request->paymentMethod;
            $order->grand_total = $request->grand_total;
            $order->order_status = 'New';
            $order->delivery_charge = $request->delivery_charge;
            $order->save();


            $order = Order::orderBy('id', 'DESC')->first();
            // $order_id = DB::getPdo()->lastInsertId(); return 0 need to fix error
            $cart_products = Cart::where('user_email', $user_email)->get();
            foreach ($cart_products as $product) {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $product->product_id;
                $order_product->user_id = $user_id;
                $order_product->product_name = $product->name;
                $order_product->product_code = $product->product_code;
                $order_product->product_quantity = $product->quantity;
                $order_product->product_price = $product->price;
                $order_product->product_size = $product->size;
                $order_product->save();

                // For Product
                $pro = Product::find($product->product_id);
                $pro->increment('sold_stock', $product->quantity);
                $pro->increment('total_revenue', $product->quantity * $product->price);
                $pro->update();

                // For Product Attribute
                $product_attr = ProductAttr::where('code', $product->product_attr_code)->first();
                $product_attr->increment('sold_stock', $product->quantity);
                $product_attr->increment('total_revenue', $product->quantity * $product->price);
                $product_attr->update();
            }

            DB::commit();

            Session::put('order_id', $order->id);
            Session::put('total', $request->grand_total);

            return redirect()->route('thank');
            // ->with('afterPurchase', ['order_id' => $order->id, 'total' => $request->grand_total])


            //   After Payment Setup    
            // if($request->paymentMethod == 'cod'){
            //     return redirect()->route('thank');
            // } else {
            //     return redirect()->route('stripe');
            // }


        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast', ['icon' => 'error', 'title' => "Sth is wrong!!" . $e->getMessage()]);
        }
    }

    public function thank()
    {
        $cartProducts = Cart::where('user_email', Auth::user()->email)->get();
        foreach ($cartProducts as $product) {
            $product->delete();
        }
        return view('frontend.orders.thank');
    }

    public function stripe()
    {
        $cartProducts = Cart::where('user_email', Auth::user()->email)->get();
        foreach ($cartProducts as $product) {
            $product->delete();
        }
        return view('frontend.orders.stripe');
    }


    public function ordersList()
    {

        $user_id = Auth::id();
        $orders = Order::with('orderProducts')->where('user_id', $user_id)->get();
        return view('frontend.orders.orders', compact('orders'));
    }

    public function orderDetail($id)
    {

        $address = Address::with('city', 'user')->where('user_id', Auth::id())->first();
        $deli_address = DeliveryAddress::with('city', 'user')->where('user_id', Auth::id())->first();
        $order = Order::with('orderProducts')->find($id);
        // $order_products = OrderProduct::with('order')->where('order_id', $id)->get();
        // return $order_products;
        return view('frontend.orders.order-detail', compact('address', 'deli_address', 'order'));
    }
}


   // Add Cities from Json File in storage folder to MySql Database
        // $json_data = file_get_contents(storage_path('mm.json'));
        // $objs = json_decode($json_data,true);
        // foreach($objs as $val){
            
        //     $city = new City();
        //     $city->city = $val['city'];
        //     $city->save();
         
        // }
        // return 'success';
