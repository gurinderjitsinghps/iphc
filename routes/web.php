<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FrontUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
->name('password.store');
Route::get('reset-password-success', [NewPasswordController::class, 'success'])
->name('password.reset.success');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');
Route::get('buyer/verify-email/{id}/{hash}', [FrontUserController::class, 'verifyEmail'])->name('frontuser.register.storeverify');
Route::put('password', [PasswordController::class, 'update'])->name('password.update');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
require __DIR__.'/superadmin.php';
