<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\frontend\FrontController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\PaymentController as FrontendPaymentController;
use App\Http\Controllers\frontend\BillingController as FrontendBillingController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/m', function () {
//     return view('auth.emil_verified_template');
// });

Auth::routes();

// Email Verify
Route::post('/verify_email/',[RegisterController::class,'check_mail'])->name('checkmail');
Route::post('/verified/',[RegisterController::class,'verified'])->name('verified');

Route::get('/news', [App\Http\Controllers\frontend\NewsController::class, 'news']);
Route::get('/news/detail/{id}', [App\Http\Controllers\frontend\NewsController::class, 'show'])->name('news.detail');

/**  Frontend Group  **/
Route::controller(FrontController::class)->group(function(){
    Route::get('/','index')->name('front');
});

Route::controller(FrontendBillingController::class)->group(function(){
    Route::get('/billing','billing');
    Route::post('/billing/store','store_session')->name('billing.session.store');
});

Route::controller(FrontendPaymentController::class)->group(function(){
    Route::get('/payment','payment');
    Route::get('/review','review');
    Route::post('/payment/store','store_session')->name('payment.session.store');
});

Route::controller(ContactController::class)->group(function(){
    Route::get('/contact','contact');
    Route::post('/contact/store','store')->name('contact.store');
});

Route::controller(FrontendProductController::class)->group(function(){
    Route::get('/products/phones', 'products')->name('products');
    Route::get('/products/all', 'all')->name('products.all');
    Route::get('/products/all_phones', 'all_phone')->name('products.all.phone');
    Route::get('/products/laptops', 'all_laptop')->name('products.all.laptop');
    Route::get('products/search/', 'products_search')->name('products_search');
    Route::post('products/filter/', 'products_filter')->name('products.price.filter');
    Route::get('/products/laptop', 'products_laptop')->name('products.laptop');
    Route::get('/product_detail/{product_id}' ,'product_detail')->name('product_detail');
    Route::get('/product_detail/buy_now/{id}' ,'buy_now')->name('product.buynow');
    Route::post('/add-to-cart', 'addToCart')->name('add_to_cart');
    Route::get('/add-to-cart/product_detail/{id}', 'addToCartFromProductDetail')->name('add_to_cart.product_detail');
    Route::get('/cart','cart')->name('cart');
    Route::patch('update-cart', 'update')->name('update.cart');
    Route::delete('remove-from-cart', 'remove')->name('remove.from.cart');
    Route::post('favourite','add_wishlist')->name('add_wishlist');
    Route::post('favourite_remove','remove_wishlist')->name('remove_wishlist');
});

/** My Account */
Route::controller(HomeController::class)->group(function(){
    Route::get('/home','index')->name('home');
    Route::get('user/changepassword','change_password')->name('change_password');
    Route::get('user/billing_address','address')->name('billing_address');
    Route::get('user/wishlists','wishlist')->name('wishlist');
    Route::put('user/billing_address/{user}','store_address')->name('billing_address.store');
    Route::post('user/changepasswordstore','change_password_store')->name('change_password.store');
    Route::post('/user/update/', 'user_update')->name('user.update');
    Route::post('/user/update/email_verify', 'verified')->name('user.email.update');


    Route::post('/admin/update/{id}', 'admin_update')->name('admin.update');
    Route::post('admin/changepasswordstore','admin_change_password_store')->name('admin_change_password.store');
    Route::post('/user/ban/{id}', 'user_ban')->name('user.ban');
    Route::post('/user/restore/', 'user_ban_restore')->name('user.ban.restore');
});

/**  Super Admin Group  */
Route::group(['prefix'=>'store-admin','as'=>'store_admin.'],function(){
    Route::group(['middleware'=>['auth:web']],function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard','index')->name('dashboard');
            Route::get('/admin/lists','admin_lists')->name('admin.list');
            Route::get('/admin/edit/{id}','edit')->name('admin.edit');
            Route::get('/users/lists','user_lists')->name('users.list');
            Route::get('/admin/list_datatable','get_admin_list_datatable')->name('get_admin_list.datatable');
            Route::get('/users/list_datatable','get_user_list_datatable')->name('get_user_list.datatable');
            Route::get('/users/create','create')->name('user.create');
        });
    });

    Route::get('/register', [App\Http\Controllers\Auth\super_admin\SuperAdminRegisterController::class, 'index']);
    Route::get('/login', [App\Http\Controllers\Auth\super_admin\SuperAdminLoginController::class, 'index']);
    // Route::post('/login', [App\Http\Controllers\Auth\super_admin\SuperAdminLoginController::class, 'login'])->name('login');
    // Route::get('/logout', [App\Http\Controllers\Auth\super_admin\SuperAdminLoginController::class, 'logout'])->name('logout');
    Route::post('/admin_register', [App\Http\Controllers\Auth\super_admin\SuperAdminRegisterController::class, 'create'])->name('role.create');

    Route::group(['middleware'=>['auth:web']],function(){
        Route::controller(ProductController::class)->group(function(){
            Route::get('/product/list','index')->name('product.list');
            Route::get('/product/creat','create')->name('product.create');
            Route::get('/product/all','get_all_products_datatable')->name('product.get_all_products_datatable');
            Route::get('/product/all_trash','get_all_trashed_datatable')->name('product.get_all_trashed_datatable');
            Route::get('/color/creat','color_create')->name('color.create');
            Route::post('/color/store','color_store')->name('color.store');
            Route::post('/product/store','store')->name('product.store');
            Route::get('/product/edit/{id}','edit')->name('product.edit');
            Route::put('/product/update/{id}','update')->name('product.update');
            Route::delete('/product/destroy/{product}','destroy')->name('product.delete');
            Route::get('/product/trash','trash')->name('product.trash');
            Route::get('/product/restore/{id}','restore')->name('product.restore');
            Route::delete('/product/force_delete/{id}','forceDelete')->name('product.force_delete');
        });
    });

    Route::group(['middleware'=>['auth:web']],function(){
        Route::controller(BannerController::class)->group(function(){
            Route::get('/banner/all','index')->name('banner.all');

            Route::get('/banner/create','create')->name('banner.create');

            Route::get('/banner/edit/{id}','edit')->name('banner.edit');

            Route::post('/banner/store','store')->name('banner.store');
            Route::post('/banner/ads','ads_store')->name('ads.store');
            Route::put('/banner/update/{id}','update')->name('banner.update');
            Route::post('/banner/delete/{id}','delete')->name('banner.delete');

            Route::get('/ads/all','all_ads')->name('ads.all');
            Route::get('/ads/create','create_ads')->name('ads.create');
            Route::get('/ads/edit/{id}','edit_ads')->name('ads.edit');
            Route::put('/ads/update/{id}','update_ads')->name('ads.update');
            Route::post('/ads/delete/{id}','delete_ads')->name('ads.delete');
        });
    });


    Route::group(['middleware'=>['auth:web']],function(){
        Route::controller(PostController::class)->group(function(){
            Route::get('/post/all','index')->name('post.all');
            Route::get('/post/datatable','get_posts_datatable')->name('post.all.datatable');
            Route::get('/post/create','create')->name('post.create');
            Route::get('/post/edit/{post}','edit')->name('post.edit');
            Route::post('/post/store','store')->name('post.store');
            Route::put('/post/update/{post}','update')->name('post.update');
            Route::delete('/post/delete/{post}','destroy')->name('post.delete');
        });
    });


});




