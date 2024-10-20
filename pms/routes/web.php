<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SampleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin', [SignInController::class, 'index'])->name('signin.index');
Route::post('/signin/submit', [SignInController::class, 'submit'])->name('signin.submit');
Route::get('/password-reset/send-reset-link', [ResetPasswordController::class, 'index'])->name('password-reset.send-reset-link.index');
Route::get('/password-reset', [ResetPasswordController::class, 'passwordReset'])->name('password-reset.index');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/datatable/project-summary', [AdminDashboardController::class, 'projectSummaryDataTable'])->name('admin.datatable.projectSummary');
        Route::get('/datatable/task-summary', [AdminDashboardController::class, 'taskSummaryDataTable'])->name('admin.datatable.taskSummary');
        Route::get('/datatable/logs', [AdminDashboardController::class, 'logsDataTable'])->name('admin.datatable.logs');
    });

    Route::group(['middleware' => 'user'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    });


});

Route::post('/signout', [SignoutController::class, 'signout'])->name('signout');
Route::get('sample', [SampleController::class, 'index'])->name('sample');
