<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductQuality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class ProductQualityController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productQualities = ProductQuality::orderby('created_at','DESC')->get();
        //dd($productCapacity);
        return view('admin.vendor.productQuality.manage',compact('productQualities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.productQuality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductQuality $productQuality)
    {
        $this->validate($request, array(
            'title' => 'required',
            'description' => 'required',
            'quality_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        //$productCapacities = new ProductCapacity();

        $admin_id = Auth::guard('admin')->user()->id;
        $productQuality->admin_id = $admin_id;
        $productQuality->title = $request->title;
        $productQuality->description = $request->description;


        if($request->hasFile('quality_image')){
            $image = request()->file('quality_image');
            $productQuality->quality_image= $this->uploadImage($image, 'images');
        }

        if($productQuality->save()){
            Session::flash('success','Product Quality Inserted Successfully');
            return redirect()->route('productQuality.index');
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
    public function edit(ProductQuality $productQuality)
    {
        return view('admin.vendor.productQuality.edit',compact('productQuality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProductQuality $productQuality
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ProductQuality $productQuality)
    {
        $this->validate($request, array(
            'title' => 'required',
            'description' => 'required',
            'quality_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $productQuality->title = $request->title;
        $productQuality->description = $request->description;

        self::deleteFile( storage_path('app/public/images/' . $productQuality->quality_image) ) ;

        if($request->hasFile('quality_image')){
            $image = request()->file('quality_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            request()->quality_image->move(public_path('images'), $filename);
            $productQuality->quality_image= $filename;
        };

        if($productQuality->save()){
            Session::flash('success','Product Quality Updated Successfully');
            return redirect()->route('productQuality.index');
        } else {
            Session::flash('success','Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductQuality $productQuality
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ProductQuality $productQuality)
    {
         self::deleteFile( storage_path('app/public/images/' . $productQuality->quality_image) );

        $productQuality->delete();
        Session::flash('success','Product Quality Deleted Successfully');
        return redirect()->back();

    }
}
