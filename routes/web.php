<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Auth\LoginRegisterController;
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
Route::get('/activitydetails/{activityId}', [ActivitiesController::class, 'showActivityDetails'])->name('activitydetails');
Route::get('/activityregistration/{returnL}/{activityId}', [ActivitiesController::class, 'registerForActivity'])->name('activityregistration');
Route::get('/activityderegistration/{returnL}/{activityId}', [ActivitiesController::class, 'deregisterForActivity'])->name('activityderegistration');
Route::post('/activityregistrationguests/{returnL}/{activityId}', [ActivitiesController::class, 'registerGuestForActivity'])->name('activityregistrationguests');
Route::get('/create_activity', [ActivitiesController::class, 'createFormRef'])->name('createFormRef');
Route::post('/store_activity', [ActivitiesController::class, 'store'])->name('storeActivity');

Route::delete('/delete_activity/{id}', [ActivitiesController::class, 'destroy'])->name('activity.destroy');
Route::get('/dashboard/edit/{id}', [ActivitiesController::class, 'edit'])->name('activities.edit');
Route::put('/dashboard/update/{id}', [ActivitiesController::class, 'update'])->name('activities.update');

Route::get('/userdashboard', [LoginRegisterController::class, 'userdashboard'])->name('userdashboard');
Route::put('/userdashboard/update/{id}', [LoginRegisterController::class, 'updateUser'])->name('user.update');
Route::get('/userdashboard/edit/{id}', [LoginRegisterController::class, 'editUser'])->name('user.edit');
Route::delete('/userdashboard/delete/{id}', [LoginRegisterController::class, 'destroyUser'])->name('user.destroy');
Route::get('/dashboard/search', [ActivitiesController::class, 'dashboardSearch'])->name('dashboardSearch');
