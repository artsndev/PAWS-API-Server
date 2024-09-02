<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnauthenticatedController;

Route::controller(UnauthenticatedController::class)->group(function () {
    Route::get('/unauthenticated', 'unauth')->name('unauthenticated');
});

/*
|--------------------------------------------------------------------------
| API Routes for Veterinarian
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\API\Vet\Auth\LoginController as VetLoginController;
use App\Http\Controllers\API\Vet\Auth\RegisterController as VetRegisterController;
use App\Http\Controllers\API\Vet\DashboardController as VetDashboardController;
use App\Http\Controllers\API\Vet\UserController as VetUserController;
use App\Http\Controllers\API\Vet\Auth\LogoutController as VetLogoutController;


// Vet Login Route
Route::controller(VetLoginController::class)->group(function () {
    Route::post('/vet/login', 'login');
});
// Vet Register Route
Route::controller(VetRegisterController::class)->group(function () {
    Route::post('/vet/register', 'register');
});

// Middleware Route API for Veterinarian.
Route::middleware(['auth:vet-api'])->group(function () {
    // Veterinarian Data Route
    Route::controller(VetDashboardController::class)->group(function () {
        Route::get('/vet/data', 'auth');
    });
    // User Data Route
    Route::controller(VetUserController::class)->group(function () {
        Route::get('/vet/user', 'index');
    });
    // Logout Route
    Route::controller(VetLogoutController::class)->group(function () {
        Route::post('/vet/logout', 'logout');
    });
});


/*
|--------------------------------------------------------------------------
| API Routes for User
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\API\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\API\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\API\User\DashboardController as UserDashboardController;

// User Login Route
Route::controller(UserLoginController::class)->group(function () {
    Route::post('/user/login', 'login');
});
// User Register Route
Route::controller(UserRegisterController::class)->group(function () {
    Route::post('/user/register', 'register');
});

// Middleware Route API for Usererinarian.
Route::middleware(['auth:user-api'])->group(function () {
    // Usererinarian Data Route
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('/user/data', 'auth');
    });
});
