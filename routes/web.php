<?php

use App\Mail\VerificationMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
Route::get('link', function (){
    Artisan::call('storage:link');
});

Route::get('clear', function (){
    Artisan::call('cache:clear');
});
Route::get('/createslug', function (){
    $categories = \App\Models\Brand::all();

    foreach ($categories as $category){
        $count = \App\Models\Brand::where('brand_slug',  strtolower(str_replace(" ", "", $category->brand_name)))->count();

        if( $count == 0 ) $counter = 0;
        else    $counter = (int)$count + 1;

        $slug = strtolower(str_replace(" ", "", $category->brand_name));

        if ($counter) {
            $slug = $slug . '-' . $counter;
        }

        $category->brand_slug  = $slug;
        $category->save();
    }
});

Route::get('test', function (){
    $pro = Product::where('admin_id', 1)->orderBy('sold', 'desc')->limit(5)->get();

    $from = date('Y') . '-01-01';
    $to = date('Y') . '-12-31';
dd($from, $to
);
    $monthlySell = [];

    foreach ($pro as $prIndex => $product){
        $res= \App\Models\OrderProduct::with('order')
            ->where('product_id', $product->id)
            ->whereBetween('created_at', [$from, $to])
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('m');
        });

        $monthlySell[$prIndex]['label'] = $product->product_name;
        $monthlySell[$prIndex]['backgroundColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $monthlySell[$prIndex]['borderColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $monthlySell[$prIndex]['pointRadius'] = true;
        $monthlySell[$prIndex]['pointColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $monthlySell[$prIndex]['pointStrokeColor'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $monthlySell[$prIndex]['pointHighlightFill'] = '#ffffff';
        $monthlySell[$prIndex]['pointHighlightStroke'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));


        if( ! count($res) ){
            for ($i = 1; $i <= 12; ++$i){
                $monthlySell[$prIndex]['data'][] = 0;
            }
        }
        else {
            foreach ($res as $index => $value){
                $monthlySell[$prIndex]['data'][] = $value[0]->order->quantity;
            }

            $len = count($res) ;

            if( $len < 12 ){
                for ($i = $len+1; $i <= 12; ++$i){
                    $monthlySell[$prIndex]['data'][] = 0;
                }
            }
        }
    }
dd($monthlySell);
    return json_encode($monthlySell, true);
});

Route::get('/privacy',function(){
    return view('pages.privacy');
})->name('privacy');

Route::get('/affilate', function (){
    return view('pages.affiliate');
})->name('affilate');


Route::get('/article', function (){
    return view('pages.artical');
})->name('article');


Route::get('/delivery', function (){
    return view('pages.delivery');
})->name('delivery');


Route::get('/return', function (){
    return view('pages.return');
})->name('return');


Route::get('/terms', function (){
    return view('pages.terms_and_con');
})->name('terms');


Route::get('/gift', function (){
    return view('pages.gift');
})->name('gift');


Route::get('/special', function (){
    return view('pages.special');
})->name('special');


Route::get('/about', function (){
    return view('pages.about');
})->name('about');


Route::get('/faq',function(){
    return view('pages.faq');
})->name('faq');

Route::get('/',  'WelcomeController@index')->name('home');
Route::get('layouts/', 'Users\NavbarController@store')->name('pages.search');
Route::get('checkout', 'Users\CheckoutController@index')->middleware(['auth'])->name('checkout');
Route::post('checkout', 'Users\CheckoutController@checkout')->name('checkout.final');
Route::get('checkoutconfirm', 'Users\CheckoutController@checkoutConfirm')->name('checkout.confirm');
Route::get('addWishList/{id}', 'WelcomeController@addWishList')->name('add.wish.list')->middleware(['auth:web']);
Route::get('wishlist', 'WelcomeController@userWishList')->name('wish.list')->middleware(['auth:web']);
Route::delete('wishlist/{wishList}', 'WelcomeController@deleteWishList')->name('wish.delete')->middleware(['auth:web']);
Route::get('addExpressList/{id}', 'WelcomeController@addExpressList')->name('add.express.list');
Route::get('contact', 'Users\ContactController@employeeContact')->name('contact.show');

Route::resource('/contact-support',  'Users\SupportController');
Route::get('messages', 'Users\Admin\SupportController@index')->name('support.message');

//brand
Route::get('brands', 'Users\ContactController@brandShow')->name('brands.show');
Route::get('brands/{slug}', 'Users\NavbarController@brandProduct')->name('brandProduct.show');

//user profile
Route::get('profile', 'Users\NavbarController@profile')->middleware('auth:web')->name('profile.show');
Route::get('profile/{user}/edit', 'Users\NavbarController@profileEdit')->middleware('auth:web')->name('profile.edit');
Route::put('profile/{user}', 'Users\NavbarController@profileUpdate')->middleware('auth:web')->name('profile.update');

