<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::namespace('API')->group(function(){
    //user info api
    Route::post('getUser', 'UserInfoAPIController@getUser');
    Route::post('createUser', 'UserInfoAPIController@createUser');
    Route::post('userByEmail', 'UserInfoAPIController@userByEmail');
    Route::put('updateProfile/{user}', 'UserInfoAPIController@updateProfile');

    //product api
    Route::prefix('all')->group(function (){
        Route::get('product', 'ProductAPIController@allProduct');
        Route::get('category', 'ProductAPIController@allCategory');
        Route::get('subCategory', 'ProductAPIController@allSubCategory');
        Route::get('secondarySubCategory', 'ProductAPIController@allSecondarySubCategory');
        Route::get('user', 'UserInfoAPIController@allUser');
    });

    Route::prefix('wishlist')->group(function (){
        Route::post('create', 'WishListAPIController@createWishList');
        Route::get('byUser/{user}', 'WishListAPIController@getWishListByUser');
        Route::get('byUserAndProduct/{user}/{productID}', 'WishListAPIController@wishListByUserIdAndProductID');
    });

    Route::get('productBySlug/{slug}', 'ProductAPIController@productBySlug');
    Route::get('categoryBySlug/{slug}/{withRelatedTable}', 'ProductAPIController@categoryBySlug');
    Route::get('subCatBySlug/{slug}/{withRelatedTable}', 'ProductAPIController@subCatBySlug');
    Route::get('secondarySubCatBySlug/{slug}', 'ProductAPIController@secondarySubCatBySlug');
    Route::get('productBySubCategory/{slug}', 'ProductAPIController@productBySubCategory');

    Route::get('searchProduct/{data}', 'ProductAPIController@searchProduct');
});
