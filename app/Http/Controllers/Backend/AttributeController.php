<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use App\ProductAttr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{

    public function index()
    {
    }

    public function create($id)
    {
        $attributes = ProductAttr::with('product')->where('product_id', $id)->get();
        $product = Product::find($id);
        return view('backend.products.product-attribute', compact('product', 'attributes'));
    }


    public function store(Request $request, $id)
    {
        $data = $request->all();

        foreach ($data['codes'] as $key => $code) {
            $product = new ProductAttr();
            $product->product_id = $id;
            $product->code = $code;
            $product->size = $request['sizes'][$key];
            $product->price = $request['price'][$key];
            $product->stock = $request['stocks'][$key];
            $product->save();
        }

        return redirect()->route('products.attributes.create', $id)->with('toast', ['icon' => 'success', 'title' => 'Product Attribute is added !!!']);
    }

    public function show(ProductAttr $productAttr)
    {
        //
    }

    public function edit(ProductAttr $productAttr, $id)
    {

    }
    public function update(Request $request, ProductAttr $productAttr, $id)
    {
        $attribute = ProductAttr::find($id);
        // $attribute->code = $request->code;
        $attribute->size = $request->size;
        $attribute->price = $request->price;
        $attribute->stock = $request->stock;
        $attribute->update();
        return redirect()->route('products.attributes.create', $attribute->product_id)->with('toast', ['icon' => 'success', 'title' => 'Product Attribute is Update']);;
    }

    public function destroy(ProductAttr $productAttr, $id)
    {   
        $attribute = ProductAttr::find($id);
        $attribute->delete();
        return redirect()->route('products.attributes.create', $attribute->product_id);
    }
}
