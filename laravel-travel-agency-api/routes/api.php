<?php

use App\Http\Controllers\API\v1\Admin;
use App\Http\Controllers\API\v1\Auth\LoginController;
use App\Http\Controllers\API\v1\TourController;
use App\Http\Controllers\API\v1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::apiResource('travels', TravelController::class);
Route::get('travels/{travel}/tours', [TourController::class, 'index']);

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('travels', [Admin\TravelController::class, 'store']);
});

Route::post('auth/login', LoginController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
