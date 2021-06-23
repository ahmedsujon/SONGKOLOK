@extends('layouts.app_main')

@section('content')


<!--  User information start  -->
    @foreach($users as $user)
    <section class="user_info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user_info_title">

                    </div>
                    <div class="breadcrumb_content">
                        <ul>
                            <li><h4>Your Information</h4></li>
                            <li><a href="{{route('profile.edit',$user->id)}}">Update Your Information</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="user_info_inner">

                        <div class="user_name">
                            <h4>Name: {{$user->fname." ".$user->lname}}</h4>
                        </div>
                        <div class="user_name">
                            <p>Number: {{$user->phone}}</p>
                        </div>
                        <div class="user_name">
                            <p>Email: {{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach

<!--  User information end  -->


<!--  Order table star -->


   <section class="order_complete">
       <div class="container">
           <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                   <div class="dashboard_content">
                       <div class="tab-pane">
                           <h3>Orders Details</h3>
                           <div class="table-responsive">
                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th>Order ID</th>
                                           <th>Order Date</th>
                                           <th>Image</th>
                                           <th>Product</th>
                                           <th>Size</th>
                                           <th>Price</th>
                                           <th>Quantity</th>
                                           <th>Total</th>
                                           <th>Order Status</th>
                                           <th>Order Cancel</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       @php
                                           $total_price = 0;
                                       @endphp
                                       @foreach($orders as $index => $order)
                                           <tr>
                                               <td>{{$order->unique_id}}</td>
                                               <td>{{\Carbon\Carbon::parse($order->created_at)->format('M d Y')}} </td>
                                               @foreach($order->products as $product)
                                                   <td>
                                                       <img src="{{assetImageAndVideo('images') .$product->feature_image}}" alt="{{$product->product_name}}" class="img-rounded" width="80" />
                                                   </td>
                                                   <td>{{$product->product_name}}</td>
                                                   <td>{{$product->size}}</td>
                                                   <td>BDT: {{$product->product_price}}</td>
                                                   @php
                                                       $total_price = $order->quantity * $product->product_price;
                                                   @endphp
                                               @endforeach
                                               <td>{{$order->quantity}}</td>
                                               <td>BDT: {{$total_price}}</td>
                                               <td>
                                                   @if($order->shifted == 1)
                                                       <button type="submit" class="btn btn-success">Shifted</button>
                                                   @else
                                                       <button type="submit" class="btn btn-danger">Pending</button>
                                                   @endif
                                               </td>
                                               <td>
                                                   @if($order->shifted == 1)
                                                       <button type="submit" class="btn btn-success">Shifted</button>
                                                   @else
                                                       <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$order->id}}">
                                                            Cancel
                                                       </a>

                                                       <!-- Modal -->
                                                       <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                           <div class="modal-dialog">
                                                               <div class="modal-content">
                                                                   <div class="modal-header">
                                                                       <h5 class="modal-title" id="exampleModalLabel">Do You Want to cancel your order !!!</h5>
                                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                           <span aria-hidden="true">&times;</span>
                                                                       </button>
                                                                   </div>
                                                                   <div class="modal-body">
                                                                       <form action="{{route('profile.order.cancel',$order->id)}}" method="post">
                                                                           @csrf
                                                                           @method("DELETE")
                                                                           <button class="btn btn-danger">Confirm</button>
                                                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                       </form>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>

                                                   @endif

                                               </td>
                                           </tr>
                                       @endforeach
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>


<!--  Order table end -->

<!-- User Blog Post Start-->

<section class="user_post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user_post_inner">
                    <div class="related_posts" style="border-top:none">
                        <h3>Your Posts</h3>
                        <div class="row">
                            @foreach($userPBlogs as $userBlog)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <article class="single_related">
                                        <figure>
                                            <div class="related_thumb">
                                                <div class="zoom-In">
                                                <a href="{{route('blog.show',$userBlog)}}"><img src="{{assetImageAndVideo('images') .$userBlog->blog_image}}" alt="{{$userBlog->title}}"></a>
                                                </div>
                                            </div>
                                            <figcaption class="related_content">
                                                <h4><a href="#">{{$userBlog->title}}</a></h4>
                                                <div class="blog_meta">
                                                    <span class="author">By : <a href="{{route('blog.show',$userBlog->id)}}">{{$userBlog->user->fname . " " . $userBlog->user->lname}}</a> / </span>
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
</section>

    <!-- User Blog Post End-->

@endsection
