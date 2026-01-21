<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Pages The WebSite for the Elctronic Stoer 
|--------------------------------------------------------------------------
*/
Route::resource('pages', PagesController::class);

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();


Route::middleware('auth')->group(function () {


    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('password.change');


    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.update');
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('setting.update');
});


/*
|--------------------------------------------------------------------------
| Dashboard + Admin Panel (Super Admin + Sub Admin)
| role_id = 1 or 2
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:1,2'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategorieController::class);
    // Route::put('categories/{category}', [CategorieController::class, 'update'])
    //     ->name('categories.update');
    // Products
    Route::resource('products', ProductController::class);
    Route::delete('/products/images/{image}', [ProductController::class, 'deleteImage'])
        ->name('products.images.delete');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    //Discount
    Route::resource('discount', DiscountController::class);
    // Customers
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
});

/*
|--------------------------------------------------------------------------
|Brands Routes
|--------------------------------------------------------------------------
*/
// صفحة عرض كل الماركات (للمستخدم)
Route::get('/brands', [BrandController::class, 'index'])
    ->name('brands.index');

// صفحة عرض ماركة واحدة باستخدام slug
Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])
    ->name('brands.show');

Route::prefix('dsadmin')->name('dsadmin.')->group(function () {

    // عرض كل الماركات (admin)
    Route::get('/brands', [BrandController::class, 'index'])
        ->name('brands.index');

    // create
    Route::get('/brands/create', [BrandController::class, 'create'])
        ->name('brands.create');

    // store
    Route::post('/brands', [BrandController::class, 'store'])
        ->name('brands.store');

    // edit
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])
        ->name('brands.edit');

    // update
    Route::put('/brands/{brand}', [BrandController::class, 'update'])
        ->name('brands.update');

    // delete
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])
        ->name('brands.destroy');

    // toggle visibility
    Route::get('/brands/{brand}/toggle', [BrandController::class, 'toggleVisibility'])
        ->name('brands.toggle');
});

/*
|--------------------------------------------------------------------------
| Super Admin Only (Manage Admins)
| role_id = 1 فقط
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:1'])->group(function () {

    // Super Admins (role_id = 1)
    Route::get('super-admins', [AdminUsersController::class, 'indexSuper'])->name('super-admins.index');
    Route::get('super-admins/create', [AdminUsersController::class, 'createSuper'])->name('super-admins.create');
    Route::post('super-admins', [AdminUsersController::class, 'storeSuper'])->name('super-admins.store');
    Route::get('super-admins/{user}/edit', [AdminUsersController::class, 'editSuper'])->name('super-admins.edit');
    Route::put('super-admins/{user}', [AdminUsersController::class, 'updateSuper'])->name('super-admins.update');
    Route::delete('super-admins/{user}', [AdminUsersController::class, 'destroySuper'])->name('super-admins.destroy');

    // Sub Admins (role_id = 2)
    Route::get('sub-admins', [AdminUsersController::class, 'indexSub'])->name('sub-admins.index');
    Route::get('sub-admins/create', [AdminUsersController::class, 'createSub'])->name('sub-admins.create');
    Route::post('sub-admins', [AdminUsersController::class, 'storeSub'])->name('sub-admins.store');
    Route::get('sub-admins/{user}/edit', [AdminUsersController::class, 'editSub'])->name('sub-admins.edit');
    Route::put('sub-admins/{user}', [AdminUsersController::class, 'updateSub'])->name('sub-admins.update');
    Route::delete('sub-admins/{user}', [AdminUsersController::class, 'destroySub'])->name('sub-admins.destroy');
});
