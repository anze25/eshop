<?php

use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureCartExists;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\EnsureCartIsNotEmpty;
use App\Http\Middleware\EnsureWishlistIsNotEmpty;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;





// Group all routes and apply LocaleMiddleware
Route::middleware([SetLocale::class])->group(
    function () {
        Auth::routes();
        Route::get('/change-locale/{locale}', function ($locale) {
            if (in_array($locale, config('app.supported_locales'))) {
                session(['locale' => $locale]);
            }
            return redirect()->back();
        })->name('change-locale');

        Route::view('/privacy-policy', 'privacy-policy')->name('privacy');
        Route::view('/terms-and-conditions', 'terms-and-conditions')->name('terms');
        Route::view('/cookies', 'cookies')->name('cookies');
        Route::view('/company', 'company-card')->name('company');

        Route::get('/', [HomeController::class, 'index'])->name('home.index');
        Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');

        Route::get('/contact-us', [HomeController::class, 'contact'])->name('home.contact');
        Route::post('/contact-store', [HomeController::class, 'contact_store'])->name('home.contact.store');

        Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
        Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');

        Route::get('/wishlist', [WishlistController::class, 'index'])->middleware(EnsureWishlistIsNotEmpty::class)->name('wishlist.index');
        Route::post('/wishlist/add', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
        Route::delete('/wishlist/remove/{rowId}', [WishlistController::class, 'remove_item'])->name('wishlist.item.remove');
        Route::delete('/wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.items.clear');
        Route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move.to.cart');

        Route::get('/cart', [CartController::class, 'index'])->middleware(EnsureCartIsNotEmpty::class)->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
        Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
        Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
        Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
        Route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');


        Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
        Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');

        Route::get('/checkout', [CartController::class, 'checkout'])->middleware(EnsureCartExists::class)->name('cart.checkout');
        Route::post('/place-an-order', [CartController::class, 'place_an_order'])->name('cart.place.an.order');
        Route::get('/order-confirmation', [CartController::class, 'order_confirmation'])->name('cart.order.confirmation');

        Route::get('/search', [HomeController::class, 'search'])->name('home.search');


        Route::middleware(['auth'])->group(function () {
            Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
            Route::get('/account-orders', [UserController::class, 'orders'])->name('user.orders');
            Route::get('/account-orders/{order_id}/details', [UserController::class, 'order_details'])->name('user.order.details');
            Route::put('/account-orders//cancel-order', [UserController::class, 'order_cancel'])->name('user.order.cancel');

            Route::get('/account-address', [UserController::class, 'addresses'])->name('user.addresses');
            Route::get('/account-address/add', [UserController::class, 'address_add'])->name('user.address.add');
            Route::post('/account-address/store', [UserController::class, 'address_store'])->name('user.address.store');
            Route::get('/account-address/edit/{id}', [UserController::class, 'address_edit'])->name('user.address.edit');
            Route::put('/account-address/update', [UserController::class, 'address_update'])->name('user.address.update');
            Route::delete('/account-address/{id}/delete', [UserController::class, 'address_delete'])->name('user.address.delete');

            Route::get('/account-details', [UserController::class, 'account_details'])->name('user.account.details');
            Route::put('/account-details/user/update', [UserController::class, 'account_details_update'])->name('user.account.details_update');
            Route::get('/account-wishlist', [UserController::class, 'wishlist'])->name('user.wishlist');

            Route::post('/account/password', [UserController::class, 'updatePassword'])->middleware('auth')->name('user.account.password.update');
        });

        Route::middleware(['auth', AuthAdmin::class])->group(function () {
            Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

            /** BRANDS */
            Route::get('/admin/brands', [AdminBrandController::class, 'brands'])->name('admin.brands');
            Route::get('/admin/brand/add', [AdminBrandController::class, 'brand_add'])->name('admin.brand.add');
            Route::post('/admin/brand/store', [AdminBrandController::class, 'brand_store'])->name('admin.brand.store');
            Route::get('/admin/brand/edit/{id}', [AdminBrandController::class, 'brand_edit'])->name('admin.brand.edit');
            Route::put('/admin/brand/update', [AdminBrandController::class, 'brand_update'])->name('admin.brand.update');
            Route::delete('/admin/brand/{id}/delete', [AdminBrandController::class, 'brand_delete'])->name('admin.brand.delete');

            /** CATEGORIES */
            Route::get('/admin/categories', [AdminCategoryController::class, 'categories'])->name('admin.categories');
            Route::get('/admin/category/add', [AdminCategoryController::class, 'category_add'])->name('admin.category.add');
            Route::post('/admin/category/store', [AdminCategoryController::class, 'category_store'])->name('admin.category.store');
            Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'category_edit'])->name('admin.category.edit');
            Route::put('/admin/category/update', [AdminCategoryController::class, 'category_update'])->name('admin.category.update');
            Route::delete('/admin/category/{id}/delete', [AdminCategoryController::class, 'category_delete'])->name('admin.category.delete');

            /** PRODUCTS */
            Route::get('/admin/products', [AdminProductController::class, 'products'])->name('admin.products');
            Route::get('/admin/product/add', [AdminProductController::class, 'product_add'])->name('admin.product.add');
            Route::post('/admin/product/store', [AdminProductController::class, 'product_store'])->name('admin.product.store');
            Route::get('/admin/product/edit/{id}', [AdminProductController::class, 'product_edit'])->name('admin.product.edit');
            Route::put('/admin/product/update', [AdminProductController::class, 'product_update'])->name('admin.product.update');
            Route::delete('/admin/product/{id}/delete', [AdminProductController::class, 'product_delete'])->name('admin.product.delete');

            /** COUPONS */
            Route::get('/admin/coupons', [AdminCouponController::class, 'coupons'])->name('admin.coupons');
            Route::get('/admin/coupons', [AdminCouponController::class, 'coupons'])->name('admin.coupons');
            Route::get('/admin/coupon/add', [AdminCouponController::class, 'coupon_add'])->name('admin.coupon.add');
            Route::post('/admin/coupon/store', [AdminCouponController::class, 'coupon_store'])->name('admin.coupon.store');
            Route::get('/admin/coupon/edit/{id}', [AdminCouponController::class, 'coupon_edit'])->name('admin.coupon.edit');
            Route::put('/admin/coupon/update', [AdminCouponController::class, 'coupon_update'])->name('admin.coupon.update');
            Route::delete('/admin/coupon/{id}/delete', [AdminCouponController::class, 'coupon_delete'])->name('admin.coupon.delete');

            /** ORDERS */
            Route::get('/admin/orders', [AdminOrderController::class, 'orders'])->name('admin.orders');
            Route::get('/admin/order/{order_id}/details', [AdminOrderController::class, 'order_details'])->name('admin.order.details');
            Route::put('/admin/order/update-status', [AdminOrderController::class, 'update_order_status'])->name('admin.order.status.update');

            /** SLIDES */
            Route::get('/admin/slides', [AdminSlideController::class, 'slides'])->name('admin.slides');
            Route::get('/admin/slide/add', [AdminSlideController::class, 'slide_add'])->name('admin.slide.add');
            Route::post('/admin/slide/store', [AdminSlideController::class, 'slide_store'])->name('admin.slide.store');
            Route::get('/admin/slide/edit/{id}', [AdminSlideController::class, 'slide_edit'])->name('admin.slide.edit');
            Route::put('/admin/slide/update', [AdminSlideController::class, 'slide_update'])->name('admin.slide.update');
            Route::delete('/admin/slide/{id}/delete', [AdminSlideController::class, 'slide_delete'])->name('admin.slide.delete');

            /** USERS */
            Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin.users');
            Route::get('/admin/user/edit/{id}', [AdminUserController::class, 'user_edit'])->name('admin.user.edit');
            Route::put('/admin/user/update', [AdminUserController::class, 'user_update'])->name('admin.user.update');
            Route::delete('/admin/user/{id}/delete', [AdminUserController::class, 'user_delete'])->name('admin.user.delete');

            /** CONTACTS */
            Route::get('/admin/contacts', [AdminContactController::class, 'contacts'])->name('admin.contacts');
            Route::get('/admin/contacts/{id}', [AdminContactController::class, 'contact_show'])->name('admin.contact.show');
            Route::delete('/admin/contacts/{id}/delete', [AdminContactController::class, 'contact_delete'])->name('admin.contact.delete');

            /** SETTINGS */
            Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
            Route::put('/admin/settings/update', [AdminController::class, 'settings_update'])->name('admin.settings.update');

            /** SEARCH */
            Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
        });
    }
);
