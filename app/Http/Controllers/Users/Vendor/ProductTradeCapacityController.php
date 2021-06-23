<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductTradeCapacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductTradeCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //tradeCapacity
        $tradeCapacities = ProductTradeCapacity::orderby('created_at','DESC')->get();
        return view('admin.vendor.tradeCapacity.manage',compact('tradeCapacities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.tradeCapacity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ProductTradeCapacity $tradeCapacity)
    {
        $this->validate($request, array(
            'main_markets' => 'required',
            'total_revenue' => 'required',
            'main_product' => 'required',
        ));

        //$productCapacities = new ProductCapacity();

        $admin_id = Auth::guard('admin')->user()->id;
        $tradeCapacity->admin_id = $admin_id;
        $tradeCapacity->main_markets = $request->main_markets;
        $tradeCapacity->total_revenue = $request->total_revenue;
        $tradeCapacity->main_product = $request->main_product;

        if($tradeCapacity->save()){
            Session::flash('success','Product Trade Capacity Inserted Successfully');
            return redirect()->route('tradeCapacity.index');
        } else {
            Session::flash('success','Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTradeCapacity $tradeCapacity)
    {
        return view('admin.vendor.tradeCapacity.edit',compact('tradeCapacity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTradeCapacity $tradeCapacity)
    {
        $this->validate($request, array(
            'main_markets' => 'required',
            'total_revenue' => 'required',
            'main_product' => 'required',
        ));

        $tradeCapacity->main_markets = $request->main_markets;
        $tradeCapacity->total_revenue = $request->total_revenue;
        $tradeCapacity->main_product = $request->main_product;

        if($tradeCapacity->save()){
            Session::flash('success','Product Trade Capacity Updated Successfully');
            return redirect()->route('tradeCapacity.index');
        } else {
            Session::flash('success','Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTradeCapacity $tradeCapacity)
    {
        $tradeCapacity->delete();
        Session::flash('success','Product Trade Capacity Deleted Successfully');
        return redirect()->back();
    }
}
