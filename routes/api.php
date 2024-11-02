<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/mahasiswas', [MahasiswaController::class, 'index']);
});

// Admin protected routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('mahasiswas', MahasiswaController::class)->except(['index']);
});
