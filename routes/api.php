<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\BMKGController;
use App\Http\Controllers\FileUploadController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tasks', TaskApiController::class);
Route::post('/upload', [FileUploadController::class, 'uploadFile'])->name('upload.file');
Route::get('/bmkg/gempa', [\App\Http\Controllers\Api\BMKGController::class, 'getGempa']);
Route::get('/bmkg/gempa', [BMKGController::class, 'getGempa']);
Route::get('/debug', function() {
    die('API Routes Loaded');
});
