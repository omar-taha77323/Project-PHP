<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\NewsletterController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\WishlistController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::name('user.')->group(function () {

    // ✅ Orders (User) - تم تعديل المسار + الاسم لمنع التعارض مع admin /orders
    Route::middleware('auth')->group(function () {
        Route::get('/my-orders', [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/my-orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
        Route::get('/my-orders/success/{order}', [UserOrderController::class, 'success'])->name('orders.success');
    });

    // Home
    Route::get('/', [UserHomeController::class, 'index'])->name('home');

    // Shop / Products
    Route::get('/shop', [UserProductController::class, 'index'])->name('products.index');
    Route::get('/shop/products/{product}', [UserProductController::class, 'show'])->name('products.show');

    // Categories + cart داخل shop
    Route::prefix('shop')->group(function () {
        Route::get('/categories', [UserCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/{category}', [UserCategoryController::class, 'show'])->name('categories.show');

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    });

    // Pages
    Route::view('/about', 'user.pages.about')->name('pages.about');
    Route::view('/contact', 'user.pages.contact')->name('pages.contact');

    Route::post('/contact', function () {
        return redirect('/contact')->with('success', '✅ تم إرسال رسالتك بنجاح (تجريبيًا).');
    })->name('contact.submit');

    // Cart (لو تستخدم /cart)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::middleware('auth')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

        // Newsletter
        Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
    });

    // Wishlist (Session)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
    Route::post('/wishlist/move-to-cart/{product}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    Route::post('/wishlist/move-all-to-cart', [WishlistController::class, 'moveAllToCart'])->name('wishlist.moveAllToCart');

    // ✅ هنا خرجنا من user group خلاص
});


// ===== Auth Pages =====
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');


// ===== Profile =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


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

    // Products
    Route::resource('products', ProductController::class);
    Route::delete('/products/images/{image}', [ProductController::class, 'deleteImage'])
        ->name('products.images.delete');

    // Orders (Admin) - تركناه كما هو
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    // Discount
    Route::resource('discount', DiscountController::class);

    // Customers
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
});


/*
|--------------------------------------------------------------------------
| Brands Routes
|--------------------------------------------------------------------------
*/
// صفحة عرض كل الماركات (للمستخدم)
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

// صفحة عرض ماركة واحدة باستخدام slug
Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');

Route::prefix('dsadmin')->name('dsadmin.')->group(function () {
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::get('/brands/{brand}/toggle', [BrandController::class, 'toggleVisibility'])->name('brands.toggle');
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
