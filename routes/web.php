<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

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



// Route::post('/comment', 'CommrntController')->name('');
Route::post('/store', [CommentController::class, 'store'])->name('store');
Route::get('/', [CommentController::class, 'index'])->name('index');
Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('edit');

Route::post('/update', [CommentController::class, 'update'])->name('update');

Route::get('/delete_post/{id}', [CommentController::class, 'destroy'])->name('destroy');




