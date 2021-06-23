@extends('layouts.app_main')

@section('content')



    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area" style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>Blog Details </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- blog detail start-->


    <div class="blog_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="blog_wrapper blog_wrapper_details">

                        <article class="single_blog">
{{--                            {{count((array)$blogs)}}--}}
{{--                            @foreach($blogs as $index => $blog)--}}
                                <figure>
                                    <div class="post_header">
                                        <h3 class="post_title">{{$blog->title}}</h3>
                                        <div class="blog_meta">
                                            <p>Posted by : <a href="{{route('blog.show',$blog->blog_slug)}}">{{$blog->user->fname . " " . $blog->user->lname}}</a> / On : <a href="#">{{\Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}</a></p>
                                        </div>
                                    </div>
                                    <div class="blog_thumb">
                                        <a href="#">
                                            <iframe width="315" height="600" src="{{ $blog->blog_video }}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <div class="post_content">
                                            <p>{!! $blog->post !!}</p>
                                        </div>
                                    </figcaption>
                                </figure>
{{--                            @endforeach--}}
                        </article>
                      <div class="comments_box mb-3 mt-3">
                            <h3>{{ count($comments) }} comment(s) </h3>
                            <div class="comment_list">
                                <div class="comment_thumb">
{{--                                    <img src="assets/img/blog/comment3.png.jpg" alt="">--}}
                                </div>
                                @foreach($comments as $comment)
                                    <div class="comment_content mb-4 mt-4">
                                        <div class="comment_meta">
                                            <h5><a href="#">{{$comment->user->fname . " " . $comment->user->lname}}</a></h5>
                                            <span>{{\Carbon\Carbon::parse($comment->created_at)->format('M d Y H:m:s')}}</span>
                                        </div>
                                        <p>{{$comment->comment}}</p>
                                        @if( $comment->user->id == \Illuminate\Support\Facades\Auth::id() )
                                            <div class="comment_reply"  data-id="{{$comment->id}}"  id="reply_id{{$comment->id}}">
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        @endif
                                        <div class="reply_div mb-1 mt-5" id="comment_reply_div{{$comment->id}}">
                                            <form action="{{route('replay.store')}}" method="post">
                                                @csrf

                                                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                                <div class="form-group">
                                                    <textarea name="reply" id="" class="form-control" cols="5" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button id="submit_reply" type="submit" class="btn btn-success">Replay</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @foreach($comment->replies as $replay)
                                        <div class="comment_list list_two mb-4 mt-4">
{{--                                            <div class="comment_thumb">--}}
{{--                                                                                        <img src="assets/img/blog/comment3.png.jpg" alt="">--}}
{{--                                            </div>--}}
                                            <div class="comment_content">
                                                <div class="comment_meta">
                                                    <h5><a href="#">{{$replay->user->fname. " " . $replay->user->lname}}</a></h5>
                                                    <span>{{\Carbon\Carbon::parse($replay->created_at)->format('M d Y H:m:s')}}</span>
                                                </div>
                                                <p>{{$replay->reply}}</p>

                                                @if( $replay->user->id == \Illuminate\Support\Facades\Auth::id() )

                                                    <div class="comment_reply"  data-id="{{$replay->id}}"  id="reply_id{{$comment->id}}">
                                                        <form action="{{ route('replay.destroy', $replay->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>


                        </div>
                       <div class="comments_form">
                            <h3>Leave a Post </h3>
                            <form action="{{route('comment.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">Comment </label>
                                        <textarea name="comment" id="review_comment"></textarea>
                                    </div>
                                </div>
                                <button class="button"  type="submit">Post Comment</button>
                             </form>
                        </div>


                        <div class="related_posts" style="border-top:none">
                            <h3>User other posts</h3>
                            <div class="row">
                                @foreach($userPBlogs as $userBlog)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <article class="single_related">
                                        <figure>
                                            <div class="related_thumb">
                                                <a href="{{route('blog.show',$userBlog->blog_slug)}}"><img src="{{assetImageAndVideo('images').$userBlog->blog_image}}" alt="{{$userBlog->title}}"></a>
                                            </div>
                                            <figcaption class="related_content">
                                                <h4><a href="{{route('blog.show',$userBlog->blog_slug)}}">{{$userBlog->title}}</a></h4>
                                                <div class="blog_meta">
                                                    <span class="author">By : <a href="{{route('blog.show',$userBlog->blog_slug)}}">{{$userBlog->user->fname . " " . $userBlog->user->lname}}</a> / </span>
                                                    <span class="meta_date"> {{\Carbon\Carbon::parse($userBlog->created_at)->format('M d Y')}} </span>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!--   blog details end    -->



@endsection
