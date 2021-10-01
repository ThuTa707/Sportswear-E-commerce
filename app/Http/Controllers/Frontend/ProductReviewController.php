<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\OrderProduct;
use App\ProductRating;
use App\ProductReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductReviewController extends Controller
{

    public function index($id)
    {
        // For Product Rating
        $product = Product::find($id);
        $reviews = ProductReview::with('user', 'product')->paginate(5);
        $reviews_count = ProductReview::get()->count();

        return view('frontend.reviews.reviews', compact('reviews', 'product', 'reviews_count'));
    }

    public function create($id)
    {
        $purchase_verified = OrderProduct::where('user_id', Auth::id())->where('product_id', $id)->get()->count();
        $product = Product::find($id);
        return view('frontend.reviews.reviews-add', compact('product', 'purchase_verified'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'review' => 'string',
        ]);

        $product_review = new ProductReview();
        $product_review->product_review = $request->review;
        $product_review->product_id = $id;
        $product_review->user_id = Auth::id();
        $product_review->save();

        return redirect()->route('products.detail', $id)->with('toast', ['icon' => 'success', 'title' => 'Thanks alots for your review.']);
    }

    public function show(ProductReview $productReview)
    {
        //
    }

 
    public function edit(ProductReview $productReview, $id)
    {   
        $productReview = ProductReview::with('product')->find($id);
        return view('frontend.reviews.reviews-edit', compact('productReview'));
    }

    public function update(Request $request, ProductReview $productReview, $id)
    {   
        $product_review = ProductReview::with('product')->find($id);

        if (! Gate::allows('update-review', $product_review)) {
            abort(403);
        }
       
        $product_review->product_review = $request->review;
        $product_review->update();

        return redirect()->route('products.reviews.index', $product_review->product_id)->with('toast', ['icon' => 'success', 'title' => 'Your review has been updated!!.']);
    }

    

    public function destroy(ProductReview $productReview, $id)
    {
        $product_review = ProductReview::find($id);
        $product_id = $product_review->product_id;
        if($product_review->delete()){
            return redirect()->route('products.reviews.index', $product_id )->with('toast', ['icon' => 'success', 'title' => 'Your review has been deleted!!.']);    
        }
        
    }
}

