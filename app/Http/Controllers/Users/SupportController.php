<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use App\Models\Support;
use Illuminate\Http\Request;
use Session;

class SupportController extends Controller
{
    public function index()
    {
        return view('pages.suppoet');
    }

    public function store(Request $request)
    {
        $supportData = $this->validateRequest();

        if (Support::create($supportData)) {
            Session::flash('message', 'This is a message!');
            } else {
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('home');
    }
    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'sometimes',
            'subject' => 'sometimes',
            'description' => 'sometimes',
        ]);
    }
}
