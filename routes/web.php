<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'about'])->name('about');

//cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::match(['get', 'post'], '/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout/success', function () {
    return view('checkout');
})->name('checkout.success');

Route::get('/transaction-history', [CartController::class, 'transaction_history'])->name('transaction.history');
Route::delete('/transaction/{id}', [CartController::class, 'delete'])->name('transaction.delete');



Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/class', [ClassController::class, 'class'])->name('class');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
Route::get('/category', [CategoryController::class, 'list'])->name('category');
Route::get('/category/{id}', [ProductController::class, 'productsByCategory'])->name('category.products');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/productlist', [AdminController::class, 'productlist'])->name('productlist');
Route::post('/productadd', [AdminController::class, 'productadd'])->name('productadd');
Route::get('/productdelete/{id}', [AdminController::class, 'productdelete'])->name('productdelete');
Route::get('/productupdateform/{id}', [AdminController::class, 'productupdateform'])->name('productupdateform');
Route::post('/productupdate', [AdminController::class, 'productupdate'])->name('productupdate');

Route::get('/userlist', [AdminController::class, 'userlist'])->name('userlist');
Route::get('/users/create', [AdminController::class, 'userCreateForm'])->name('user.create.form');
Route::post('/users/create', [AdminController::class, 'userCreate'])->name('user.create');
Route::get('/users/edit/{id}', [AdminController::class, 'userEditForm'])->name('user.edit.form');
Route::post('/users/edit/{id}', [AdminController::class, 'userEdit'])->name('user.edit');
Route::delete('/users/delete/{id}', [AdminController::class, 'userDelete'])->name('user.delete');

Route::get('/orderlist', [AdminController::class, 'orderlist'])->name('orderlist');
Route::patch('/order/update/{id}', [AdminController::class, 'updateOrderStatus'])->name('order.update.status');
