<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('download-template/{file}', function ($file) {
    $path = storage_path("app/templates/{$file}");

    if (file_exists($path)) {
        return Storage::download("templates/{$file}");
    }
})->name('download_template');

Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::post('students', [StudentController::class, 'store'])->name('students.store');
