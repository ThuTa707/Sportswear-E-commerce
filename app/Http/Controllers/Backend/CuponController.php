<?php

namespace App\Http\Controllers\Backend;

use App\Cupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuponController extends Controller
{

    public function index()
    {
        $cupons = Cupon::all();
        return view('backend.cupons.cupon', compact('cupons'));
    }


    public function create()
    {
        return view('backend.cupons.cupon-add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'expire_date' => 'required',
        ]);

        $cupon = new Cupon();
        $cupon->cupon_code = $request->code;
        $cupon->amount = $request->amount;
        $cupon->amount_type = $request->type;
        $cupon->expire_date = $request->expire_date;
        $cupon->save();

        return redirect()->route('cupons.index')->with('toast', ['icon' => 'success', 'title' => 'Cupon is added !!!']);
    }

    public function show(Cupon $cupon)
    {
        //
    }

    public function edit(Cupon $cupon)
    {
        return view('backend.cupons.cupon-edit', compact('cupon'));
    }

    public function update(Request $request, Cupon $cupon)
    {
        $request->validate([
            'code' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'expire_date' => 'required',
        ]);

        $cupon->cupon_code = $request->code;
        $cupon->amount = $request->amount;
        $cupon->amount_type = $request->type;
        $cupon->expire_date = $request->expire_date;
        $cupon->update();

        return redirect()->route('cupons.index')->with('toast', ['icon' => 'success', 'title' => 'Cupon is updated !!!']);
    }

    public function destroy(Cupon $cupon)
    {
        $cupon->delete();
        return redirect()->route('cupons.index')->with('toast', ['icon' => 'success', 'title' => 'Cupon is deleted.!!!']);
    }

    public function changeStatus(Request $request){

        $cupon = Cupon::find($request->user_id);
        $cupon->status = $request->status;
        $cupon->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}
