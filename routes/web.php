<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
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
    return view('/auth/login');
});

// auth routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout')->middleware('auth.normal_and_admin');

// client routes
Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index')->middleware('auth.normal_and_admin');
Route::get('/clients/fetch_all', [ClientsController::class, 'fetchAll'])->name('clients.fetch_all')->middleware('auth.normal_and_admin');
Route::get('/clients/fetch/{client_id}', [ClientsController::class, 'fetch'])->name('clients.fetch')->middleware('auth.normal_and_admin');
Route::get('/clients/create', [ClientsController::class, 'create'])->name('clients.create')->middleware('auth.normal_and_admin');
Route::post('/clients', [ClientsController::class, 'store'])->name('clients.store')->middleware('auth.normal_and_admin');
Route::get('/clients/edit/{client_id}', [ClientsController::class, 'edit'])->name('clients.edit')->middleware('auth.normal_and_admin');
Route::put('/clients/{client_id}', [ClientsController::class, 'update'])->name('clients.update')->middleware('auth.normal_and_admin');
Route::delete('/clients/{client_id}', [ClientsController::class, 'destroy'])->name('clients.destroy')->middleware('auth.normal_and_admin');

// user routes
Route::get('/users', [UsersController::class, 'index'])->name('users.index')->middleware('auth.admin_only');
Route::get('/users/fetch_all', [UsersController::class, 'fetchAll'])->name('users.fetch_all')->middleware('auth.admin_only');
Route::get('/users/fetch/{user_id}', [UsersController::class, 'fetch'])->name('users.fetch')->middleware('auth.admin_only');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create')->middleware('auth.admin_only');
Route::post('/users', [UsersController::class, 'store'])->name('users.store')->middleware('auth.admin_only');
Route::get('/users/edit/{user_id}', [UsersController::class, 'edit'])->name('users.edit')->middleware('auth.admin_only');
Route::put('/users/{user_id}', [UsersController::class, 'update'])->name('users.update')->middleware('auth.admin_only');
Route::delete('/users/{user_id}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('auth.admin_only');

Route::get('/search', [ClientsController::class, 'search']);