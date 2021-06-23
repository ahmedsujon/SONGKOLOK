<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\DeleteFile;

class SecondarySubCategoryController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.secondSub.manage', ['subCategories' => SecondarySubCategory::SecondarySubCategoryWithAdminOwner()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.secondSub.create', [
            'categories' => Category::CategoryWithAdminOwner()->get(),
            'sub_categories' => SubCategory::SubCategoryWithAdminOwner()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'secondary_subcategory_name'=> 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);

        $validate['admin_id'] = Auth::guard('admin')->id();
        $validate['secondary_subcategory_slug'] = $this->createSlug(SecondarySubCategory::class, $request->secondary_subcategory_name, "secondary_subcategory_slug");

        if( SecondarySubCategory::create($validate) ) return redirect(route('secondsub.index'))->with('success', 'Second Sub Category created');
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
     * @param SecondarySubCategory $secondsub
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(SecondarySubCategory $secondsub)
    {
        return view('admin.secondSub.edit',[
            'subcategory' => $secondsub,
            'categories' => Category::CategoryWithAdminOwner()->get(),
            'sub_categories' => SubCategory::SubCategoryWithAdminOwner()->get()
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SecondarySubCategory $secondsub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SecondarySubCategory $secondsub)
    {
        $validate = $request->validate([
            'secondary_subcategory_name'=> 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'status' => 'required',
        ]);
//dd($validate);
        return ( $secondsub->update($validate) )?
            redirect()->route('secondsub.index')->with('success', 'Edit Success'):
            redirect()->route('secondsub.index')->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SecondarySubCategory $secondsub
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SecondarySubCategory $secondsub)
    {
        return $secondsub->delete() ?
        redirect()->back()->with('info', 'Second SubCategory Delete Successfully') :
            redirect()->back()->with('error', 'Second SubCategory Delete Unsuccessful') ;
    }


    public function change(Request $request)
    {
        if( self::changeStatus($request->status, 'App\Models\SecondarySubCategory', $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }

    // SecondSubCategory by Product
    public function productBySecondSubCategory(SecondarySubCategory $secondarySubCategory)
    {
        return Product::where('secondary_sub_categories_id', $secondarySubCategory->id)->AdminProduct()->GetActive()->get();
    }
}
