<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventProduct;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $eventProducts = Event::EventWithAdminOwner()->GetActive()->get();

        return view('admin.eventProduct.manage',compact('eventProducts'));
    }

    public function allEventProduct()
    {
        $eventProducts = Event::EventWithOutAdminOwner()->GetActive()->get();
        //dd($eventProducts);
        return view('admin.eventProduct.manage',compact('eventProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //$products = Product::AdminProduct()->GetActive()->get();
        $events = Event::EventWithAdminOwner()->GetActive()->get();
        $categories = Category::CategoryWithAdminOwner()->get();

        return view('admin.eventProduct.create',compact('events', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        return ($this->createEvent($request)) ? redirect(route('eventproduct.index'))->with('success', ' Event created') :
            redirect()->back()->with('error', ' Something Went wrong');
    }


    private function createEvent(Request $request){
        $validate = $request->validate([
            'category_id'=> 'required',
            'sub_categories_id'=> 'required',
            'secondary_sub_categories_id'=> 'required',
            'product_id'=> 'required',
            'discount'=> 'sometimes',
            'event_id'=> 'required',
        ]);

        foreach ($request->product_id as $id){
            $event = EventProduct::create([
                'admin_id' => Auth::guard('admin')->id(),
                'category_id' => $request->category_id,
                'sub_categories_id' => $request->sub_categories_id,
                'secondary_sub_categories_id' => $request->secondary_sub_categories_id,
                'discount' => $request->discount,
                'event_id' => $request->event_id,
                'product_id' => $id,
            ]);

            if( empty($event->id) ) return false;
        }

        return true;
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
     * @param $eventProduct
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($eventProduct)
    {
        $eventProduct = EventProduct::find($eventProduct);
        $products = Product::where('secondary_sub_categories_id',$eventProduct->secondary_sub_categories_id)->AdminProduct()->GetActive()->get();
        $events = Event::EventWithAdminOwner()->GetActive()->get();
        $categories = Category::CategoryWithAdminOwner()->get();
       // $eventProductAll = EventProduct::where('event_id', $eventProduct)->get();


        $subcategory = SubCategory::where('category_id',$eventProduct->category_id)->SubCategoryWithAdminOwner()->get();
        $secondary_sub = SecondarySubCategory::where('sub_category_id',$eventProduct->sub_categories_id)->SecondarySubCategoryWithAdminOwner()->get();

       $productsID = [];
       $categoriesID = null;
//
//        foreach ($eventProductAll as $value){
//            array_push($productsID, $value->product_id);
//            $categoriesID = $value->category_id;
//        }

        return view('admin.eventProduct.edit',
            compact(
                'categoriesID',
                'productsID','products','eventProduct','categories', 'products','events','subcategory','secondary_sub'
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $eventProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $eventProduct)
    {
        EventProduct::where('id', $eventProduct)->delete();

        return ( $this->createEvent($request) )?
            redirect()->route('eventproduct.index')->with('success', 'Updated Successfully'):
            redirect()->back()->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventProduct $eventProduct
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(EventProduct $eventproduct)
    {
        return $eventproduct->delete() ?
            redirect()->back()->with('info', ' Delete Successfully') :
            redirect()->back()->with('error', 'Delete Unsuccessful') ;
    }


    public function allEventProducts($id)
    {
        $eventProduct = Event::with(['eventProducts.products.category', 'eventProducts.products.subcategory', 'eventProducts.products.brand', 'eventProducts.products.secondsub'])
            ->where('id', $id)->get()->toArray();

        $tableData = null;

        foreach ($eventProduct as $event_products){
            foreach ($event_products['event_products'] as $products){
                if( $products['products'] != null ){
                    $tableData .= '<tr role="row"><td class="text-center">' . $products['products']['product_name'] . "</td>";
                    $tableData .= '<td class="text-center"> <img width="80" src="' . assetImageAndVideo('images') . $products['products']['feature_image'] . '" /></td>';
                    $tableData .= '<td class="text-center">' . $products['products']['stock'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['products']['product_price'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['products']['category']['category_name'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['products']['subcategory']['subcategory_name'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['products']['secondsub']['secondary_subcategory_name'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['products']['brand']['brand_name'] . '</td>';
                    $tableData .= '<td class="text-center">' . $products['discount']. '</td>';
                    $tableData .= '<td class="text-center"> <a href="'.route('eventproduct.edit',$products["id"]).'"
                                                                   class="btn btn-app">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                                <form
                                                                    action="'.route('eventproduct.destroy',$products["id"]).'"
                                                                    method="post">
                                                                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                                                                    <input type="hidden" value="DELETE"  name="_method">
                                                                    <button type="submit" class="btn btn-app text-danger"><i class="fa fa-trash fa-2x"></i> </button>
                                                                </form>
                                                                 </td></tr>';
                }
                //dd($products["id"]);
            }
        }
        return $tableData;
    }
}
