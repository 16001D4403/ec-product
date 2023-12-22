<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::middleware(['auth'])->group(function () {
    // Route for the dashboard
    Route::get('/home', 'DashboardController@index');
});
Route::get('/home', [ProductController::class, 'homePage'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/product/create', [AuthController::class, 'create'])->name('product.create');
Route::post('/products', [AuthController::class, 'store'])->name('product.store');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::post('/books', [BookController::class, 'store'])->name('books.store');

// Route::get('/dashboard', [AuthController::class, 'index']);


Route::get('/', function () {return view('welcome');});
Route::get('product-list', [ProductController::class, 'index']);
Route::get('add-product', [ProductController::class, 'addProduct']);
Route::post('save-product', [ProductController::class, 'saveProduct']);
Route::get('edit-product/{id}', [ProductController::class, 'editProduct']);
Route::post('update-product', [ProductController::class, 'updateProduct']);
Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('user-list', [UserController::class, 'index']);
Route::get('add-user', [UserController::class, 'addUser']);
Route::post('save-user', [UserController::class, 'saveUser']);
Route::get('edit-user/{id}', [UserController::class, 'editUser']);
Route::post('update-user', [UserController::class, 'updateUser']);
Route::get('delete-user/{id}', [UserController::class, 'deleteUser']);


use App\Http\Controllers\PaymentController;

Route::get('/create-order', [PaymentController::class, 'createOrder']);
Route::get('/handle-payment', [PaymentController::class, 'handlePayment']);