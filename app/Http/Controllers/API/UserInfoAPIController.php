<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserInfoAPIController extends Controller
{
    /**
     * @param Request $request
     * @return bool
     */
    public function getUser(Request $request): bool
    {
        $user = User::where('email', $request->email)->first();

        return ($user && Hash::check($request->password, $user->password)) ;
    }


    public function createUser(Request $request)
    {
        $validation = $this->validateData($request);
        try {
            return ($validation && User::create($validation));
        } catch (\Exception $exception){
            return false;
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userByEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        return ($user) ? response()->json($user, 200) : response()->json([], 404);
    }


    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $validate = $request->validate([
            'fname'=> 'sometimes',
            'lname' => 'sometimes',
            'phone' => 'sometimes',
            'email' => 'sometimes',
        ]);
        return ( $user->update($validate) )?
            response()->json($user, 200):
            response()->json([], 400) ;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function allUser(): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::GetActive()->get(), 200);
    }



    private function validateData(Request $request){
        if (
            ! empty($request->fname) &&
            ! empty($request->lname) &&
            ! empty($request->email) &&
            ! empty($request->phone) &&
            ! empty($request->password)
        ) return [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_verified' => 1,
            'email_verified_at' => date('Y-m-d H:m:s'),
            'verification_code' => sha1(time())
        ];
        return false;
    }
}
