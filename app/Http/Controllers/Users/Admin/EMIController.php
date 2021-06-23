<?php

namespace App\Http\Controllers\Users\Admin;

use App\Helper\DeleteFile;
use App\Http\Controllers\Controller;
use App\Models\Emi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EMIController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.emi.manage', ['emis' => Emi::withAdminOwner()->get()]);
    }


    public function withoutAdmin()
    {
        return view('admin.emi.manage', ['emis' => Emi::withOutAdminOwner()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("admin.emi.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = count($request->bank_name);
        $count = 0;
        for ($i = 0; $i < $total; $i++){
            $emi = new Emi();
            $emi->bank_name = $request->bank_name[$i];
            $emi->duration = $request->duration[$i];
            $emi->status = $request->status[$i];
            $emi->admin_id = Auth::guard('admin')->id();

            if( $emi->save() ) $count++;
        }

        if( $count == $total )
            return redirect()->route('emi.index')->with('success', 'EMI created');
        else
            return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param EMI $emi
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EMI $emi)
    {
//        return view('admin.emi.edit', ['emi' => $emi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Emi $emi
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Emi $emi)
    {
        return view('admin.emi.edit', ['emi' => $emi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Emi $emi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Emi $emi)
    {
        $emi->bank_name = $request->bank_name;
        $emi->duration = $request->duration;
        $emi->status = $request->status;

        if( $emi->save() ) return redirect()->route('emi.index')->with('success', 'EMI edited');
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Emi $emi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Emi $emi)
    {
        if( $emi->delete() ) return redirect()->back()->with('info', 'Delete Successfully');
        return redirect()->back()->with('error', 'Something went wrong');
    }


    public function change(Request $request)
    {
        if( self::changeStatus($request->status, Emi::class, $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }
}
