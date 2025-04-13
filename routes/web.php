<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DetailController;
use App\Http\Middleware\EnsureAuthenticatedWithToken;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware([EnsureAuthenticatedWithToken::class])->group(function () {
    Route::resource('/tutorials', TutorialController::class);
    Route::resource('/details', DetailController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
