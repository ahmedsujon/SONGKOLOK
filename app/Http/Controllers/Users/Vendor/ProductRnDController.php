<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductRnD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class ProductRnDController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //productRnD
        $productRnDs = ProductRnD::orderby('created_at','DESC')->get();
        //dd($productCapacity);
        return view('admin.vendor.productRnD.manage',compact('productRnDs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.productRnD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductRnD $productRnD)
    {
        $this->validate($request, array(
            'title' => 'required',
            'description' => 'required',
            'rnd_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        //$productCapacities = new ProductCapacity();

        $admin_id = Auth::guard('admin')->user()->id;
        $productRnD->admin_id = $admin_id;
        $productRnD->title = $request->title;
        $productRnD->description = $request->description;


        if($request->hasFile('rnd_image')){
            $image = request()->file('rnd_image');
            $productRnD->rnd_image= $this->uploadImage($image, 'images');
        };

        if($productRnD->save()){
            Session::flash('success','Product RnD Inserted Successfully');
            return redirect()->route('productRnD.index');
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
    public function edit(ProductRnD $productRnD)
    {
        return view('admin.vendor.productRnD.edit',compact('productRnD'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRnD $productRnD)
    {
        $this->validate($request, array(
            'title' => 'required',
            'description' => 'required',
            'rnd_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        //$productCapacities = new ProductCapacity();

//        $admin_id = Auth::guard('admin')->user()->id;
//        $productRnD->admin_id = $admin_id;
        $productRnD->title = $request->title;
        $productRnD->description = $request->description;

         self::deleteFile( storage_path('app/public/images/' . $productRnD->rnd_image) ) ;

        if($request->hasFile('rnd_image')){
            $image = request()->file('rnd_image');
            $productRnD->rnd_image= $this->uploadImage($image, 'images');
        };

        if($productRnD->save()){
            Session::flash('success','Product RnD Updated Successfully');
            return redirect()->route('productRnD.index');
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
    public function destroy(ProductRnD $productRnD)
    {
        self::deleteFile( storage_path('app/public/images/' . $productRnD->rnd_image) ) ;

        $productRnD->delete();
        Session::flash('info','Product RnD Deleted Successfully');
        return redirect()->back();
    }
}
