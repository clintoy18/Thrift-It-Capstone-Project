<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Models\Product;


Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'rolemiddleware:user'])
    ->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified','rolemiddleware:admin'])->name('admin');

Route::get('upcycler/dashboard', function () {
    return view('upcycler');
})->middleware(['auth', 'verified','rolemiddleware:upcycler'])->name('upcycler');


//to make sure only a user can access the user routes, 
Route::middleware(['auth', 'verified', 'rolemiddleware:user'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
