@extends('layouts.app_main')

@section('content')

  <!--breadcrumbs area start-->
  <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
{{--                       <h3>Blog Create</h3>--}}
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li>Blog Create</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

  <div class="customer_login">
    <div class="container">
        <div class="row">
            <!--register area start-->
            <div class="jumbotron col-lg-8 col-md-8 offset-md-2">
                <div class="col-md-12">
                    <div class="account_form register">
                        <h2>Create Blog</h2>
                        <form action="{{route('blog.store')}}" method="get">
{{--                            @csrf--}}

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" id="title" type="text" style="border: 1px solid #495057" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="post">Description</label>
                                <textarea name="post" id="post" cols="20" style="border: 1px solid #495057" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="blog_image">Blog Video</label>
                                <input name="blog_video" type="text" style="border: 1px solid #495057" class="form-control-file">
                            </div>
                            <div class="create_submit">
                                <button type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--register area end-->

        </div>
    </div>
  </div>

@endsection
