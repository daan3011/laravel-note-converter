<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [ConvertController::class, 'index']);

Route::post('/', [ConvertController::class, 'convertPost']);


Route::get('/shared-file/{sharelink}', [ProfileController::class, 'sharedNote']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/view-note/{id}', [ProfileController::class, 'viewNote']);
    Route::get('/delete-note/{id}', [ProfileController::class, 'deleteNote']);
    Route::get('/edit-note/{id}', [ProfileController::class, 'editNote']);
    Route::post('/edit-note/{id}', [ProfileController::class, 'editNotePost'])->name('edit-note');
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/make-admin/{id}', [AdminController::class, 'makeAdmin']);
    Route::get('/make-user/{id}', [AdminController::class, 'makeUser']);
    Route::get('/admin-notes/{id}', [AdminController::class, 'userNotes']);
    Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/delete-user-note/{id}', [AdminController::class, 'deleteUserNote']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

