<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Auth;
use App\Helper\DeleteFile;

class CategoryController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $categorys = Category::orderBy('category_name','asc')->CategoryWithAdminOwner()->get();

        return view('admin.category.manage',compact('categorys'));
    }


    public function allCategory()
    {
        $categorys = Category::orderBy('category_name','asc')->CategoryWithOutAdminOwner()->get();

        return view('admin.category.manage',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_name' => ['required', 'string', 'max:255'],
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $categories = new Category();

        $admin_id = Auth::guard('admin')->user()->id;
        $categories->admin_id = $admin_id;
        $categories->category_slug = $this->createSlug(Category::class, $request->category_name, "category_slug");
        $categories->category_name = $request->category_name;
        $categories->status = $request->status;
        $categories->featured = $request->featured;

        if($request->hasFile('category_image')){
            $image = request()->file('category_image');
            $categories->category_image= $this->uploadImage($image, 'images');
            $categories->save();
        };

        if($categories->save()){
            return redirect()->route('category.index')->with('success','Category Inserted Successfully');
        } else {
            return redirect()->back()->with('success','Something went wrong');
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
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, array(
            'category_name' => ['required', 'string', 'max:255'],
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->featured = $request->featured;

         self::deleteFile( storage_path().'/app/public/images/' . $category->category_image ) ;

        if($request->hasFile('category_image')){
            $image = request()->file('category_image');
            $category->category_image= $this->uploadImage($image, 'images');
            $category->save();
        };

        if($category->save()){
            return redirect()->route('category.index')->with('success','Category Updated Successfully');
        } else {
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        self::deleteFile( storage_path().'/app/public/images/' . $category->category_image ) ;

        $category->delete();
        return redirect()->route('category.index')->with('info','Category Deleted Successfully');
    }

    // Change Status
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, 'App\Models\Category', $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }


    public function subCategoryByCategory(Category $category)
    {
        return SubCategory::where('category_id', $category->id)->SubCategoryWithAdminOwner()->get();
    }

//    public function productByCategory(Category $category)
//    {
//        return Product::where('category_id', $category->id)->AdminProduct()->GetActive()->get();
//    }
}