// Cancel Order
Route::delete('profile/{order}', 'Users\NavbarController@orderCancel')->middleware(['auth'])->name('profile.order.cancel');

//vendor page show
Route::get('allvendor', 'Users\VendorProductsController@allVendor')->name('allVendor.show');
Route::get('vendor/{id}', 'Users\VendorProductsController@topSale')->name('topSale.show');
Route::get('overview/{id}', 'Users\VendorProductsController@overview')->name('overview');

//Blog page
Route::resource('comment', 'Users\CommentController')->middleware(['auth']);
Route::resource('replay', 'Users\ReplyController')->middleware(['auth']);
Route::get('blog', 'Users\BlogController@create')->name('blog.create');
Route::get('blog/create', 'Users\BlogController@store')->name('blog.store');
Route::get('blogall', 'Users\BlogController@allBog')->name('blog.allBog');
Route::get('blogall/{slug}', 'Users\BlogController@show')->middleware(['auth'])->name('blog.show');
Route::DELETE('blogDelete/{id}', 'Users\BlogController@destroy')->middleware(['auth'])->name('blog.destroy');

// promotion route
Route::get('promotion', 'WelcomeController@promotion')->name('promotion.category');
Route::get('promotion/{event_id?}/{category_id}', 'WelcomeController@promotionProduct')->name('promotion.products');
Route::get('changelocation/{region}/{id}', 'WelcomeController@changeLocation');


// comment route
Route::post('coupon', 'Users\CartController@getCoupon')->name('coupon.code');
Route::resource('review', 'Users\ReviewController')->middleware(['auth']);

Route::prefix('pages')->group(function(){
    Route::get('/{slug}', 'WelcomeController@show')->name('pages.show');
    Route::post('/', 'Users\CartController@store')->middleware(['auth'])->name('pages.cart');
    Route::get('/', 'Users\CartController@create')->middleware(['auth'])->name('cart.create');
    Route::put('/', 'Users\CartController@update')->middleware(['auth'])->name('cart.update');
    Route::delete('/{id}', 'Users\CartController@destroy')->middleware(['auth'])->name('cart.destroy');
    Route::get('delete/{id}', 'Users\CartController@show')->middleware(['auth'])->name('cart.show');
    Route::get('subcategory/{slug}', 'Users\NavbarController@show')->name('subcat.show');
    Route::get('secondarysub/{slug}', 'Users\NavbarController@secondary_subcategory')->name('secondary_sub.show');
    Route::get('category/{slug}', 'WelcomeController@category')->name('cat.show');
});


//User Auth
Auth::routes();

Route::prefix('callback')->group(function (){
    Route::get('{provider}', 'Users\SocialLoginController@socialCallback');
    Route::get('{provider}/handle', 'Users\SocialLoginController@googleHandel');
});


