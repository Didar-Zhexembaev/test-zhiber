<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'as' => 'api.'], function() {
    Route::post('signin', [AuthController::class, 'signin'])->name('signin');
    Route::get('signout', [AuthController::class, 'signout'])
        ->middleware('auth:sanctum')
        ->name('signout');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('report', [ReportController::class, 'report'])
        ->middleware('auth:sanctum')
        ->name('report');
    Route::post('report/form', [ReportController::class, 'form'])
        ->middleware('auth:sanctum')
        ->name('reportForm');
    Route::get('report/all', [ReportController::class, 'reportAll'])
        ->middleware('auth:sanctum')
        ->name('reportAll');
});