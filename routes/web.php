<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::post('upload-data', [MainController::class, 'uploadCsv'])->name('uploadCsv');
Route::get('read-data', [MainController::class, 'readCsv'])->name('readCsv');
Route::get('truncate-data', [MainController::class, 'truncatePrevData'])->name('truncatePrevData');
Route::get('fact-data', [MainController::class, 'getFacts'])->name('getFacts');
