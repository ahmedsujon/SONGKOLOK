<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ExpressWish;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\DeleteFile;

class AdminController extends Controller
{
    use DeleteFile;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $from = date('Y-m-d H:i:s', strtotime('-7 days'));
        $pastMonth = date('Y-m-d H:i:s', strtotime('-30 days'));
        $today = date('Y-m-d H:i:s');
        $allOrders = Order::with('products')
            ->where('shifted', 1)
            ->whereBetween('created_at', [$from, $today])
            ->get();
//dd($allOrders);
        $totalSale = 0;
        foreach ($allOrders as $allOrder){
            $totalSale += $allOrder->quantity * $allOrder->products[0]->product_price;
        }

        $data = [
            'allUsers' => User::where('is_verified', 1)->get(),
            'allVendors' => Admin::all(),
            'totalWeekSale' => $totalSale,
            'usersThisMonth' => User::whereBetween('created_at', [$pastMonth, $today])->where('is_verified', 0)->get()
        ];

        return view('admin.admin', $data);
    }


    public function expressWish()
    {
        $expresswishes = ExpressWish::with(['user','product'])->get();
        //dd($expresswishes);
        return view('admin.expressWish.express',compact('expresswishes'));
    }

    public function destroy(ExpressWish $expressWish)
    {
        $expressWish->delete();
        return redirect()->back();
    }

    public function allVendor(){
        $vendors = Admin::with('orders')->get();
      // dd($vendors);
        return view('admin.vendor.manage',compact('vendors'));
    }

    // Vendor status
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, 'App\Models\Admin', $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }


    public function adminMonthlySellPost(Request $request){
        if ( empty($request->filterDate) ) return redirect()->back();


        $date = explode('-', $request->filterDate);
        $from = date('Y-m-d H:i:s', strtotime($date[0]));
        $to = date('Y-m-d H:i:s', strtotime($date[1]));
//dd($from, $to);
        $orders = OrderProduct::with([
            'order', 'product', 'order.admin', 'product.category', 'product.brand', 'user'
        ])->whereHas('order', function ($query) {
            $query->where([
                'admin_id' => Auth::guard('admin')->id(),
                'shifted' => 1
            ]);
        })
            ->whereBetween('created_at', [$from, $to])
            ->get();

        return view('admin.sellReport', [
            'orders' => $orders
        ]);
    }


    public function adminMonthlySell()
    {
        return view('admin.sellReport');
    }
}
