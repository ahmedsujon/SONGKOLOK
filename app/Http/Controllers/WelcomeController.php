<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategorySlider;
use App\Models\City;
use App\Models\ContactUsSlider;
use App\Models\District;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventProduct;
use App\Models\ExpressWish;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\SubCity;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(){

        // Category wise Product
        $mainRes = Category::with('products')->where('featured', 1)->GetActive()->get();

        //Category Query
        $category = Category::orderBy('category_name','asc')->GetActive()->get();

        //BestSell from Product
        $product = Product::orderBy('sold','desc')->GetActive()->limit(10)->get();

        $sliders = ContactUsSlider::GetActive()->where('for', 1)->get();


        return view('welcome',['results' => $mainRes,'categories' => $category, 'products' =>$product, 'sliders' => $sliders ]);
    }

    public function show($slug)
    {
        $product = Product::with(['productImages', 'productVideos','admin', 'category', 'subcategory', 'brand', 'secondsub', 'coupon'])->where('product_slug', $slug)->GetActive()->get();
        $mainRes = Category::with('products')
            ->where('id', $product[0]->category_id)
            ->first();
        $area = Division::with('districts.cities')->get();
//dd($mainRes);
        return view('pages.product-details',['results' => $mainRes,'products' =>$product, 'areas' => $area]);

    }

    // Show Category
    public function category($slug){
        $id = Category::where('category_slug', $slug)->first()->id;
        $category = SubCategory::with(['category','productWithStatus'])->where('category_id',$id)->GetActive()->paginate(20);
        $slider = CategorySlider::where('category_id', $id)->GetActive()->get();
        //dd($categorySliders);
        return view('pages.categories',['categories' =>$category,'sliders' =>$slider]);
    }

    public function changeLocation($region, $id){
        if ( $region == "division" ) return District::where('division_id', $id)->get();
        elseif ($region == "district") return City::where('district_id', $id)->get();
        elseif ($region == "city") return SubCity::where('city_id', $id)->get();
        return Division::all();
    }


    public function addWishList($id)
    {
        $data['product_id'] = $id;
        $data['user_id'] = Auth::user()->id;

        $check = WishList::where([
            'product_id'=> $id,
            'user_id'=> $data['user_id']
        ])->first();

        if( empty($check) ){
            return ( WishList::create($data) ) ? response([
                'message' => 'Wishlist Created'
            ], 200) : response([
                'message' => 'Something went wrong'
            ], 404);
        }

        return  response([
            'message' => 'Wishlist Created'
        ]);
    }

    public function userWishList()
    {
        $data = [
            'wishLists' => WishList::where('user_id', Auth::id())->with('product')->get()
        ];

        return view('pages.wishlist', $data);
    }


    public function deleteWishList(WishList $wishList)
    {
        $wishList->delete();
        return redirect()->back();
    }


    public function  addExpressList($id){
        $data['product_id'] = $id;
        if (Auth::check()) $data['user_id'] = Auth::user()->id;

        $check = ExpressWish::where('product_id', $id)->first();

        if( empty($check) ){
            return ( ExpressWish::create($data) ) ? response([
                'message' => 'Express wish taken'
            ], 200) : response([
                'message' => 'Something went wrong'
            ], 404);
        }

        return response([
            'message' => 'Express wish taken'
        ], 200);
    }

    //  promotion
    public function promotion(){

        $count_date = date('Y-m-d H:i:s', time()+6*3600);
        $event = Event::where( 'start_date','>=', $count_date)->orderby('start_date','asc')->GetActive()->first();
//        dd($event);
        $eventProducts = [];
        $eventPro = Event::with('eventProducts')
            ->where( 'start_date','<=', $count_date)
            ->where( 'end_date','>', $count_date)
            ->GetActive()
            ->get();
         //dd($eventPro);


        if (count($eventPro) > 0){

            $eventProducts =EventProduct::with('category')
                ->where([
                    'event_id' => $eventPro[0]->id
                ])
                ->select('category_id','event_id')->distinct()->paginate(20);
        }

        //dd($eventProducts);
        return view('pages.promotion',compact('event','eventProducts'));

    }

    // promotion products
    public function promotionProduct($event_id,$category_id){
        $event = Event::where( 'id',$event_id)->GetActive()->get();
        $category = Category::where( 'id', $category_id)->GetActive()->get();
        $products =EventProduct::with('products')
            ->where([
                'event_id' => $event_id,
                'category_id' => $category_id
            ])
            ->get();

        return view('pages.promotion_products',compact('products','category','event'));
    }

}
