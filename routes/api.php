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
});
