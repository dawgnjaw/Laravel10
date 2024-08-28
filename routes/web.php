<?php

use App\Http\Controllers\HomeModelController;
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

Route::get('/aku', function () {
    return view('santri');
});

Route::get('/home', [HomeModelController::class,'index'])->name('santri');

Route::get('/login', [HomeModelController::class,'login'])->name('login');
Route::post('/insert', [HomeModelController::class,'insert'])->name('insert');

Route::get('/showData/{id}', [HomeModelController::class,'showData'])->name('showData');
Route::post('/updateData/{id}', [HomeModelController::class,'updateData'])->name('updateData');

Route::get('/deleteData/{id}', [HomeModelController::class,'deleteData'])->name('deleteData');

Route::get('/exportPdf', [HomeModelController::class,'exportPdf'])->name('exportPdf');
Route::get('/exportExcel', [HomeModelController::class,'exportExcel'])->name('exportExcel');

Route::post('/importExcel', [HomeModelController::class,'importExcel'])->name('importExcel');