Route::prefix('admin')->group(function (){
    Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
Route::get('/email/verify', function () {
    return view('auth.verify');
})->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::get('verify', 'Auth\RegisterController@verify')->name('verify.mail');


// Admin Auth routes
Route::prefix('admin')->middleware('auth:admin')->group(function(){
    Route::get('allOrders/{id}', 'Users\Admin\OrderController@allOrders')->name('orders.allOrders');
    Route::get('allevent/{id}', 'Users\Admin\EventProductController@allEventProducts')->name('event.allEvents');
    Route::get('sellreport', 'Users\Admin\AdminController@adminMonthlySell')->name('sell.report');
    Route::post('sellreport', 'Users\Admin\AdminController@adminMonthlySellPost')->name('sell.report.post');
    Route::post('coupon/changestatus', 'Users\Admin\CouponController@change')->name('coupon.change.status');
    // vendor routes
    Route::get('allVendor', 'Users\Admin\AdminController@allVendor')->name('vendor.allVendor');

    Route::namespace('Users\Admin')->group(function (){
        Route::post('change', 'BrandController@change')->name('brand.change.status');
        Route::post('levelChange', 'BrandController@levelChange')->name('brand.change.level');
        Route::post('categoryChange', 'CategoryController@change')->name('category.change.status');
        Route::post('subcategoryChange', 'SubCategoryController@change')->name('subcategory.change.status');
        Route::post('secondsubchange', 'SecondarySubCategoryController@change')->name('secondsub.change.status');
        Route::post('productChange', 'ProductController@change')->name('product.change.status');
        Route::post('employeeChange', 'EmployeeController@change')->name('employee.change.status');
        Route::post('emiChange', 'EMIController@change')->name('emi.change.status');
        Route::post('eventChange', 'EventController@change')->name('event.change.status');
        Route::post('product/specification/{product}', 'ProductController@specification')->name('product.change.specification');

        Route::post('vendorChange', 'AdminController@change')->name('vendor.change.status');

        //category by product, subcategory
        Route::post('productbycat/{secondarySubCategory}', 'SecondarySubCategoryController@productBySecondSubCategory')->name('product.by.cat');
        Route::post('subcatbycat/{category}', 'CategoryController@subCategoryByCategory')->name('sub.cat.by.cat');
        Route::post('secondsubcatbysubcat/{subcategory}', 'SubCategoryController@secondarySubBySubCategory')->name('second.sub.cat.by.sub.cat');

        // Division by District
        Route::post('districtByDivision/{division}', 'DivisionController@DistrictByDivision')->name('district.by.division');
        // District by City
        Route::post('cityByDistrict/{district}', 'DistrictController@cityByDistrict')->name('city.by.district');

        Route::name('admin.all.')->prefix('allvendor')->group(function (){
            Route::get('product', 'ProductController@allProduct')->name('product');
            Route::get('brand', 'BrandController@allBrand')->name('brand');
            Route::get('coupon', 'CouponController@allCoupon')->name('coupon');
            Route::get('category', 'CategoryController@allCategory')->name('category');
            Route::get('subcategory', 'SubCategoryController@allSubCategory')->name('subcategory');
            Route::get('productimage', 'ProductImageController@allProductImages')->name('product.image');
            Route::get('productvideo', 'ProductVideoController@allProductVideo')->name('product.video');
            Route::get('user', 'UserController@allUser')->name('user.no.order');

            Route::get('contactusslider', 'ContactUsSliderController@allSlider')->name('slider');
            Route::get('categorySlider', 'CategorySliderController@allCategorySlider')->name('categorySlider');
            Route::get('area', 'AreaController@allArea')->name('allArea');
            Route::get('emi', 'EMIController@withoutAdmin')->name('emi');
            Route::get('event', 'EventController@allEvent')->name('event');
            Route::get('eventProduct', 'EventProductController@allEventProduct')->name('eventProduct');
            Route::get('division', 'DivisionController@allDivision')->name('division');
            Route::get('district', 'DistrictController@allDistrict')->name('district');
            Route::get('city', 'CityController@allCity')->name('city');
            Route::get('subCity', 'SubCityController@allSubCity')->name('subCity');
        });
    });
    Route::post('blogChange', 'Users\BlogController@change')->name('blog.change.status');
    // change Status

});

Route::prefix('admin')->namespace('Users\Vendor')->middleware('auth:admin')->group(function (){

    Route::prefix('vendor')->group(function(){
        Route::resource('productCapacity', 'ProductCapacityController');
        Route::resource('productCertification', 'ProductCertificationController');
        Route::resource('productQuality', 'ProductQualityController');
        Route::resource('productRnD', 'ProductRnDController');
        Route::resource('tradeCapacity', 'ProductTradeCapacityController');
        Route::resource('factoryInspection', 'ProductFactoryInspectionController');
        Route::resource('factoryView', 'FactoryViewController');
        Route::resource('showView', 'ShowViewController');
        //Route::resource('overView', 'VendorOverViewController');
    });
});

Route::prefix('admin')->middleware('auth:admin')->group(function (){
    Route::get('users', 'Users\Admin\UserController@index')->name('admin.all.users');
    Route::get('change/{user}/{currentStatus}', 'Users\Admin\UserController@changeStatus')->name('admin.all.users.change.status');

    //blog manage
    Route::get('blog', 'Users\BlogController@index')->name('admin.blog');
    Route::delete('blog/{blog}', 'Users\BlogController@destroy')->name('blog.destroy');
});

Route::prefix('admin')->middleware('auth:admin')->namespace('Users\Admin')->group(function(){
    Route::resource('category', 'CategoryController');
    Route::resource('subcategory', 'SubCategoryController');
    Route::resource('brand', 'BrandController');
    Route::resource('product', 'ProductController');
    Route::get('product/specification/{product}/update', 'ProductController@specificationForm')->name('product.update.menual.get');
    Route::put('product/specification/{product}', 'ProductController@createMenual')->name('product.update.menual.post');
    Route::resource('productImage', 'ProductImageController');
    Route::resource('productVideo', 'ProductVideoController');
    Route::resource('coupon', 'CouponController');
    Route::resource('orders', 'OrderController');
    Route::resource('designation', 'DesignationController');
    Route::resource('employee', 'EmployeeController');
    Route::resource('secondsub', 'SecondarySubCategoryController');
    Route::resource('contactusslider', 'ContactUsSliderController');
    Route::resource('area', 'AreaController');
    Route::resource('emi', 'EMIController');
    Route::resource('event', 'EventController');
    Route::resource('eventproduct', 'EventProductController');
    Route::resource('division', 'DivisionController');
    Route::resource('district', 'DistrictController');
    Route::resource('city', 'CityController');
    Route::resource('subCity', 'SubCityController');
    Route::resource('categorySlider', 'CategorySliderController');


    Route::get('expresswish', 'AdminController@expressWish')->name('admin.express.wish');
    Route::delete('expressWish/{expressWish}', 'AdminController@destroy')->name('expressWish.destroy');
});

