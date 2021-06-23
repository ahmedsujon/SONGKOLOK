<?php

namespace App\Http\Controllers\Users\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class ProductCertificationController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCertifications = ProductCertification::orderby('created_at','DESC')->get();
        return view('admin.vendor.productCertification.manage',compact('productCertifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.productCertification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ProductCertification $productCertification)
    {
        $this->validate($request, array(
            'name' => 'required',
            'issued_by' => 'required',
            'business_scope' => 'required',
            // 'image' => 'pdf,csv,txt,docs',
        ));

        //$productCapacities = new ProductCapacity();

        $admin_id = Auth::guard('admin')->user()->id;
        $productCertification->admin_id = $admin_id;
        $productCertification->name = $request->name;
        $productCertification->issued_by = $request->issued_by;
        $productCertification->business_scope = $request->business_scope;

        if($request->hasFile('pdf')){
            $pdfs = request()->file('pdf');
//            $filename = time() . '.' . $pdfs->getClientOriginalExtension();
//            request()->pdf->move(public_path('documents'), $filename);
            $productCertification->pdf= $this->uploadImage($pdfs, 'documents');
        }


        if($productCertification->save()){
            return redirect()->route('productCertification.index')->with('success','Product Certification Inserted Successfully');
        } else {
            return redirect()->back()->with('success','Something went wrong');
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
    public function edit(ProductCertification $productCertification)
    {
        return view('admin.vendor.productCertification.edit',compact('productCertification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProductCertification $productCertification
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ProductCertification $productCertification)
    {
        $this->validate($request, array(
            'name' => 'required',
            'issued_by' => 'required',
            'business_scope' => 'required',
            // 'image' => 'pdf,csv,txt,docs',
        ));

        $productCertification->name = $request->name;
        $productCertification->issued_by = $request->issued_by;
        $productCertification->business_scope = $request->business_scope;

        self::deleteFile( storage_path('app/public/documents/' . $productCertification->pdf) ) ;

        if($request->hasFile('pdf')){
            $pdfs = request()->file('pdf');
//            $filename = time() . '.' . $pdfs->getClientOriginalExtension();
//            request()->pdf->move(public_path('documents'), $filename);
            $productCertification->pdf= $this->uploadImage($pdfs, 'documents');
        };



        if($productCertification->save()){
            return redirect()->route('productCertification.index')->with('success','Product Certification Updated Successfully');
        } else {
            return redirect()->back()->with('success','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCertification $productCertification)
    {
        self::deleteFile( storage_path('app/public/documents/' . $productCertification->pdf) ) ;

        $productCertification->delete();
        return redirect()->back()->with('info','Product Certification Deleted Successfully');
    }
}
