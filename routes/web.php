<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UpcyclerController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;


Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'rolemiddleware:user'])
    ->name('dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware(['auth', 'verified', 'rolemiddleware:admin'])
        ->name('admin.dashboard');
    

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

Route::middleware(['auth', 'verified', 'rolemiddleware:upcycler'])->group(function () {
    Route::resource('upcycler', UpcyclerController::class);
});
Route::middleware('auth')->group(function () {
    Route::get(('/profile/{user}'), [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Report Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/users/{user}/report', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/users/{user}/report', [ReportController::class, 'store'])->name('reports.store');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'rolemiddleware:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('reports', AdminReportController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('products', AdminProductController::class);

});

require __DIR__.'/auth.php';
