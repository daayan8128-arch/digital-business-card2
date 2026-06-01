<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BusinessDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\PasswordResetSignedController;
 use App\Filament\Pages\Dashboard;

use App\Models\{
    BusinessDetail,
    about_us,
    heropage,
    our_partner,
    our_client,
    Feedback,
    portfolio,
    service,
    article,
    media,
    bank_detail,
    User
};

Route::get('/about-us', function () {
    return view('sample.about-us');
});

Route::get('/projects', function () {
    return view('sample.projects');
});
Route::get('/services', function () {
    return view('sample.services');
});
Route::get('/visionary', function () {
    return view('sample.visionary');
});
Route::get('/media', function () {
    return view('sample.media');
});
Route::get('/bank-detail', function () {
    return view('sample.bank-detail'); 
});
Route::get('/contact', function () {
    return view('sample.contact');
});
 
// ===============================
// GLOBAL ROUTES
// ===============================

Route::post('/{username}/submit-feedback', [FeedbackController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});

// Check username availability
Route::post('/check-username', function (\Illuminate\Http\Request $request) {
    $exists = User::where('username', $request->username)->exists();
    return response()->json(['exists' => $exists]);
});

// Non-premium page
Route::get('/nonpremium', function () {
    return view('nonpremium.nonpremium_teamplate');
});

// ===============================
// AUTH ROUTES
// ===============================

// Register / Logout
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

 
 
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('forgot-password.show');
Route::post('/forgot-password', [PasswordResetController::class, 'requestOtp'])->name('forgot-password.request');
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('forgot-password.verify');

Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('reset-password.show');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset-password.post');

// ===============================
// ADMIN PANEL (protected)
// ===============================

Route::middleware(['auth'])->group(function () {
    Route::post('/admin/{adminId}/add-subscription', [SubscriptionController::class, 'giveSubscription'])->name('admin.add.subscription');
    Route::post('/admin/create-premium-user', [AdminUserController::class, 'createPremiumUser'])->name('admin.create.premium.user');

    // Dashboard
   
Route::middleware(['auth'])->get('/dashboard', Dashboard::class)->name('dashboard');

    // Admin Business Form
    Route::get('/form', [AdminController::class, 'showForm'])->name('admin.form');
    Route::post('/form', [AdminController::class, 'storeForm'])->name('admin.form.store');
});

// ===============================
// BUSINESS CARD BUILDER
// ===============================

Route::view('/business-card', 'business_card');
Route::get('/business/create', [BusinessDetailController::class, 'create'])->name('business.create');
Route::post('/business/store', [BusinessDetailController::class, 'store'])->name('business.store');
Route::get('/business/show', [BusinessDetailController::class, 'show'])->name('business.show');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// ===============================
// PUBLIC USER PAGES (dynamic username routes)
// ===============================

Route::prefix('{username}')->group(function () {
    Route::get('/', [UserController::class, 'showByUsername'])->name('user.profile');
    Route::get('/about-us', [UserController::class, 'showAbout'])->name('user.about');
    Route::get('/services', [UserController::class, 'showServices'])->name('user.services');
    Route::get('/projects', [UserController::class, 'showProjects'])->name('user.projects');
    Route::get('/visionary', [UserController::class, 'showVisionary'])->name('user.visionary');
    Route::get('/media', [UserController::class, 'showMedia'])->name('user.media');
    Route::get('/bank-detail', [UserController::class, 'showBankDetail'])->name('user.bank-detail');
    Route::get('/contact', [UserController::class, 'showContact'])->name('user.contact');
    Route::get('/share', [UserController::class, 'showShare'])->name('user.share');
});
