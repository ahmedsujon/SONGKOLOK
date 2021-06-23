<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('city_name','asc')->with(['division','district'])->get();
        //dd($cities);
        return view('admin.city.manage',compact('cities'));
    }

    public function allCity()
    {
        $cities = City::orderBy('city_name','asc')->with(['division','district'])->WithoutAdminCity()->get();
        //dd($cities);
        return view('admin.city.manage',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::orderBy('division_name','asc')->get();
        return view('admin.city.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'district_id' => 'required',
            'city_name' => 'required',
            'division_id' => 'required'
        ]);

        if( City::create($validate) ) return redirect(route('city.index'))->with('success', 'Delivery Area City created');
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
     * @param City $city
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $divisions = Division::orderBy('division_name','asc')->get();
        $districts = District::with('division')->where('division_id',$city->division_id)->get();
        //dd($districts);
        return view('admin.city.edit',compact('city','divisions','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, City $city)
    {
        $validate = $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'city_name' => 'required'
        ]);

        return ( $city->update($validate) )?
            redirect()->route('city.index')->with('success', 'Updated Successfully'):
            redirect()->route('city.index')->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(City $city)
    {
        return $city->delete() ?
            redirect()->back()->with('info', ' Deleted Successfully') :
            redirect()->back()->with('error', 'Something went wrong') ;
    }
}
