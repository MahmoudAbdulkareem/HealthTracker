<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('dashboard'));

// ---------------------- BASIC UI ----------------------
Route::prefix('basic-ui')->group(function() {
    $pages = ['accordions','buttons','badges','breadcrumbs','dropdowns','modals',
              'progress-bar','pagination','tabs','typography','tooltips'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.basic-ui.$page"));
    }
});

// ---------------------- ADVANCED UI ----------------------
Route::prefix('advanced-ui')->group(function() {
    $pages = ['dragula','clipboard','context-menu','popups','sliders',
              'carousel','loaders','tree-view'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.advanced-ui.$page"));
    }
});

// ---------------------- FORMS ----------------------
Route::prefix('forms')->group(function() {
    $pages = ['basic-elements','advanced-elements','dropify','form-validation',
              'step-wizard','wizard'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.forms.$page"));
    }
});

// ---------------------- EDITORS ----------------------
Route::prefix('editors')->group(function() {
    $pages = ['text-editor','code-editor'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.editors.$page"));
    }
});

// ---------------------- CHARTS ----------------------
Route::prefix('charts')->group(function() {
    $pages = ['chartjs','morris','flot','google-charts','sparklinejs','c3-charts','chartist','justgage'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.charts.$page"));
    }
});

// ---------------------- TABLES ----------------------
Route::prefix('tables')->group(function() {
    $pages = ['basic-table','data-table','js-grid','sortable-table'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.tables.$page"));
    }
});

// ---------------------- NOTIFICATIONS ----------------------
Route::get('notifications', fn() => view('pages.notifications.index'));

// ---------------------- USER PAGES ----------------------
Route::prefix('user-pages')->group(function() {

    // Authentication
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    // Forgot & Reset Password
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');

    // Extra user pages
    $extraPages = ['login-2','multi-step-login','register-2','lock-screen'];
    foreach ($extraPages as $page) {
        Route::get($page, fn() => view("pages.user-pages.$page"));
    }

    // ---------------------- GOOGLE AUTH ----------------------
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// ---------------------- ICONS ----------------------
Route::prefix('icons')->group(function() {
    $pages = ['material','flag-icons','font-awesome','simple-line-icons','themify'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.icons.$page"));
    }
});

// ---------------------- MAPS ----------------------
Route::prefix('maps')->group(function() {
    $pages = ['vector-map','mapael','google-maps'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.maps.$page"));
    }
});

// ---------------------- ERROR PAGES ----------------------
Route::prefix('error-pages')->group(function() {
    Route::get('error-404', fn() => view('pages.error-pages.error-404'))->name('error.404');
    Route::get('error-500', fn() => view('pages.error-pages.error-500'))->name('error.500');
});

// ---------------------- GENERAL PAGES ----------------------
Route::prefix('general-pages')->group(function() {
    $pages = ['blank-page','landing-page','profile','email-templates','faq','faq-2',
              'news-grid','timeline','search-results','portfolio','user-listing'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.general-pages.$page"));
    }
});

// ---------------------- ECOMMERCE ----------------------
Route::prefix('ecommerce')->group(function() {
    $pages = ['invoice','invoice-2','pricing','product-catalogue','project-list','orders'];
    foreach ($pages as $page) {
        Route::get($page, fn() => view("pages.ecommerce.$page"));
    }
});

// ---------------------- CLEAR CACHE ----------------------
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// ---------------------- 404 FALLBACK ----------------------
Route::fallback(function () {
    if (view()->exists('pages.error-pages.error-404')) {
        return view('pages.error-pages.error-404');
    }
    return response('404 Page Not Found', 404);
});
