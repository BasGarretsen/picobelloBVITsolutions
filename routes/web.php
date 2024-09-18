<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\ActivitiesController;
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

Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
Route::get('/', [ActivitiesController::class, 'index'])->name('index');
Route::get('/create_activity', [ActivitiesController::class, 'createFormRef'])->name('createFormRef');
Route::post('/store_activity', [ActivitiesController::class, 'store'])->name('storeActivity');
