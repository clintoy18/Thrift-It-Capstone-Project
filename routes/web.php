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
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PrivateChatController;

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

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
    Route::get('appointments/myAppointments', [AppointmentController::class, 'myAppointments'])->name('appointments.myAppointments');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/users/{user}/report', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/users/{user}/report', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reviews',[ReviewController::class,'index'])->name('reviews.index');
    Route::get('reviews/{review}',[ReviewController::class,'show'])->name('reviews.show');
    Route::get('/users/{user}/review',[ReviewController::class,'create'])->name('reviews.create');
    Route::post('/users/{user}/review',[ReviewController::class,'store'])->name('reviews.store');
});


//Upcycler Routes
Route::middleware(['auth', 'verified', 'rolemiddleware:upcycler'])->group(function () {
    Route::resource('upcycler', UpcyclerController::class);
});

//Global Routes
Route::middleware('auth')->group(function () {
    Route::get(('/profile/{user}'), [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/private-chat/{user}', [PrivateChatController::class, 'show'])->name('private.chat');
    Route::post('/private-chat/{user}/send', [PrivateChatController::class, 'send'])->name('private.chat.send');
});

Route::get('/men', function () {
    return view('men');
})->name('men');

Route::get('/women', function () {
    return view('women');
})->name('women');

Route::get('/kids', function () {
    return view('kids');
})->name('kids');

// // Report Routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
//     Route::get('/users/{user}/report', [ReportController::class, 'create'])->name('reports.create');
//     Route::post('/users/{user}/report', [ReportController::class, 'store'])->name('reports.store');
// });

// Admin Routes
Route::middleware(['auth', 'verified', 'rolemiddleware:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('reports', AdminReportController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('products', AdminProductController::class);
    
    // Sales Report Routes
    Route::get('/sales/monthly-report/{month}', [App\Http\Controllers\Admin\SalesReportController::class, 'generateMonthlyReport'])->name('sales.monthly-report');
    Route::get('/sales/yearly-report', [App\Http\Controllers\Admin\SalesReportController::class, 'generateYearlyReport'])->name('sales.yearly-report');
});

require __DIR__.'/auth.php';
