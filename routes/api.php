<?php

use App\Http\Controllers\api\MstCategoryController;
use App\Http\Controllers\api\MstResourceController;
use App\Http\Controllers\api\MstRoleController;
use App\Http\Controllers\api\MstSectionController;
use App\Http\Controllers\api\MstTechstackController;
use App\Http\Controllers\api\MstTypeController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ValidateEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [UserController::class, 'login'])->name('api.auth.login');
    Route::post('/register', [UserController::class, 'register'])->name('api.auth.register');
    Route::get('/validate-email/{hashed_id}', [ValidateEmailController::class, 'index'])->name('api.auth.validate_email');
});

Route::group(['prefix' => 'resource'], function () {
    Route::get('/', [MstResourceController::class, 'index'])->name('api.resource.index');
    Route::get('/detail-edit', [MstResourceController::class, 'show'])->name('api.resource.show');
    Route::post('/', [MstResourceController::class, 'createOrUpdate'])->name('api.resource.create_or_update');
    Route::delete('/', [MstResourceController::class, 'destroy'])->name('api.resource.destroy');
    Route::post('/restore', [MstResourceController::class, 'restore'])->name('api.resource.restore');
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/auth/logout', [UserController::class, 'logout'])->name('api.auth.logout');

    Route::group(['prefix' => 'techstack'], function () {
        Route::get('/', [MstTechstackController::class, 'index'])->name('api.techstack.index');
        Route::post('/', [MstTechstackController::class, 'createOrUpdate'])->name('api.techstack.create_or_update');
        Route::delete('/', [MstTechstackController::class, 'destroy'])->name('api.techstack.destroy');
        Route::post('/restore', [MstTechstackController::class, 'restore'])->name('api.techstack.restore');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [MstCategoryController::class, 'index'])->name('api.category.index');
        Route::post('/', [MstCategoryController::class, 'createOrUpdate'])->name('api.category.create_or_update');
        Route::delete('/', [MstCategoryController::class, 'destroy'])->name('api.category.destroy');
        Route::post('/restore', [MstCategoryController::class, 'restore'])->name('api.category.restore');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [MstRoleController::class, 'index'])->name('api.role.index');
        Route::post('/', [MstRoleController::class, 'createOrUpdate'])->name('api.role.create_or_update');
        Route::delete('/', [MstRoleController::class, 'destroy'])->name('api.role.destroy');
        Route::post('/restore', [MstRoleController::class, 'restore'])->name('api.role.restore');
    });
    Route::group(['prefix' => 'section'], function () {
        Route::get('/', [MstSectionController::class, 'index'])->name('api.section.index');
        Route::post('/', [MstSectionController::class, 'createOrUpdate'])->name('api.section.create_or_update');
        Route::delete('/', [MstSectionController::class, 'destroy'])->name('api.section.destroy');
        Route::post('/restore', [MstSectionController::class, 'restore'])->name('api.section.restore');
    });
    Route::group(['prefix' => 'type'], function () {
        Route::get('/', [MstTypeController::class, 'index'])->name('api.type.index');
        Route::post('/', [MstTypeController::class, 'createOrUpdate'])->name('api.type.create_or_update');
        Route::delete('/', [MstTypeController::class, 'destroy'])->name('api.type.destroy');
        Route::post('/restore', [MstTypeController::class, 'restore'])->name('api.type.restore');
    });
});

