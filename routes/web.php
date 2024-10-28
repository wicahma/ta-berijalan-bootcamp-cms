<?php

use App\Http\Controllers\views\AuthController;
use App\Http\Controllers\views\DashboardController;
use App\Http\Controllers\views\LoginController;
use App\Http\Controllers\views\ResourceController;
use App\Http\Controllers\views\TechstackController;
use App\Http\Controllers\views\ValidateEmailController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'req'], function () {
    Route::post('/auth/logout', [AuthController::class, 'reqLogout'])->name('req.auth.logout');
    Route::post('/auth/login', [AuthController::class, 'reqLogin'])->name('req.auth.login');
    Route::post('/auth/register', [AuthController::class, 'reqRegister'])->name('req.auth.register');

    Route::post('/resource/create', [ResourceController::class, 'reqCreate'])->name('req.resource.create');
    Route::post('/resource/update', [ResourceController::class, 'reqUpdate'])->name('req.resource.update');
    Route::post('/resource/delete/{id}', [ResourceController::class, 'reqDelete'])->name('req.resource.delete');

    Route::post('/techstack/create', [TechstackController::class, 'reqCreate'])->name('req.techstack.create');
    Route::post('/techstack/update', [TechstackController::class, 'reqUpdate'])->name('req.techstack.update');
    Route::post('/techstack/delete/{id}', [TechstackController::class, 'reqDelete'])->name('req.techstack.delete');
});

Route::group(['middleware' => ['guest']], function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('page.auth.login');
        Route::get('/register', [AuthController::class, 'register'])->name('page.auth.register');
        Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('page.auth.forgot_password');
    });
});

Route::group(['middleware' => ['is_logged_in']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('page.dashboard.index');

    Route::prefix('resource')->group(function () {
        Route::get('/', [ResourceController::class, 'index'])->name('page.resource.index');
        Route::get('/detail/{IdResource}', [ResourceController::class, 'detail'])->name('page.resource.detail');
        Route::get('/edit/{IdResource}', [ResourceController::class, 'edit'])->name('page.resource.edit');
        Route::get('/create', [ResourceController::class, 'create'])->name('page.resource.create');
    });

    Route::prefix('techstack')->group(function () {
        Route::get('/', [TechstackController::class, 'index'])->name('page.techstack.index');
    });
});

