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
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();


Route::middleware('auth')->group(function () {


    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('password.change');


    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.update');
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
