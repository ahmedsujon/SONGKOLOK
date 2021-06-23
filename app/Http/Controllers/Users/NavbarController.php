<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Division;
use App\Models\Order;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavbarController extends Controller
{
    public function store(Request $request)
    {
        if ($request->product_name != null ){
            $product = Product::with(['productImages', 'productVideos'])
                ->where('product_name', 'LIKE','%'.$request->product_name.'%')
                ->where('product_slug', 'LIKE','%'.$request->product_name.'%')
                ->GetActive()
                ->get();

            if ( count($product) > 0 )
            $mainRes = Category::with('products')
                ->where('id', $product[0]->category_id)
                ->first();
            else $mainRes = [];
            $area = Division::with('districts.cities')->get();

            return view('pages.searchResultWeb',['results' => $mainRes,'products' =>$product, 'areas'=> $area]);
        } else {
            $category = SubCategory::with(['category','productWithStatus'])->where('category_id',$request->category_name)->GetActive()->paginate(20);

            return view('pages.categories',['categories' =>$category]);
        }
    }


    //subcategory
    public function show($slug)
    {
        $category = SubCategory::where('subcategory_slug',$slug)->GetActive()->first();

        $product = Product::where([
            ['sub_categories_id' , '=', $category->id],
            ['status', '=', 1],
        ])->paginate(16);

        $mainRes = Product::where([
            'category_id' => $category->category->id,
            'status' => 1
        ]);

        return view('pages.one_category',['results' => $mainRes,'categories' =>$category,'products' => $product]);
    }

    // 2nd subcategory
    public function secondary_subcategory($slug)
    {
        $category = SecondarySubCategory::where('secondary_subcategory_slug',$slug)->GetActive()->first();
        $product = Product::where([
            ['secondary_sub_categories_id' , '=', $category->id],
            ['status', '=', 1],
        ])->paginate(16);

        $mainRes = Product::where([
            'category_id' => $category->category->id,
            'status' => 1
        ]);

        return view('pages.one_category',['results' => $mainRes,'categories' =>$category,'products' => $product]);
    }

    // BrandProducts
    public function brandProduct($slug)
    {

        $brand = Brand::where('brand_slug',$slug)->GetActive()->first();
        $product = Product::where([
            ['brand_id' , '=', $brand->id],
            ['status', '=', 1],
        ])->paginate(16);

        //dd($product);

        return view('pages.brand_products',['brands' =>$brand,'products' => $product]);
    }

    public  function profile(){

        //dd(Auth::user()->id);
        $users = User::where('id',Auth::user()->id)->get();
        $orders = Order::with('products')->where(['user_id' => Auth::user()->id])->get();
        $userPBlogs = Blog::where('user_id', Auth::user()->id) ->get();

        //dd($orders);
        return view('pages.user_profile',compact('users','orders','userPBlogs'));
    }

    public function profileEdit(User $user)
    {
        //dd($user);
        return view('pages.profile_update',compact('user'));
    }

    public function profileUpdate(Request $request,User $user)
    {
        $validate = $request->validate([
            'fname'=> 'sometimes',
            'lname' => 'sometimes',
            'phone' => 'sometimes',
            'email' => 'sometimes',
        ]);
        return ( $user->update($validate) )?
            redirect()->route('profile.show')->with('success', 'Your Information Updated Successfully'):
            redirect()->route('profile.edit')->with('error', 'Something went wrong') ;
    }

    public function orderCancel(Order $order)
    {
        Product::where('id', $order->product_id)->decrement('sold', $order->quantity);
        Product::where('id', $order->product_id)->increment('stock', $order->quantity);
        $order->delete();
        return redirect()->back();
    }

}
