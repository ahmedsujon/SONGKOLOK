<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ShowView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class ShowViewController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showViews = ShowView::orderby('created_at','DESC')->get();
        //dd($productCapacity);
        return view('admin.vendor.showView.manage',compact('showViews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.showView.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ShowView $showView)
    {
        $this->validate($request, array(
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        $admin_id = Auth::guard('admin')->user()->id;
        $showView->admin_id = $admin_id;
        $showView->description = $request->description;


        if($request->hasFile('image')){
            $image = request()->file('image');
            $showView->image= $this->uploadImage($image, 'images');
        };

        if($showView->save()){
            Session::flash('success','Data Inserted Successfully');
            return redirect()->route('showView.index');
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
    public function edit(ShowView $showView)
    {
        return view('admin.vendor.showView.edit',compact('showView'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShowView $showView)
    {
        $this->validate($request, array(
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ));

        $showView->description = $request->description;

        self::deleteFile( storage_path('app/public/images/' . $showView->image) );

        if($request->hasFile('image')){
            $image = request()->file('image');
            $showView->image= $this->uploadImage($image, 'images');
        };

        if($showView->save()){
            Session::flash('success','Data Inserted Successfully');
            return redirect()->route('showView.index');
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
    public function destroy(ShowView $showView)
    {
        self::deleteFile( storage_path('app/public/images/' . $showView->image) ) ;

        $showView->delete();
        Session::flash('success','Data Deleted Successfully');
        return redirect()->back();
    }
}
