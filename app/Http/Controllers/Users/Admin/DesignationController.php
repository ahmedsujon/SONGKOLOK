<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::orderBy('created_at','desc')->get();
        return view('admin.designation.manage',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'designation_name' => ['required', 'string', 'max:255'],
        ]);

        $admin_id = Auth::guard('admin')->user()->id;

        $val['admin_id'] = $admin_id;
        $val['designation_name'] = $request->designation_name;

        if( Designation::create($val) ) return redirect()->route('designation.index')->with('success','Designation Inserted Successfully');

        return redirect()->back()->with('error','Something went wrong ');
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
    public function edit(Designation $designation)
    {
        $designations = $designation;
        return view('admin.designation.edit',compact('designations'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $val = $request->validate([
            'designation_name' => ['required', 'string', 'max:255']
        ]);

        $admin_id = Auth::guard('admin')->user()->id;
        $val['admin_id'] = $admin_id;
        $val['designation_name'] = $request->designation_name;
        $designation->update($val);
        return redirect()->route('designation.index')->with('success','Designation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designation.index')->with('info','Designation Deleted Successfully');
    }
}
