<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Booth\BoothController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Project\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::get('homes', [HomeController::class, 'show']);
Route::post('homes', [HomeController::class, 'update'])->middleware("auth:sanctum");
// Route::get('homes/{home}', [HomeController::class, 'show']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{project}', [ProjectController::class, 'show']);
Route::get('booths', [BoothController::class, 'index']);
Route::get('booths/{booth}', [BoothController::class, 'show']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // Route::apiResource('homes', HomeController::class)->except(['show']);
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('projects', ProjectController::class)->except(['index', 'show']);
    Route::apiResource('booths', BoothController::class)->except(['index', 'show']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});
