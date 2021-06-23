<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;
use App\Helper\DeleteFile;

class ProductImageController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $productImages = Product::with('productImages')->AdminProduct()->get();
        return view('admin.productImage.manage',compact('productImages'));
    }


    public function allProductImages()
    {
        $productImages = Product::with('productImages')->WithoutAdminProduct()->get();

        return view('admin.productImage.manage',compact('productImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::AdminProduct()->get();

        return view('admin.productImage.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'product_name' => 'required',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        if($request->hasFile('product_image')){
            $files = $request->file('product_image');
            foreach ($files as $file){
                $productImages = new ProductImage();
                $productImages->product_id = $request->product_name;
                $productImages->admin_id = Auth::guard('admin')->user()->id;
                $productImages->product_image= $this->uploadImage($file, 'images');
                $productImages->save();
                $productImages = null;
            }
        }

        return redirect()->route('productImage.index')->with('success','Product Images Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param ProductImage $productImage
     * @return void
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductImage $productImage
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $productImage = Product::with('productImages')->find($id);
        $products = Product::AdminProduct()->get();
        return view('admin.productImage.edit',compact('productImage', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProductImage $productImage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        foreach ($request->product_image_id as $ind => $product_image_id){
            if($request->hasFile('product_image.'.$ind)){
                $file = $request->file('product_image.'.$ind);
                $proImg = ProductImage::find($product_image_id);
                static::deleteFile(storage_path().'/app/public/images/' . $proImg->product_image);
                $proImg->update(['product_image' => $this->uploadImage($file, 'images')]);
            }
        }


        return redirect()->route('productImage.index')->with('success','Product Images Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductImage $productImage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $images = ProductImage::where([
            'product_id'=> $id,
            'admin_id'=> Auth::guard('admin')->user()->id,
        ])->get();

        foreach ($images as $image)
            self::deleteFile(storage_path().'/app/public/images/' . $image->product_image);

        ProductImage::where([
            'product_id'=> $id,
            'admin_id'=> Auth::guard('admin')->user()->id,
        ])->delete();

        return redirect()->back()->with('info','Deleted Successfully..');
    }
}
