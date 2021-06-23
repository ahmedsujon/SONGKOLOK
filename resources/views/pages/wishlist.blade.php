@extends('layouts.app_main')

@section('content')

<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Wishlist</h3>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="wishlist_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="wishlist_area">
                    <div class="container">

                            <div class="row">
                                <div class="col-12">
                                    <div class="table_desc wishlist">
                                        <div class="cart_page table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product_remove">Delete</th>
                                                        <th class="product_thumb">Image</th>
                                                        <th class="product_name">Product</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product_quantity">Stock Status</th>
                                                        <th class="product_total">Add To Cart</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($wishLists as $index => $wishlist)
                                                        <tr>
                                                           <td class="product_remove">
                                                               <form action="{{route('wish.delete', $wishlist->id)}}" method="post">
                                                                   @method('DELETE')
                                                                   @csrf
                                                                   <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                               </form>
                                                           </td>
                                                            <td class="product_thumb"><a href="#"><img src="{{ assetImageAndVideo('images'). $wishlist->product->feature_image }}" alt=""></a></td>
                                                            <td class="product_name"><a href="#">{{$wishlist->product->product_name}}</a></td>
                                                            <td class="product-price">BDT {{ $wishlist->product->product_price }}</td>
                                                            <td class="product_quantity">
                                                                @if($wishlist->product->stock > 0)
                                                                    <span class="text-success">In Stock</span>
                                                                @else
                                                                    <span class="text-danger">Out of Stock</span>
                                                                @endif
                                                            </td>
                                                            <td class="product_total">
                                                                <form role="form" action="{{route('pages.cart')}}" enctype="multipart/form-data" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="quantity" value="1" type="number">
                                                                    <input  name="product_id" value="{{$wishlist->product->id}}" hidden>
                                                                    <input  name="product_name" value="{{$wishlist->product->product_name}}" hidden>
                                                                    <input  name="feature_image" value="{{$wishlist->product->feature_image}}" hidden>
                                                                    <input  name="product_price" value="{{$wishlist->product->product_price}}" hidden>
                                                                    <input  name="product_tax" value="{{$wishlist->product->tax}}" hidden>
                                                                    @if($wishlist->product->stock > 0)
                                                                        <button class="btn btn-success" type="submit">add to cart</button>
                                                                    @endif
                                                                </form>
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
            </div>
        </div>
    </div>
</section>

@endsection
