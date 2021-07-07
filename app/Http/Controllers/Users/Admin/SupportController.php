<?php

namespace App\Http\Controllers\Users\Admin;
use App\Http\Controllers\Controller;

use App\Models\Support;
use Illuminate\Http\Request;
use Session;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::orderBy('created_at','desc')->get();
       return view('admin.support.manage',compact('supports'));
    }
}
