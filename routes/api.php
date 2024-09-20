<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnauthenticatedController;
use App\Http\Controllers\CreditController as Credit;

Route::controller(UnauthenticatedController::class)->group(function () {
    Route::get('/unauthenticated', 'unauth')->name('unauthenticated');
});

Route::controller(Credit::class)->group(function () {
    Route::get('/credits', 'credits');
});


/*
|--------------------------------------------------------------------------
| API Routes for Veterinarian
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\API\Vet\Auth\LoginController as VetLoginController;
use App\Http\Controllers\API\Vet\Auth\RegisterController as VetRegisterController;
use App\Http\Controllers\API\Vet\DashboardController as VetDashboardController;
use App\Http\Controllers\API\Vet\ScheduleController as VetScheduleController;
use App\Http\Controllers\API\Vet\AppointmentController as VetAppointmentController;
use App\Http\Controllers\API\Vet\ResultController as VetResultController;
use App\Http\Controllers\API\Vet\UserController as VetUserController;
use App\Http\Controllers\API\Vet\QueuingController as VetQueuingController;
use App\Http\Controllers\API\Vet\Auth\LogoutController as VetLogoutController;
use App\Http\Controllers\API\Vet\PDFController as VetPDFController;

Route::controller(VetPDFController::class)->group(function () {
    Route::get('/download/{id}', 'download');
});

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
        Route::get('/vet/count', 'index');
    });
    // Veterinarian Data Route
    Route::controller(VetScheduleController::class)->group(function () {
        Route::get('/vet/schedule', 'index');
        Route::post('/vet/schedule', 'store');
    });
    // Veterinarian Data Route
    Route::controller(VetAppointmentController::class)->group(function () {
        Route::get('/vet/appointment', 'index');
        // Route::post('/vet/schedule', 'store');
    });
    // Veterinarian Data Route
    Route::controller(VetResultController::class)->group(function () {
        Route::get('/vet/result', 'index');
        Route::post('/vet/result', 'store');
    });
    // User Data Route
    Route::controller(VetUserController::class)->group(function () {
        Route::get('/vet/user', 'index');
        Route::put('/vet/user/{id}', 'update');
        Route::delete('/vet/user/{id}', 'destroy');
    });
    // Doctor Queuing Controller
    Route::controller(VetQueuingController::class)->group(function () {
        Route::get('/vet/queue', 'index');
        Route::post('/vet/queue', 'store');
        Route::delete('/vet/queue/{id}', 'destroy');
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
use App\Http\Controllers\API\User\PetController as UserPetController;
use App\Http\Controllers\API\User\AppointmentController as UserAppointmentController;
use App\Http\Controllers\API\User\Auth\LogoutController as UserLogoutController;
use App\Http\Controllers\CreditController;


// User Login Route
Route::controller(UserLoginController::class)->group(function () {
    Route::post('/user/login', 'login');
});
// User Register Route
Route::controller(UserRegisterController::class)->group(function () {
    Route::post('/user/register', 'register');
});

// Middleware Route API for User.
Route::middleware(['auth:user-api'])->group(function () {
    // User Data Route
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('/user/data', 'auth');
    });
    // Pet Data Route
    Route::controller(UserPetController::class)->group(function () {
        Route::get('/user/pet', 'index');
        Route::post('/user/pet', 'store');
        Route::get('/user/pet/{id}', 'show');
    });
    // Appointment Data Route
    Route::controller(UserAppointmentController::class)->group(function () {
        Route::get('/user/appointment/pet', 'pet');
        Route::get('/user/appointment/vet', 'vet');
        Route::get('/user/appointment', 'index');
        Route::post('/user/appointment', 'store');
        Route::get('/user/appointment/{id}', 'show');
    });
    // Logout Route
    Route::controller(UserLogoutController::class)->group(function () {
        Route::post('/user/logout', 'logout');
    });
});
