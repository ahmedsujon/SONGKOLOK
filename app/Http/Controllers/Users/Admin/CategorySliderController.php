<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\DeleteFile;

class CategorySliderController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorySlider.manage', [
            'sliders' => CategorySlider::with('category')->CategoryWithAdmin()->get()
        ]);
    }

    public function allCategorySlider()
    {
        return view('admin.categorySlider.manage', [
            'sliders' => CategorySlider::with('category')->CategoryWithOutAdmin()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::CategoryWithAdminOwner()->get();
        return view('admin.categorySlider.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'slider_media' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ));

        if($request->hasFile('slider_media')){
            $files = $request->file('slider_media');
            foreach ($files as $file){
                $productImages = new CategorySlider();
                $fileType = strstr($file->getMimeType(), '/', true);
                $type = strstr($file->getMimeType(), '/');

                $productImages->admin_id = Auth::guard('admin')->user()->id;
                $productImages->slider_media = ( strcmp($fileType, 'video') )  ?
                    $this->uploadImage($file, 'images') : $this->uploadImage($file, 'videos');

                $productImages->category_id = $request->input('category_id');
                $productImages->status = $request->input('status');
                $productImages->type = $fileType;
                $productImages->file_type = ltrim($type, '/');
                $productImages->save();
                $productImages = null;
            }
        }

        return redirect()->route('categorySlider.index')->with('success', 'Category Slider Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorySlider $categorySlider)
    {
        if( self::changeStatus($request->status, 'App\Models\CategorySlider', $request->id) )
            return redirect()->back()->with('success', 'Status Changed');
        return  redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySlider $categorySlider)
    {
        ( strcmp('video', $categorySlider->type) )?
            self::deleteFile(storage_path().'/app/public/images/'  . $categorySlider->slider_media) :
            self::deleteFile(storage_path().'/app/public/videos/' .  $categorySlider->slider_media) ;

        return ($categorySlider->delete())? redirect()->route('categorySlider.index')->with('info', 'Category Slider Deleted') :
            redirect()->route('categorySlider.index')->with('error', 'Something went wrong');
    }
}
