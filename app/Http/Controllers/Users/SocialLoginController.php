<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class SocialLoginController extends Controller
{
    public function socialCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $inDatabase = User::where('email', $user->email)->orWhere('provider_id',  $user->id)->first();

        if( $inDatabase ) {
            Auth::login($inDatabase);
            return redirect()->intended('/');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id'=> $user->id,
                'provider'=> $provider,
                'is_verified' => 1,
                'password' => Hash::make('password')
            ]);

            Auth::login($newUser);

            return redirect()->intended('/');
        }
    }


    public function facebookCallback()
    {

    }


    public function googleHandel($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
