<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class SubCategoryController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->SubCategoryWithAdminOwner()->get();

        return view('admin.subcategory.manage',compact('subCategories'));

    }

    // All vendor
    public function allSubCategory()
    {
        $subCategories = SubCategory::with('category')->SubCategoryWithOutAdminOwner()->get();

        return view('admin.subcategory.manage',compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::CategoryWithAdminOwner()->get();

        return view('admin.subcategory.create',compact('categories'));
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
            'subcategory_name' => 'required',
            'category_name' => 'required',
            'sub_category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $SubCategory = new SubCategory();
        $SubCategory->subcategory_name = $request->subcategory_name;
        $SubCategory->subcategory_slug = $this->createSlug(SubCategory::class, $request->subcategory_name, "subcategory_slug");
        $SubCategory->category_id = $request->category_name;
        $SubCategory->status = $request->status;
        $SubCategory->admin_id = Auth::guard('admin')->user()->id;


        if($request->hasFile('sub_category_image')){
            $image = request()->file('sub_category_image');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            request()->sub_category_image->move(public_path('images'), $filename);
            $SubCategory->sub_category_image = $this->uploadImage($image, 'images');
            $SubCategory->save();
        };

        if($SubCategory->save()){
            return redirect()->route('subcategory.index')->with('success','Sub Category Inserted Successfully');
        } else {
            return redirect()->back()->with('error','Something went wrong');
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
     * @param SubCategory $subcategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::CategoryWithAdminOwner()->get();
        return view('admin.subcategory.edit',compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SubCategory $subcategory
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $this->validate($request, array(
            'subcategory_name' => 'required',
            'category_name' => 'required',
        ));

        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_name;
        $subcategory->status = $request->status;

        self::deleteFile( storage_path().'/app/public/images/'  . $subcategory->sub_category_image);
//            return redirect()->back()->with('error','Something went wrong');

        if($request->hasFile('sub_category_image')){
            $image = request()->file('sub_category_image');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            request()->sub_category_image->move(public_path('images'), $filename);
            $subcategory->sub_category_image= $this->uploadImage($image, 'images');
            $subcategory->save();
        };

        if($subcategory->save()){
            return redirect()->route('subcategory.index')->with('success','Sub Category Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubCategory $subcategory
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SubCategory $subcategory)
    {
        //dd($subcategory);
        self::deleteFile( storage_path().'/app/public/images/' . $subcategory->sub_category_image );

        $subcategory->delete();
        return redirect()->back()->with('info', 'Sub Category Delete Successfully');
    }

    // Change Status
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, SubCategory::class, $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }


    public function secondarySubBySubCategory(SubCategory $subcategory)
    {
        return SecondarySubCategory::where('sub_category_id', $subcategory->id)->SecondarySubCategoryWithAdminOwner()->get();
    }
}
