<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helper\DeleteFile;

class EmployeeController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('designation')->get();
        //dd($employees);
        return view('admin.employee.manage',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::orderBy('created_at','desc')->get();
        return view('admin.employee.create',compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'address' => 'required',
            'designation_name' => 'required',
            'employee_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->designation_id = $request->designation_name;
        $employee->status = $request->status;
        $employee->employee_unique_id = 'ED'.time();
        $employee->admin_id = Auth::guard('admin')->user()->id;


        if($request->hasFile('employee_image')){
            $image = request()->file('employee_image');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            request()->employee_image->move(public_path('images'), $filename);
            $employee->employee_image= $this->uploadImage($image, 'images');
            $employee->save();
        }

        if($employee->save()){
            Session::flash('success','Employee Inserted Successfully');
            return redirect()->route('employee.index');
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
    public function edit(Employee $employee)
    {
        $designations = Designation::orderBy('created_at','desc')->get();
        return view('admin.employee.edit',compact('employee','designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->designation_id = $request->designation_name;
        $employee->status = $request->status;


//        if ( ! self::deleteFile( public_path('images/' . $employee->employee_image) ) )
//            return redirect()->back()->with('error','Something went wrong');

        if($request->hasFile('employee_image')){
            $image = request()->file('employee_image');
            $employee->employee_image= $this->uploadImage($image, 'images');
            $employee->save();
        }

        if($employee->save()){
            Session::flash('success','Employee Updated Successfully');
            return redirect()->route('employee.index');
        }
        else {
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
    public function destroy(Employee $employee)
    {
        self::deleteFile( assetImageAndVideo('images' . $employee->employee_image) );

        $employee->delete();
        return redirect()->back()->with('info','Employee Delete Successfully');
    }

    // change status
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, Employee::class, $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }
}
