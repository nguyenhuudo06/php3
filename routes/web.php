<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\admin\AdminProductsController;
use App\Http\Controllers\users\AuthController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\AdminCategoriesController;
use App\Http\Controllers\admin\AdminBrandsController;
use App\Http\Controllers\users\ProductsController;
use App\Http\Controllers\admin\AdminRolesController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;
use App\Models\User;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\users\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\admin\AdminOrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\AdminPermissionController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\users\OrderController;


require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SendMail
// Route::get('/sendmail', function () {
//     $user = User::findOrFail(1);
//     $data = [
//         'name' => $user->name,
//         'email' => $user->email,
//     ];

//     try {
//         Mail::to('nguyenhuudo1206@gmail.com')->send(new MyTestEmail($data, 'mails.test-email', 'test mail'));
//         return response()->json(['message' => 'Gửi email thành công'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Gửi email không thành công. Error: ' . $e->getMessage()], 500);
//     }

// });

// Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
// Route::post('/login-post', [AuthController::class, 'login'])->name('auth.loginPost');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', [HomeController::class, 'index'])->name('users.home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/products', [ProductsController::class, 'index'])->name('users.products.index');
Route::get('/products/details/{id}', [ProductsController::class, 'details'])->name('users.products.details');
Route::get('/search', [ProductsController::class, 'search'])->name('users.products.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

    // Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::post('/vnpay_payment/{id}/{total}', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::get('/vnpay_php/vnpay_return', [PaymentController::class, 'vnpay_return'])->name('vnpay_return');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    // Admin products
    Route::get('/', [AdminProductsController::class, 'index'])
        ->name('admin')
        ->middleware('can:view_product');

    Route::get('products', [AdminProductsController::class, 'index'])
        ->name('admin.products')
        ->middleware('can:view_product');

    Route::get('products/create', [AdminProductsController::class, 'create'])
        ->name('admin.products.create')
        ->middleware('can:view_product');

    Route::delete('products/{id}', [AdminProductsController::class, 'delete'])
        ->name('admin.products.delete');

    Route::post('products/store', [AdminProductsController::class, 'store'])
        ->name('admin.products.store')
        ->middleware('can:add_product');

    // Admin categories
    Route::get('categories', [AdminCategoriesController::class, 'index'])
        ->name('admin.categories')
        ->middleware('can:view_category');

    Route::get('categories/create', [AdminCategoriesController::class, 'create'])
        ->name('admin.categories.create')
        ->middleware('can:view_category');

    Route::post('categories/store', [AdminCategoriesController::class, 'store'])
        ->name('admin.categories.store')
        ->middleware('can:add_category');

    Route::get('categories/delete/{id}', [AdminCategoriesController::class, 'delete'])
        ->name('admin.categories.delete')
        ->middleware('can:delete_category');

    Route::get('categories/edit/{id}', [AdminCategoriesController::class, 'edit'])
        ->name('admin.categories.edit')
        ->middleware('can:view_category');

    Route::post('categories/update/{id}', [AdminCategoriesController::class, 'update'])
        ->name('admin.categories.update')
        ->middleware('can:update_category_category');


    Route::get('users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('users/create', [AdminUsersController::class, 'create'])->name('admin.users.create');
    Route::post('users/store', [AdminUsersController::class, 'store'])->name('admin.users.store');

    Route::get('brands', [AdminBrandsController::class, 'index'])->name('admin.brands');
    Route::get('brands/create', [AdminBrandsController::class, 'create'])->name('admin.brands.create');
    Route::post('brands/store', [AdminBrandsController::class, 'store'])->name('admin.brands.store');
    Route::get('brands/delete/{id}', [AdminBrandsController::class, 'delete'])->name('admin.brands.delete')->middleware('can:brand-delete');
    Route::get('brands/edit/{id}', [AdminBrandsController::class, 'edit'])->name('admin.brands.edit');
    Route::post('brands/update/{id}', [AdminBrandsController::class, 'update'])->name('admin.brands.update');

    Route::get('roles', [AdminRolesController::class, 'index'])->name('admin.roles');
    Route::get('roles/create', [AdminRolesController::class, 'create'])->name('admin.roles.create');
    Route::post('roles/store', [AdminRolesController::class, 'store'])->name('admin.roles.store');

    Route::get('orders', [AdminOrdersController::class, 'index'])->name('admin.orders');

    Route::get('/chart-data', [AdminDashboardController::class , 'index'])->name('admin.dashboard');
    Route::get('/chart-data-api', [AdminDashboardController::class , 'getChartData'])->name('admin.dashboard.data');
});
