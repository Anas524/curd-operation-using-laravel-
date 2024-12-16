<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StregController;

Route::get('/', [StregController::class, 'viewPage'])->name('home');
Route::post('/addData', [StregController::class, 'addData']);

Route::get('edit/{id}', [StregController::class, 'edit'])->name('edit');
Route::put('update-data/{id}', [StregController::class, 'updateData']);

Route::get('delete/{id}', [StregController::class, 'delete']);
