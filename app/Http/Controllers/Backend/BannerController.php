<?php

namespace App\Http\Controllers\Backend;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class BannerController extends Controller
{

    public function index()
    {
        return view('backend.banners.banners');
    }

    public function anyData()
    {
        $banners = Banner::with('admin')->get();

        return Datatables::of($banners)
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

            ->addColumn('action', function ($each) {

                $edit_btn = '<a class="btn btn-warning btn-sm" href="' . route('banners.edit', $each->id) . '"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                $delete_btn = '<form action="' . route('banners.destroy', $each->id) . '" method="POST" style="display:inline-block; margin-left:5px" id="delForm' . $each->id . '">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="_method" value="delete">
            <button type="button" data-id="' . $each->id . '" class="btn btn-danger btn-sm del"><i class="fa fa-trash" aria-hidden="true"> </i></button>
        </form>';

                return $edit_btn . $delete_btn;
            })

            ->editColumn('image', function ($each) {

                $image = '<img src="' . asset('storage/banners/' . $each->image) . '" alt="error" style="width: 80px; height: 50px">';
                return $image;
            })

            ->rawColumns(['created_at', 'image', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('backend.banners.banners-add');
    }


    public function store(BannerRequest $request)
    {
        $banner = new Banner();
        $banner->title = $request->title;
        $banner->content = $request->content;
        $banner->text_style = $request->text_style;
        $banner->link = $request->link;
        $banner->sort_order = $request->sort_order;
        $banner->admin_id = Auth::id();

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $imgName = uniqid() . "_" . $file->getClientOriginalName();
            Storage::putFileAs('/public/banners/', $file, $imgName);

            $banner->image = $imgName;
        }
        $banner->save();
        return redirect()->route('banners.index')->with('toast', ['icon' => 'success', 'title' => 'Banner is added !!!']);
    }

  
    public function show(Banner $banner)
    {
        //
    }

    public function edit(Banner $banner)
    {   
        return view('backend.banners.banners-edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {   


        $request->validate([

            'title' => 'required',
            'content' => 'required',
            'text_style' => 'required',
            'link' => 'required',
            'sort_order' => 'required',
        ]);

        $banner->title = $request->title;
        $banner->content = $request->content;
        $banner->text_style = $request->text_style;
        $banner->link = $request->link;
        $banner->sort_order = $request->sort_order;


            $image = $request->file('image');
            if($image){
                $path = "/public/banners/".$banner->image;
                Storage::delete($path);
           
                    $imgName = uniqid()."_".$image->getClientOriginalName();
                    Storage::putFileAs('/public/banners/', $image, $imgName);
        
                    $banner->image = $imgName;
        }

        $banner->update();

        return redirect()->route('banners.index')->with('toast', [ 'icon' => 'success', 'title' => 'Banner is updated.!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {

        $banner->delete();
        return redirect()->route('products.index')->with('toast', ['icon' => 'success', 'title' => 'Banner is deleted.!!!']);
    }
}
