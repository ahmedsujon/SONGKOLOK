<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\FactoryView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class FactoryViewController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factoryViews = FactoryView::orderby('created_at','DESC')->get();
        //dd($productCapacity);
        return view('admin.vendor.factoryView.manage',compact('factoryViews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.factoryView.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FactoryView $factoryView)
    {
        $this->validate($request, array(
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        $admin_id = Auth::guard('admin')->user()->id;
        $factoryView->admin_id = $admin_id;
        $factoryView->description = $request->description;


        if($request->hasFile('image')){
            $image = request()->file('image');
            $factoryView->image= $this->uploadImage($image, 'images');
            $factoryView->save();
        };

        if($factoryView->save()){
            Session::flash('success','Data Inserted Successfully');
            return redirect()->route('factoryView.index');
        } else {
            Session::flash('success','Something went wrong');
            return redirect()->back();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FactoryView $factoryView)
    {
        return view('admin.vendor.factoryView.edit',compact('factoryView'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactoryView $factoryView)
    {
        $this->validate($request, array(
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        $factoryView->description = $request->description;

        self::deleteFile( storage_path('app/public/images/' . $factoryView->image) ) ;

        if($request->hasFile('image')){
            $image = request()->file('image');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            request()->image->move(public_path('images'), $filename);
            $factoryView->image= $this->uploadImage($image, 'images');
            $factoryView->save();
        };

        if($factoryView->save()){
            Session::flash('success','Data Inserted Successfully');
            return redirect()->route('factoryView.index');
        } else {
            Session::flash('success','Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FactoryView $factoryView)
    {
        self::deleteFile( storage_path('app/public/images/' . $factoryView->image) );

        $factoryView->delete();
        Session::flash('success','Data Deleted Successfully');
        return redirect()->back();
    }
}
