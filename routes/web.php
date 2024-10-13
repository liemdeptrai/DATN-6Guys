<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\usersCcontroller;
use App\Http\Controllers\CheckoutController;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

// Route::middleware('auth')->prefix('admin')->group(function () {
//     Route::resource('category', CategoryController::class);
//     Route::resource('product', ProductController::class);

// });



Route::get('/admin/products/list', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/Home/products', [ProductController::class, 'view'])->name('index.view');
Route::get('/admin/addproducts', [ProductController::class, 'add'])->name('admin.products.add');
// Route::get('/admin/product/addproduct', [ProductController::class, 'add'])->name('admin.products.add');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');

Route::get('/admin/stock', [ProductController::class, 'stock'])->name('admin.products.stock');
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');

Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/product/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

Route::get('/admin/category', [CategoryController::class, 'category'])->name('admin.categories.index');
Route::get('/admin/category/addcategory', [CategoryController::class, 'add'])->name('admin.categories.add');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::get('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

Route::get('/admin/user/list', [usersCcontroller::class, 'index'])->name('admin.user.index');
Route::get('/admin/addusers', [usersCcontroller::class, 'add'])->name('admin.user.add');
Route::post('/admin/addusers', [usersCcontroller::class, 'store'])->name('admin.user.store');
Route::delete('/admin/user/{id}', [usersCcontroller::class, 'destroy'])->name('admin.user.destroy');
Route::get('/admin/user/edit/{id}', [usersCcontroller::class, 'edit'])->name('admin.user.edit');
Route::put('/admin/user/update/{id}', [usersCcontroller::class, 'update'])->name('admin.user.update');

Route::get('/Home', [HomeController::class, 'index'])->name('index');

Route::get('/checkout/confirm', [CheckoutController::class, 'showConfirmCheckout'])->name('user.checkout.confirm');
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('user.checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('user.checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/add/{itemId}/{quantity}', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/add/{itemId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/oders/list', [OrderController::class, 'list'])->name('admin.oders.list');
Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/user/orders', [OrderController::class, 'index'])->name('user.orders');
Route::get('/user/orders/{id}', [OrderController::class, 'show'])->name('user.orders.show');


Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/Home', function () {
//     return view('layouts.app');
// });

Route::get('/post/{id}', function ($id) {
    return $id;
});
Route::get('/admin/dashboard', function () {
    return view('admin.index');
});
Route::get('/shop', function () {
    return view('user.shop');
})->name('shop');
Route::get('/blog', function () {
    return view('user.blog');
})->name('blog');
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');
Route::get('/about', function () {
    return view('user.about');
})->name('about');


//categories CRUD create read update destroy 
// get post put/patch destroy 


// Route::prefix('home')->name('home.')->group(function () {
//     Route::get('/', [HomeController::class, 'index'])->name('index');
//     Route::get('/', [HomeController::class, 'index'])->name('index');
// });

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminController::class, ''])->name('');
//     Route::get('/', [AdminController::class, ''])->name('');
// });
