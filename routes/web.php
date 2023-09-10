<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['password.request' => false, 'password.update' => false, 'password.reset' => false]);

Route::post('/handleSignin', [LoginController::class, 'handleSignin'])->name('handleSignin');
Route::post('/handleSignup', [RegisterController::class, 'handleSignup'])->name('handleSignup');

Route::prefix('/dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
