<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
    public function index()
    {
        if( empty(Session::get('cart')) ) return redirect()->route('home');
        $shipping_data = ['shipping' => ShippingAddress::where(['user_id' => Auth::user()->id])->first()];
        return view('pages.checkout', $shipping_data);
    }


    public function checkout(Request $request)
    {
        $request->request->remove('_token');
        $request->request->add(['user_id' => Auth::user()->id]);
        $previous = ShippingAddress::where(['user_id' => Auth::user()->id])->first();

        if( $previous == null ) ShippingAddress::create($request->all());
        else ShippingAddress::where(['user_id' => Auth::user()->id])->update($request->all());


        foreach (Session::get('cart') as $cart){
            $order = new Order();
            $pro = Product::find($cart['id']);
            $order->product_id = $cart['id'];
            $order->user_id = Auth::user()->id;
            $order->admin_id = self::getAdminByProduct($cart['id']);;
            $order->unique_id = '#OR' . Str::random(2) . time() . Str::random(2) .'#';
            $order->quantity = $cart['quantity'];
            $order->save();

            $pro->increment('sold', $cart['quantity']);
            $pro->decrement('stock', $cart['quantity']);

            //order_product
            $orderpoduct = new OrderProduct();
            $orderpoduct->order_id = $order['id'];
            $orderpoduct->product_id = $cart['id'];
            $orderpoduct->user_id = Auth::guard('web')->id();

            //dd($orderpoducts);
            $orderpoduct->save();
            $pro->save();
            $order = null;
            $pro = null;
        }
        Session::forget('cart');

        return redirect()->route('checkout.confirm')->with('success','Your Order Confirmed Successfully');

    }


    public function checkoutConfirm()
    {
        return view('pages.checkout_confirm');
    }


    private static function getAdminByProduct($product_id){
        return Product::where(['id'=> $product_id])
            ->select('admin_id')->first()->admin_id;
    }

}
