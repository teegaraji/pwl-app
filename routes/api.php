<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TutorialApiController;

Route::get('/{kode_matkul}', [TutorialApiController::class, 'getTutorialsByMatkul']);
