<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index'])->middleware('auth');

Route::prefix('books')->name('book.')->middleware('auth')->group(function (){
    Route::get('/',[BookController::class, 'index'])->name('index');
    Route::get('/create',[BookController::class, 'create'])->name('create');
    Route::get('{book}/edit',[BookController::class, 'edit'])->name('edit');
    Route::post('/book',[BookController::class, 'store'])->name('store');
    Route::patch('/book/{book}',[BookController::class, 'update'])->name('update');
    Route::delete('/delete/{book}',[BookController::class, 'delete'])->name('destory');
    Route::get('/export',[BookController::class, 'export'])->name('export');
    Route::post('/import',[BookController::class, 'import'])->name('import');
});


Route::prefix('user')->name('user.')->group(function (){
    Route::get('/login',[LoginController::class, 'login'])->name('login');
    Route::post('/login',[LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
});

