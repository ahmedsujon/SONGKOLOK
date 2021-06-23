<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductFactoryInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class ProductFactoryInspectionController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factoryInspections = ProductFactoryInspection::orderby('created_at','DESC')->get();
        return view('admin.vendor.factoryInspection.manage',compact('factoryInspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.factoryInspection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductFactoryInspection $factoryInspection)
    {
        $this->validate($request, array(
            'title' => 'required',
//            'pdf' => 'required|mimes:pdf,docx,txt,xlx,xls,csv|max:2048',
        ));

        $admin_id = Auth::guard('admin')->user()->id;
        $factoryInspection->admin_id = $admin_id;
        $factoryInspection->title = $request->title;

        if($request->hasFile('pdf')){
            $pdf = request()->file('pdf');
            $factoryInspection->pdf= $this->uploadImage($pdf, 'documents');
        };

        if($factoryInspection->save()){
            Session::flash('success','Product Factory Inspection Reports Inserted Successfully');
            return redirect()->route('factoryInspection.index');
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
    public function edit(ProductFactoryInspection $factoryInspection)
    {
        return view('admin.vendor.factoryInspection.edit',compact('factoryInspection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFactoryInspection $factoryInspection)
    {
        $this->validate($request, array(
            'title' => 'required',
//            'pdf' => 'required|mimes:pdf,docx,txt,xlx,xls,csv|max:2048',
        ));

        $factoryInspection->title = $request->title;

        self::deleteFile( storage_path('app/public/documents/' . $factoryInspection->pdf) ) ;

        if($request->hasFile('pdf')){
            $pdf = request()->file('pdf');
            $factoryInspection->pdf= $this->uploadImage($pdf, 'documents');
        };

        if($factoryInspection->save()){
            Session::flash('success','Product Factory Inspection Reports Updated Successfully');
            return redirect()->route('factoryInspection.index');
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
    public function destroy(ProductFactoryInspection $factoryInspection)
    {
        self::deleteFile( storage_path('app/public/documents/' . $factoryInspection->pdf) ) ;

        $factoryInspection->delete();
        Session::flash('info','Product Factory Inspection Reports Deleted Successfully');
        return redirect()->back();
    }
}
