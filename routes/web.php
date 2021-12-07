<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalamController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// seting user cannot register
Route::match(['get', 'post'], '/register', function () {
    return redirect('/login');
})->name('register');




// user route
Route::resource('users', UserController::class);
//Delete Category Route
Route::delete('categories/{category}/delete-permanent', [CategoryController::class, 'deletePermanent'])->name('categories.delete-permanent');
// restore route
Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
// category Trash
Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
// category Route
Route::resource('categories', CategoryController::class);
Route::get('/ajax/categories/search', [CategoryController::class, 'ajaxSearch']);


// Book Route
// resource book
Route::resource('books', BookController::class);
