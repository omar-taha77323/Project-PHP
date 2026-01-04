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

Route::get('/', function () {
    return view('welcome');
});
Route::view('/news', 'news');
Route::view('/dsadmin/products', 'dsadmin.products.index');
Route::view('/dsadmin/products/create', 'dsadmin.products.create');

// Route::view('/dsadmin/categories', 'dsadmin.categories.index');
// Route::view('/dsadmin/categories/create', 'dsadmin.categories.create');

Route::view('/dsadmin/orders', 'dsadmin.orders.index');
Route::view('/dsadmin/orders/1', 'dsadmin.orders.show');

Route::view('/dsadmin/customers', 'dsadmin.customers.index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dsadmin/categories', [App\Http\Controllers\CategorieController::class, 'index'])->name('home');
Route::get('/dsadmin/categories/create', [App\Http\Controllers\CategorieController::class, 'create'])->name('home');
