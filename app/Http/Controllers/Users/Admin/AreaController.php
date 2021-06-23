<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::with('product')->AdminArea()->get();
       // dd($areas);
        return view('admin.area.manage',compact('areas'));
    }

    public function allArea()
    {
        $areas = Area::with('product')->WithoutAdminArea()->get();

        return view('admin.area.manage',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::AdminProduct()->get();
       // dd($products);

        return view('admin.area.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'area_name' => 'required',
            'price' => 'required',
        ]);

        $validate['admin_id'] = Auth::guard('admin')->id();

        if( Area::create($validate) ) return redirect(route('area.index'))->with('success', 'Delivery Area Category created');
        return redirect()->back()->with('error', 'Something went wrong, please try again');
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
    public function edit(Area $area)
    {
        $products = Product::AdminProduct()->get();
        return view('admin.area.edit',compact('area', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $validate = $request->validate([
            'product_id'=> 'required',
            'area_name' => 'required',
            'price' => 'required',
        ]);

        return ( $area->update($validate) )?
            redirect()->route('area.index')->with('success', 'Updated Successfully'):
            redirect()->route('area.index')->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        return $area->delete() ?
            redirect()->back()->with('info', 'Area Delete Successfully') :
            redirect()->back()->with('error', 'Area Delete Unsuccessful') ;
    }
}
