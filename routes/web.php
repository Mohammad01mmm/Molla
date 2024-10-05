<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Front\IndexController::class, 'index'])
    ->name('front.index')
    ->middleware('checkslider');

Route::resource('wishlists', App\Http\Controllers\Front\WishlistController::class);

Route::resource('carts', App\Http\Controllers\Front\CartController::class);
Route::get('checkout', [App\Http\Controllers\Front\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout', [App\Http\Controllers\Front\CheckoutController::class, 'checkout'])->name('checkout.checkout');

Route::get('/' . md5('admin-login'), [App\Http\Controllers\Admin\LoginController::class, 'login'])
    ->name('login-admin')
    ->middleware('alreadyLoggedadminIn');
Route::post('/' . md5('admin-login') . '/auth-admin', [App\Http\Controllers\Admin\LoginController::class, 'authAdmin'])->name('auth-admin');

Route::prefix('product')->group(function () {
    Route::get('{product}', [App\Http\Controllers\Front\ProductController::class, 'single_product'])->name('single-product');
});
Route::get('shop', [App\Http\Controllers\Front\ProductController::class, 'list'])->name('products.list');
Route::get('/shop/filter', [App\Http\Controllers\Front\ProductController::class, 'filter'])->name('products.filter');

Route::get('/login', [App\Http\Controllers\Front\LoginController::class, 'login'])
    ->name('front.login')
    ->middleware('alreadyLoggeduserIn');
Route::post('/register', [App\Http\Controllers\Front\LoginController::class, 'register'])
    ->name('front.register')
    ->middleware('alreadyLoggeduserIn');
Route::post('/login', [App\Http\Controllers\Front\LoginController::class, 'login_user'])
    ->name('front.login_user')
    ->middleware('alreadyLoggeduserIn');
Route::get('/dashboard', [App\Http\Controllers\Front\LoginController::class, 'dashboard'])
    ->name('front.dashboard')
    ->middleware('authcheckloginuser');
Route::post('/edit', [App\Http\Controllers\Front\LoginController::class, 'edit'])
    ->name('front.edit')
    ->middleware('alreadyLoggeduserIn');
Route::get('/logout', [App\Http\Controllers\Front\LoginController::class, 'logout'])->name('logout-user');

Route::prefix('admin')
    ->middleware('authcheckloginadmin')
    ->middleware('checkslider')
    ->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\LoginController::class, 'dashboard'])
            ->name('admin.dashboard')
            ->middleware('checkpermission:ShowdashboardPermission');
        Route::resource('menus', App\Http\Controllers\Admin\MenuController::class)->middleware('checkpermission:ShowmenuPermission');
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class)->middleware('checkpermission:ShowsliderPermission');
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('checkpermission:ShowcategoryPermission');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->middleware('checkpermission:ShowproductPermission');
        Route::post('product/category_info', [App\Http\Controllers\Admin\ProductController::class, 'category_info'])->name('products.category_info');
        Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class)->middleware('checkpermission:ShowproductPermission');
        Route::get('main-property', [App\Http\Controllers\Admin\MainpropertyController::class, 'index'])
            ->name('main-property.index')
            ->middleware('checkpermission:ShowproductPermission');
        Route::resource('main-property/colors', App\Http\Controllers\Admin\ColorController::class)->middleware('checkpermission:ShowproductPermission');
        Route::get('checkouts', [App\Http\Controllers\Admin\CheckoutController::class, 'index'])
            ->name('checkouts.index')
            ->middleware('checkpermission:ShowfactorPermission');
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class)->middleware('checkpermission:ShowblogPermission');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('checkpermission:ShowuserPermission');
        Route::resource('managers', App\Http\Controllers\Admin\ManagerController::class)->middleware('checkpermission:ShowuserPermission');
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->middleware('checkpermission:ShowuserPermission');
        Route::resource('permissions', App\Http\Controllers\Admin\PermissionController::class)->middleware('checkpermission:ShowuserPermission');
        Route::get('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout-admin');
    });
