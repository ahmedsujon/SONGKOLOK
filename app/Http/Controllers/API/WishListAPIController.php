<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListAPIController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWishList(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['product_id'] = $request->productID;
        $data['user_id'] = $request->userID;

        $check = WishList::where([
            'product_id'=> $data['product_id'],
            'user_id'=> $data['user_id']
        ])->first();

        if( empty($check) ){
            return ( WishList::create($data) ) ? response()->json(1, 200) : response()->json(1, 400);
        }

        return  response()->json(1, 200);
    }


    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWishListByUser(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json($user->wishLists, 200);
    }


    /**
     * @param $user
     * @param $productID
     * @return \Illuminate\Http\JsonResponse
     */
    public function wishListByUserIdAndProductID($user, $productID): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            WishList::where([
                'user_id' => $user,
                'product_id' => $productID
            ])->first()
        );
    }
}
