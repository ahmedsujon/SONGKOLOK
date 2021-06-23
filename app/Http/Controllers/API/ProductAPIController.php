<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;

class ProductAPIController extends Controller
{

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProduct($data): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Product::where('product_name', 'LIKE','%'.$data.'%')
                ->GetActive()
                ->get()
        );
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function productBySlug($slug): \Illuminate\Http\JsonResponse
    {
        $pro = Product::with(['productImages', 'productVideos', 'category', 'subcategory', 'brand', 'secondsub', 'coupon'])->where('product_slug', $slug)->GetActive()->first();
        return ($pro)?
            response()->json($pro, 200):
            response()->json([], 404);
    }


    /**
     * @param $slug
     * @param $withRelatedTable
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryBySlug($slug, $withRelatedTable): \Illuminate\Http\JsonResponse
    {
        $cat = Category::where('category_slug', $slug)->GetActive()->first();

        return ($cat)?
            response()->json(
                ($withRelatedTable == "true") ?
                    $cat : $cat->subcategory
                , 200):
            response()->json([], 404);
    }


    /**
     * @param $slug
     * @param $withRelatedTable
     * @return \Illuminate\Http\JsonResponse
     */
    public function subCatBySlug($slug, $withRelatedTable): \Illuminate\Http\JsonResponse
    {
        $cat = SubCategory::where('subcategory_slug', $slug)->GetActive()->first();

        return ($cat)?
            response()->json( ($withRelatedTable == "true") ? $cat : $cat->secondary_sub_categories, 200):
            response()->json([], 404);
    }


    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function secondarySubCatBySlug($slug): \Illuminate\Http\JsonResponse
    {
        $second = SecondarySubCategory::where('secondary_subcategory_slug', $slug)->GetActive()->first();

        return ($second)?
            response()->json($second, 200):
            response()->json([], 404);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function allProduct(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Product::all(), 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function allCategory(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::GetActive()->get(), 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function allSubCategory(): \Illuminate\Http\JsonResponse
    {
        return response()->json(SubCategory::GetActive()->get(), 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function allSecondarySubCategory(): \Illuminate\Http\JsonResponse
    {
        return response()->json(SecondarySubCategory::GetActive()->get(), 200);
    }


    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function productBySubCategory($slug): \Illuminate\Http\JsonResponse
    {
        $subCat = SubCategory::where('subcategory_slug', $slug)->GetActive()->first();

        if ($subCat){
            $pro = Product::where('sub_categories_id', $subCat->id)->GetActive()->get();
            return ($pro) ? response()->json($pro, 200) : response()->json([], 404);
        }
        return response()->json([], 404);
    }
}
