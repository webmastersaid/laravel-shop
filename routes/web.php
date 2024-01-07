<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('client.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('main.index');
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/', [TagController::class, 'store'])->name('tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('tag.show');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('tag.update');
        Route::delete('/{tag}', [TagController::class, 'delete'])->name('tag.delete');
    });
    Route::prefix('colors')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('color.index');
        Route::get('/create', [ColorController::class, 'create'])->name('color.create');
        Route::post('/', [ColorController::class, 'store'])->name('color.store');
        Route::get('/{color}', [ColorController::class, 'show'])->name('color.show');
        Route::get('/{color}/edit', [ColorController::class, 'edit'])->name('color.edit');
        Route::patch('/{color}', [ColorController::class, 'update'])->name('color.update');
        Route::delete('/{color}', [ColorController::class, 'delete'])->name('color.delete');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'delete'])->name('user.delete');
    });
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{product}', [ProductController::class, 'delete'])->name('product.delete');
    });
    Route::prefix('groups')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('group.index');
        Route::get('/create', [GroupController::class, 'create'])->name('group.create');
        Route::post('/', [GroupController::class, 'store'])->name('group.store');
        Route::get('/{group}', [GroupController::class, 'show'])->name('group.show');
        Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
        Route::patch('/{group}', [GroupController::class, 'update'])->name('group.update');
        Route::delete('/{group}', [GroupController::class, 'delete'])->name('group.delete');
    });
});
