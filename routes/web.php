<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit.user');
Route::post('user/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update.user');
Route::get('user/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('delete.user');
Route::get('/post', [App\Http\Controllers\mediaController::class, 'index'])->name('post');
Route::match(['post','get'],'/post/upload/{id}', [App\Http\Controllers\mediaController::class, 'create'])->name('upload');
Route::match(['post','get'],'/post/store/{id}', [App\Http\Controllers\mediaController::class, 'store'])->name('store');
Route::match(['post','get'],'/post/delete/{id}', [App\Http\Controllers\mediaController::class, 'destroy'])->name('delete');
Route::match(['post','get'],'/post/update/{id}', [App\Http\Controllers\mediaController::class, 'edit'])->name('update.post');
Route::match(['post','get'],'/post/edit/{id}', [App\Http\Controllers\mediaController::class, 'update'])->name('store.post');
Route::match(['post','get'],'/user/role/{id}', [App\Http\Controllers\HomeController::class, 'editRole'])->name('role.user');
