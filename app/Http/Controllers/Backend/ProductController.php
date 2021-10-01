<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{

    public function index()
    {
        return view('backend.products.products');
    }


    public function anyData()
    {
        $products = Product::with('category', 'admin')->get();

        return Datatables::of($products)
            ->editColumn('created_at', function ($each) {

                $date = $each->created_at->format('d-m-Y');
                $time = $each->created_at->format('H:ia');
                return '<i class="fa fa-calendar" aria-hidden="true"></i> ' . $date . "<br>" .
                    '<i class="fa fa-clock-o" aria-hidden="true"></i> ' . $time;
            })

            ->editColumn('admin_id', function ($each) {

                $username = $each->admin->name;
                return $username;
            })

            // ->editColumn('category_id', function ($each) {
            //     $category = $each->category->name;
            //     return $category;
            // })

            ->addColumn('action', function ($each) {

                $edit_btn = '<a class="btn btn-warning btn-sm" href="' . route('products.edit', $each->id) . '"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                $delete_btn = '<form action="' . route('products.destroy', $each->id) . '" method="POST" style="display:inline-block; margin-left:5px" id="delForm' . $each->id . '">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="_method" value="delete">
            <button type="button" data-id="' . $each->id . '" class="btn btn-danger btn-sm del"><i class="fa fa-trash" aria-hidden="true"> </i></button>
        </form>';
                $attribute_btn = '<a class="btn btn-success btn-sm" href="' . route('products.attributes.create', $each->id) . '"  style="margin-left:5px"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';

                return $edit_btn . $delete_btn . $attribute_btn;
            })

            ->editColumn('image', function ($each) {

                $pics = [];
                foreach (unserialize($each->image) as $image) {
                    $image = '<img src="' . asset('storage/products/' . $image) . '" alt="error" style="width: 50px; height: 50px">';
                    array_push($pics, $image);
                }
                $pics = implode($pics);
                return $pics;
            })


            ->editColumn('status', function ($each) {

                if ($each->status == 1) {
                    $activeBtn = '<form action="' . route('products.status.inactive', $each->id) . '"method="POST" style="display:inline-block; margin-left:5px" id="statusForm' . $each->id . '" >
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="button" data-id="' . $each->id . '" class="btn btn-success btn-sm pstatusUnactive">Active</button>
                </form>';

                    return $activeBtn;
                } else {

                    $inactiveBtn = '<form action="' . route('products.status.active', $each->id) . '"  method="POST" style="display:inline-block; margin-left:5px" id="statusForm' . $each->id . '" >
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="button" data-id="' . $each->id . '" class="btn btn-danger btn-sm pstatusActive">Inactive</button>
                </form>';

                    return $inactiveBtn;
                }

            })


            ->rawColumns(['created_at', 'image', 'action', 'status'])
            ->make(true);
    }


    public function create()
    {
        $categories = Category::all();
        return view('backend.products.product-add', compact('categories'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->admin_id = Auth::id();



        $files = $request->file('images');
        $fileArr = [];
        foreach ($files as $file) {
            $imgName = uniqid() . "_" . $file->getClientOriginalName();
            Storage::putFileAs('/public/products/', $file, $imgName);
            array_push($fileArr, $imgName);
        }

        $product->image = serialize($fileArr);
        $product->save();

        return redirect()->route('products.index')->with('toast', ['icon' => 'success', 'title' => 'Product is added !!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.products.product-edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {

        $request->validate([

            'name' => 'required',
            'code' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product->name = $request->name;
        $product->code = $request->code;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;

        $files = $request->file('image');
        $fileArr = [];

        if ($files) {
            foreach ($files as $file) {

                $path = "/public/products/" . $product->image;
                Storage::delete($path);

                $imgName = uniqid() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('/public/products/', $file, $imgName);

                array_push($fileArr, $imgName);
            }

            $product->image = serialize($fileArr);
        }

        $product->update();

        return redirect()->route('products.index')->with('toast', ['icon' => 'success', 'title' => 'Product is updated.!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = unserialize($product->image);
        foreach($images as $image){
            $path = "/public/products/".$image;
                Storage::delete($path);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('toast', ['icon' => 'success', 'title' => 'Product is deleted.!!!']);
    }


    public function statusInactive(Request $request, $id)
    {

        $category = Product::find($id);
        $category->status = '0'; // Need to be string
        $category->update();
        return redirect()->route('products.index');
    }


    public function statusActive(Request $request, $id)
    {

        $category = Product::find($id);
        $category->status = '1'; // Need to be string
        $category->update();
        return redirect()->route('products.index');
    }
}
