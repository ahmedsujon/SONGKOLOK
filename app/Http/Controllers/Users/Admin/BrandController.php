<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Helper\DeleteFile;

class BrandController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at','desc')->brandWithAdminOwner()->get();
       return view('admin.brand.manage',compact('brands'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function allBrand()
    {
        $brands = Brand::orderBy('created_at','desc')->brandWithOutAdminOwner()->get();
        return view('admin.brand.manage',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'brand_name' => ['required', 'string', 'max:255'],
            'level' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin_id = Auth::guard('admin')->user()->id;

        $val['admin_id'] = $admin_id;
        $val['brand_slug'] = $this->createSlug(Brand::class, $request->brand_name, "brand_slug");
        $val['brand_name'] = $request->brand_name;
        $val['status'] = $request->status;
        $val['level'] = $request->level;

        if($request->hasFile('brand_image')){
            $image = request()->file('brand_image');
            $val['brand_image'] = $this->uploadImage($image, 'images');
        };

        if( Brand::create($val) ) return redirect()->route('brand.index')->with('success','Brand Inserted Successfully');

        return redirect()->back()->with('error','Something went wrong ');
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
     * @param Brand $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        $brands = $brand;
        return view('admin.brand.edit',compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        $val = $request->validate([
            'brand_name' => 'required|string|max:255',
            'level' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        static::deleteFile(storage_path().'/app/public/images/' . $brand->brand_image);

        $admin_id = Auth::guard('admin')->user()->id;
        $val['admin_id'] = $admin_id;
        $val['brand_name'] = $request->brand_name;
        $val['status'] = $request->status;
        $val['level'] = $request->level;

        if($request->hasFile('brand_image')){
            $image = $request->file('brand_image');
            $val['brand_image'] = $this->uploadImage($image, 'images');
        };

        $brand->update($val);
        return redirect()->route('brand.index')->with('success','Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        static::deleteFile(storage_path().'/app/public/images/' . $brand->brand_image);

        $brand->delete();
        return redirect()->route('brand.index')->with('info','Brand Successfully Deleted');
    }

    public function change(Request $request)
    {
        if( self::changeStatus($request->status, Brand::class, $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }

    // levelChange
    public function levelChange(Request $request)
    {
        $validate = $request->validate([
            'level' => 'required',
        ]);
        //dd($request->all());
        return ( Brand::where('id',$request->id)->update($validate) )?
            redirect()->route('brand.index')->with('success', 'Edit Success'):
            redirect()->route('brand.index')->with('error', 'Something went wrong') ;
    }
}
