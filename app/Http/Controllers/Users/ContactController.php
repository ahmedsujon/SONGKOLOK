<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ContactUsSlider;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function employeeContact(){
        $employees = Designation::with('employeeWithStatus')->get();
        $sliders = ContactUsSlider::GetActive()->where('for', 0)->get();
        return view('pages.contact2',compact('employees', 'sliders'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function brandShow()
    {
        $brands = Brand::orderBy('created_at','desc')->GetActive()->paginate(18);

        return view('pages.brand',compact('brands'));
    }
}
