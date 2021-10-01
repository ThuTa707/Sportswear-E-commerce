<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{

    public function index()
    {   
        $categories = Category::all();
        return view('backend.categories.categories', compact('categories'));
    }

    // public function anyData()
    // {
    //     $products = Category::query();

    //     return Datatables::of($products)
    //         ->editColumn('created_at', function ($each) {

    //             $date = $each->created_at->format('d-m-Y');
    //             $time = $each->created_at->format('H:ia');
    //             return '<i class="fa fa-calendar" aria-hidden="true"></i> ' .$date . "<br>" .
    //             '<i class="fa fa-clock-o" aria-hidden="true"></i> '. $time;
    //         })

    //         ->addColumn('action', function ($each) {

    //             $edit_btn = '<a class="btn btn-warning btn-sm" href="' . route('categories.edit', $each->id) . '"><i class="fa fa-edit" aria-hidden="true"></i></a>';
    //             $delete_btn = '<form action="' . route('categories.destroy', $each->id) . '" method="POST" style="display:inline-block; margin-left:5px" id="delForm' . $each->id . '">
    //         <input type="hidden" name="_token" value="' . csrf_token() . '">
    //         <input type="hidden" name="_method" value="delete">
    //         <button type="button" data-id="' . $each->id . '" class="btn btn-danger btn-sm del"><i class="fa fa-trash" aria-hidden="true"> </i></button>
    //     </form>';

    //             return $edit_btn . $delete_btn;
    //         })

    //         ->editColumn('status', function ($each) {

    //             if ($each->status == 1) {
    //                 $activeBtn = '<form action="'.route('categories.status.inactive', $each->id).'"method="POST" style="display:inline-block; margin-left:5px" id="statusForm' . $each->id . '" >
    //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                 <button type="button" data-id="' . $each->id . '" class="btn btn-success btn-sm statusUnactive">Active</button>
    //             </form>';

    //                 return $activeBtn;
    //             } else {

    //                 $inactiveBtn = '<form action="'.route('categories.status.active', $each->id).'"  method="POST" style="display:inline-block; margin-left:5px" id="statusForm' . $each->id . '" >
    //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                 <button type="button" data-id="' . $each->id . '" class="btn btn-danger btn-sm statusActive">Inactive</button>
    //             </form>';

    //                 return $inactiveBtn;
    //             }
    //         })

    //         ->rawColumns(['created_at', 'action', 'status'])
    //         ->make(true);
    // }


    public function create()
    {
        return view('backend.categories.category-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('toast', ['icon' => 'success', 'title' => 'Category is added !!!']);
    }


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.categories.category-edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->name;
        $category->update();

        return redirect()->route('categories.index')->with('toast', ['icon' => 'success', 'title' => 'Category is updated !!!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('toast', ['icon' => 'success', 'title' => 'Category is deleted.!!!']);
    }


    // With Laravel (Change Status)

    public function statusInactive(Request $request, $id){

        $category = Category::find($id);
        $category->status = '0'; // Need to be string
        $category->update();
        return redirect()->route('categories.index');

    }

    
    public function statusActive(Request $request, $id){

        $category = Category::find($id);
        $category->status = '1'; // Need to be string
        $category->update();
        return redirect()->route('categories.index');

    }

    // With Laravel (Change Status) End


    // With Ajax Call
    public function changeStatus(Request $request){

        $category = Category::find($request->user_id);
        $category->status = $request->status;
        $category->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}
