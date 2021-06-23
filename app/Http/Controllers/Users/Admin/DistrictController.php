<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::orderBy('district_name','asc')->with('division')->get();
        //dd($districts);
        return view('admin.district.manage',compact('districts'));
    }

    public function allDistrict()
    {
        $districts = District::orderBy('district_name','asc')->with('division')->get();
        //dd($districts);
        return view('admin.district.manage',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::orderBy('division_name','asc')->get();
        return view('admin.district.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ]);

        if( District::create($validate) ) return redirect(route('district.index'))->with('success', 'District created');
        return redirect()->back()->with('error', 'Something went wrong, please try again');
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
     * @param District $district
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $divisions = Division::orderBy('division_name','asc')->get();
        return view('admin.district.edit',compact('district','divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param District $district
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, District $district)
    {
        $validate = $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ]);

        return ( $district->update($validate) )?
            redirect()->route('district.index')->with('success', 'Updated Successfully'):
            redirect()->route('district.index')->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(District $district)
    {
        return $district->delete() ?
            redirect()->back()->with('info', ' Deleted Successfully') :
            redirect()->back()->with('error', 'Something went wrong') ;
    }

    public function cityByDistrict(District $district)
    {
        return City::where('district_id', $district->id)->get();
    }
}
