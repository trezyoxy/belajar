<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\BMKGController;
use App\Http\Controllers\FileUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route default (halaman welcome)
Route::get('/', function () {
    return view('welcome');
});

// ✅ Semua orang bisa melihat daftar task
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// ✅ Proteksi semua fitur CRUD dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [\App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
});

// ✅ Rute API BMKG
Route::get('/gempa', [\App\Http\Controllers\Api\BMKGController::class, 'getGempa']);

// ✅ Upload file
Route::get('/upload', [\App\Http\Controllers\FileUploadController::class, 'showForm'])->name('upload.form');
Route::post('/upload', [\App\Http\Controllers\FileUploadController::class, 'uploadFile'])->name('upload.file');

// ✅ Download file
Route::get('/tasks/{task}/download', [\App\Http\Controllers\TaskController::class, 'download'])->middleware('auth')->name('tasks.download');
