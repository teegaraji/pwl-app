<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\PresentationController;
use App\Http\Middleware\EnsureAuthenticatedWithToken;
use App\Http\Controllers\Api\TutorialApiController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([EnsureAuthenticatedWithToken::class])->group(function () {
    Route::resource('/tutorials', TutorialController::class);
});

Route::prefix('tutorials/{tutorial}/details')->middleware(EnsureAuthenticatedWithToken::class)->group(function () {
    Route::get('/', [DetailController::class, 'index'])->name('details.index');
    Route::get('/create', [DetailController::class, 'create'])->name('details.create');
    Route::post('/', [DetailController::class, 'store'])->name('details.store');
    Route::get('/{detail}/edit', [DetailController::class, 'edit'])->name('details.edit');
    Route::put('/{detail}', [DetailController::class, 'update'])->name('details.update');
    Route::delete('/{detail}', [DetailController::class, 'destroy'])->name('details.destroy');
    Route::patch('/{detail}/update-status', [DetailController::class, 'updateStatus'])->name('details.updateStatus');
});

Route::get('/presentation/{slug}', [TutorialController::class, 'presentation'])->name('tutorial.presentation');
Route::get('/finished/{slug}', [TutorialController::class, 'finished'])->name('tutorial.finished');
Route::get('/finished/{slug}/pdf', [TutorialController::class, 'generatePDF'])->name('tutorial.pdf');

Route::get('/{kode_matkul}', [TutorialApiController::class, 'getTutorialsByMatkul']);
