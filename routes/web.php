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
// Route::get('/sendmail', function() {
//     $data = User::findOrFail(1);
//     Mail::to('nguyenhuudo1206@gmail.com')->send(new MyTestEmail($data));
// });



// Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
// Route::post('/login-post', [AuthController::class, 'login'])->name('auth.loginPost');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', [HomeController::class, 'index'])->name('users.home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/products', [ProductsController::class, 'index'])->name('users.products.index');
Route::get('/products/details/{id}', [ProductsController::class, 'details'])->name('users.products.details');
Route::get('/search', [ProductsController::class, 'search'])->name('users.products.search');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/', [AdminProductsController::class, 'index'])->name('admin');
    Route::get('products', [AdminProductsController::class, 'index'])->name('admin.products');
    Route::get('products/create', [AdminProductsController::class, 'create'])->name('admin.products.create');
    Route::delete('products/{id}', [AdminProductsController::class, 'delete'])->name('admin.products.delete')->middleware('can:product-delete');
    Route::post('products/store', [AdminProductsController::class, 'store'])->name('admin.products.store');

    Route::get('categories', [AdminCategoriesController::class, 'index'])->name('admin.categories')->middleware('can:category-view');
    Route::get('categories/create', [AdminCategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('categories/store', [AdminCategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/delete/{id}', [AdminCategoriesController::class, 'delete'])->name('admin.categories.delete');
    Route::get('categories/edit/{id}', [AdminCategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id}', [AdminCategoriesController::class, 'update'])->name('admin.categories.update');

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
});
