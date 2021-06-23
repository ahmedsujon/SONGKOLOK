<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::with('orders')->get()
        ];

        return view('admin.users.manage', $data);
    }

    public function allUser()
    {
        $data = [
            'users' => User::all()
        ];

        return view('admin.users.manage', $data);
    }


    public function changeStatus(User $user,$currentStatus)
    {
        $user->is_verified = ( $currentStatus == 1 ) ? 0 : 1;
        $user->save();
        Session::flash('success','User status changed');
        return redirect()->back();
    }
}
