<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMailController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'is_verified' => 1,
            'email_verified_at' => date('Y-m-d H:m:s'),
            'verification_code' => sha1(time()),
            'password' => Hash::make($data['password']),
        ]);
    }

//
//    public function register(Request $request)
//    {
//        $user = new User();
//        $user->fname = $request->fname;
//        $user->lname = $request->lname;
//        $user->email = $request->email;
//        $user->phone = $request->phone;
//        $user->password = Hash::make($request->password);
//        $user->verification_code = sha1(time());
//        $user->save();
//
//        if( $user != null ){
//            //send mail
//            SendMailController::sendVerificationMail($request->fname.$request->lname, $request->email, $user->verification_code);
//            return redirect()->route('verification.verify');
//        }
//    }
//
//
//    public function verify(Request $request)
//    {
//        $verification_code = $request->get('code');
//        $user = User::where(['verification_code'=>$verification_code])->first();
//
//        if ( $user != null ){
//            $user->is_verified = 1;
//            //2020-12-02 00:00:00
//            $user->email_verified_at = date('Y-m-d H:m:s');
//            $user->save();
//            return redirect()->route('login')->with(session()->flash('success', 'Verification Success, please Login'));
//        }
//        return redirect()->route('login')
//            ->with(session()->flash('error', 'Invalid Code'));
//    }
}
