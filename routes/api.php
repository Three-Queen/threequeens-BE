<?php

use App\Http\Controllers\Api\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/landing', [LandingPageController::class, 'index']);
Route::post('/pesan', [LandingPageController::class, 'submitMessage']);
