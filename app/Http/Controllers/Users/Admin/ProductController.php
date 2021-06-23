<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Emi;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use Illuminate\Support\Str;
use App\Helper\DeleteFile;

class ProductController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('brand')->adminProduct()->get();

        return view('admin.product.manage',compact('products'));
    }

    public function allProduct()
    {
        $products = Product::with('brand')->withoutAdminProduct()->get();
//dd($products);
        return view('admin.product.manage',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $brands = Brand::orderBy('brand_name','asc')->BrandWithAdminOwner()->get();
        $categories = Category::CategoryWithAdminOwner()->get();
        $coupons = Coupon::CouponWithAdminOwner()->get();
        $emis = Emi::withAdminOwner()->get();

        return view('admin.product.create',compact('brands','emis', 'coupons', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validation($request);

        $products = new Product();

        $admin_id = Auth::guard('admin')->user()->id;

        $products->admin_id = $admin_id;
        $products->unique_id = Str::random(9);
        $products->category_id = $request->product_category;
        $products->coupon_id = $request->product_coupon;
        $products->product_slug = $this->createSlug(Product::class, $request->product_name, "product_slug");
        $products->product_name = $request->product_name;
        $products->specification = $request->product_specification;
        $products->product_description = $request->product_description;
        //$products->product_description = $request->product_description[1];
        $products->color = $request->product_color;
        $products->model = $request->product_model;
        $products->tax = $request->product_tax;
        $products->product_price = $request->product_price;
        $products->size = $request->product_size;
        $products->stock = $request->product_stock;
        $products->brand_id = $request->product_brand;
        $products->sub_categories_id = $request->product_sub_category;
        $products->manufactured_by = $request->manufactured_by;
        $products->is_new = $request->is_new;
        $products->secondary_sub_categories_id = $request->secondary_sub_categories_id;
        $products->status = $request->status;
        if( ! empty($request->emi_id) )
            $products->emi_id = implode(',', $request->emi_id);


        if($request->hasFile('feature_image')){
            $image = request()->file('feature_image');
            $products->feature_image = $this->uploadImage($image, 'images');

            if( $products->save() ) return redirect()->route('product.update.menual.get', $products->id)->with('success','Product Inserted Successfully');
        } else {
            if( $products->save() ) return redirect()->route('product.update.menual.get', $products->id)->with('success','Product Inserted Successfully');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    public function createSprcification()
    {

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
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        //dd($product->sub_categories_id);
        $brands = Brand::orderBy('brand_name','asc')->BrandWithAdminOwner()->get();
        $subcategory = SubCategory::where('category_id',$product->category_id)->SubCategoryWithAdminOwner()->get();
        $categories = Category::CategoryWithAdminOwner()->get();
        $coupons = Coupon::CouponWithAdminOwner()->get();
        $secondary_sub = SecondarySubCategory::where('sub_category_id',$product->sub_categories_id)->SecondarySubCategoryWithAdminOwner()->get();
       // dd($secondary_sub);
        $emis = Emi::withAdminOwner()->get();

        return view('admin.product.edit',compact('emis','product','brands', 'coupons','subcategory', 'categories', 'secondary_sub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        //dd($request->all());
        //$this->validation($request);

        //$products = Product::find($id);

        $product->product_name = $request->product_name;
//        $product->specification = $request->product_specification;
        $product->product_description = $request->product_description;
        $product->color = $request->product_color;
        $product->model = $request->product_model;
        $product->coupon_id = $request->product_coupon;
        $product->tax = ( ! empty($request->product_tax) ) ? $request->product_tax : 0;
        $product->sub_categories_id = $request->product_sub_category;
        $product->product_price = $request->product_price;
        $product->size = $request->product_size;
        $product->stock = $request->product_stock;
        $product->brand_id = $request->product_brand;
        $product->sub_categories_id = $request->product_sub_category;
        $product->manufactured_by = $request->manufactured_by;
        $product->is_new = $request->is_new;
        $product->status = $request->status;

        if( ! empty($product->emi_id) )
            $product->emi_id = implode(',', $request->emi_id);
        //if( isset($request->secondary_sub_categories_id) )
        $product->secondary_sub_categories_id = $request->secondary_sub_categories_id;

        static::deleteFile(storage_path().'/app/public/images/' . $product->feature_image);

        if($request->hasFile('feature_image')){
            $image = request()->file('feature_image');
            $product->feature_image= $this->uploadImage($image, 'images');

            if ( $product->save() ) return redirect()->route('product.index')->with('success','Product Updated Successfully');
        } else {
            if ( $product->save() ) return redirect()->route('product.index')->with('success','Product Updated Successfully');
            else return redirect()->back()->with('error','Something went wrong');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    public function specificationForm(Product $product)
    {
        return view('admin.product.product_description', compact('product'));
    }

    public function updateMenual(Request $request, Product $product){
        $product->specification = $request->product_specification;

        if( $product->save() )
        return redirect()->route('product.index')->with('success','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        static::deleteFile(storage_path().'/app/public/images/' . $product->feature_image);

        $product->delete();
        return redirect()->back()->with('info','Product Deleted Successfully');
    }


    public function change(Request $request)
    {
        if( self::changeStatus($request->status, 'App\Models\Product', $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }


    public function specification(Request $request, Product $product){
        $product->specification = $request->product_specification;


        return ($product->save())? redirect()->route('product.index')->with('success', 'specification added') : redirect()->back()->with('error', 'Something went wrong');
    }


    private function validation($request){
        $this->validate($request, array(
            'product_name' => ['required', 'string', 'max:255'],
            'product_description' => 'sometimes',
            'product_specification' => 'sometimes',
            'product_tax' => 'sometimes',
            'product_price' => 'required',
            'product_color' => 'sometimes',
            'product_model' => 'sometimes',
            'product_size' => 'sometimes',
            'product_stock' => 'required',
            'secondary_sub_categories_id' => 'sometimes',
            'product_coupon' => 'sometimes',
            'manufactured_by' => 'sometimes',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));
    }
}
