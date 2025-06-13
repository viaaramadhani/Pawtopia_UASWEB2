<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdoptionApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// Force logout for testing
Route::get('/force-logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/login')->with('message', 'You have been logged out.');
})->name('force.logout');

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Home route
Route::get('/home', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.landing');
        }
    }
    return redirect()->route('login');
})->name('home');

// Public routes accessible without login
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::post('/donation/process', [DonationController::class, 'process'])->name('donation.process');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'create'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Protected routes requiring authentication
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('admin.dashboard');

    // User Landing and Dashboard
    Route::get('/user/landing', [UserDashboardController::class, 'landing'])
        ->middleware(['role:user'])
        ->name('user.landing');
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware(['role:user'])
        ->name('user.dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Adoption application routes
    Route::get('/apply-adoption/{cat}', [App\Http\Controllers\AdoptionApplicationController::class, 'create'])
        ->name('apply.adoption');
    Route::post('/submit-adoption/{cat}', [App\Http\Controllers\AdoptionApplicationController::class, 'store'])
        ->name('submit.adoption');
    Route::get('/adoption-confirmation/{cat}', [App\Http\Controllers\AdoptionApplicationController::class, 'confirmation'])
        ->name('adoption.confirmation');

    // Admin-only resources
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('cats', CatController::class)->except(['show']);
        Route::resource('adoptions', AdoptionController::class);
        Route::resource('shelters', ShelterController::class);

        // Add explicit route for adoption status updates
        Route::put('adoptions/{adoption}/status', [AdoptionController::class, 'updateStatus'])->name('adoptions.updateStatus');

        // Admin contact routes
        Route::get('/admin/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('/admin/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contacts.show');
        Route::delete('/admin/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    });

    // Routes accessible by both admins and users
    Route::get('/cats/{cat}', [CatController::class, 'show'])->name('cats.show');
    Route::get('/adoptions/{adoption}', [AdoptionController::class, 'show'])->name('adoptions.show');

    // Certificate route
    Route::get('/adoption/certificate/{adoption}', [App\Http\Controllers\CertificateController::class, 'generate'])
        ->name('adoption.certificate');

    // Notification routes
    Route::post('/notifications/{notification}/mark-as-read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'Notifikasi ditandai sebagai telah dibaca');
    })->name('notifications.mark-as-read');
});

// Adoption process routes
Route::middleware(['auth'])->group(function () {
    // Apply for adoption
    Route::get('/cats/{cat}/adopt', [App\Http\Controllers\AdoptionApplicationController::class, 'create'])->name('apply.adoption');
    Route::post('/cats/{cat}/adopt', [App\Http\Controllers\AdoptionApplicationController::class, 'store'])->name('submit.adoption');
    Route::get('/adoption/confirmation/{cat}', [App\Http\Controllers\AdoptionApplicationController::class, 'confirmation'])->name('adoption.confirmation');
});

// Admin adoption management
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/adoptions', [App\Http\Controllers\AdoptionController::class, 'index'])->name('adoptions.index');
    Route::put('/adoptions/{adoption}', [App\Http\Controllers\AdoptionController::class, 'update'])->name('adoptions.update');
});

// User Adoption Routes (simplified adoption process)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/adopt/{cat}', [App\Http\Controllers\UserAdoptionController::class, 'showAdoptForm'])->name('user.adopt');
    Route::post('/adopt/{cat}/submit', [App\Http\Controllers\UserAdoptionController::class, 'submitAdoptForm'])->name('user.adopt.submit');
});