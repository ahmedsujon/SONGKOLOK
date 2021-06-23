<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Helper\DeleteFile;
use Illuminate\Support\Facades\Auth;
use Session;

class BlogController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('user')->orderBy('created_at','DESC')->get();
        //dd($blogs);
        return view('admin.blog.manage',compact('blogs'));
    }

    public function allBog()
    {
        $blogs = Blog::with('user')->where('status',1)->orderBy('created_at','DESC')->limit(20)->get();
        //dd($blogs);
        return view('pages.all_blogs',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.blog_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'post' => 'required',
            'blog_video' => 'required',
        ));

        $blog = new Blog();

        $user_id = Auth::guard('web')->id();
        //dd($user_id);
        $blog->user_id = $user_id;
        $blog->post = $request->post;
        $blog->title = $request->title;
        $blog->blog_slug = $this->createSlug(Blog::class, $request->title, 'blog_slug');
        $blog->blog_video = $request->blog_video;

        if($blog->save()){
            return redirect()->route('blog.allBog')->with('success','Vlog Created Successfully');
        } else {
            return redirect()->back()->with('success','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('blog_slug', $slug)->first();
        $comments = Comment::with('user','replies')->where('blog_id',$blog->id)->orderBy('created_at','DESC')->get();
        $userPBlogs = Blog::where([['user_id', $blog->user->id], ['id', '!=', $blog->id]])
            ->get();

        return view('pages.blog_details',compact(
            'blog',
            'comments',
            'userPBlogs'
        ));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Blog $blog)
    {
        self::deleteFile( storage_path().'/app/public/images/' . $blog->blog_image );
        return($blog->delete()) ?  redirect()->back()->with('info', 'Blog Deleted') :
          redirect()->back()->with('error', 'Something went wrong');
    }

    // Blog Approved
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, 'App\Models\Blog', $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }
}
