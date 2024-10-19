<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
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

Route::get('sample', [SampleController::class, 'index'])->name('sample');
