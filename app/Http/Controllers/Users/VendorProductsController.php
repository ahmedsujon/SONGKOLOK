<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ContactUsSlider;
use App\Models\FactoryView;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductRnD;
use App\Models\ShowView;
use Illuminate\Http\Request;
use App\Models\ProductCertification;
use App\Models\ProductQuality;
use App\Models\ProductTradeCapacity;

class VendorProductsController extends Controller
{
    public function topSale($id)
    {
        $productSales = Admin::with('productsWithSold')->where('id', $id)->get();
       // dd($productSales);
        $productTops = Admin::with('productsWithTop')->where('id', $id)->get();

        $showViews = ShowView::where('admin_id', $id)->get();
        $factoryViews = FactoryView::where('admin_id', $id)->get();
        $sliders = ContactUsSlider::GetActive()->where('admin_id', $id)->get();

        //dd($showViews);
        return view('pages.vendor_home',compact('productSales','productTops','showViews','factoryViews','sliders'));
    }

    public function overview($id)
    {
        $sliders = ContactUsSlider::GetActive()->where('admin_id', $id)->get();
        $factoryViews = FactoryView::where('admin_id', $id)->get();
        $ProductTradeCapacity = ProductTradeCapacity::where('admin_id', $id)->orderBy('id','desc')->get();
        $ProductQualitys = ProductQuality::where('admin_id', $id)->orderBy('id','desc')->get();
        $productcertifications = ProductCertification::where('admin_id', $id)->orderBy('id','desc')->get();
        $productTops = Admin::with('productsWithTop')->where('id', $id)->get();
        $capacities = ProductCapacity::where('admin_id', $id)->orderBy('id','desc')->get();
        $productrnd = ProductRnD::where('admin_id', $id)->orderBy('id','desc')->get();
        return view('pages.shop',compact(
            'productcertifications',
            'ProductQualitys',
            'ProductTradeCapacity',
            'productTops',
            'capacities',
            'productrnd',
            'factoryViews',
            'sliders'
        ));
    }

    // All Vendor Show
    public function allVendor()
    {
        $factoryViews = FactoryView::orderBy('id','desc')->distinct('admin_id')->paginate(16);
        return view('pages.vandor',compact('factoryViews'));
    }
}
