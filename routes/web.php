<?php

use App\Http\Controllers\API\APIBoardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\BoardController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DreamController;
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

Auth::routes(['password.request' => false, 'password.update' => false, 'password.reset' => false]);

Route::post('/handleSignin', [LoginController::class, 'handleSignin'])->name('handleSignin');
Route::post('/handleSignup', [RegisterController::class, 'handleSignup'])->name('handleSignup');

Route::prefix('/dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('dashboard.logout');

    Route::prefix('/board')->middleware(['auth'])->group(function () {
        Route::get('/', [BoardController::class, 'index'])->name('dashboard.board.index');
        Route::get('/create', [BoardController::class, 'create'])->name('dashboard.board.create');
        Route::post('/store', [BoardController::class, 'store'])->name('dashboard.board.store');
        Route::get('/edit/{id}', [BoardController::class, 'edit'])->name('dashboard.board.edit');
        Route::post('/update/{id}', [BoardController::class, 'update'])->name('dashboard.board.update');
        Route::get('/dreamer/{id}', [BoardController::class, 'show'])->name('dashboard.board.show');
        Route::get('/destroy/{id}', [BoardController::class, 'destroy'])->name('dashboard.board.destroy');
    });
});

Route::prefix('/helper')->middleware(['auth'])->group(function () {
    Route::get('/dreamer/{board_id}/{dream_id}', [APIBoardController::class, 'dreamer'])->name('api.dreamer');
    Route::get('/rmdreamer/{board_id}/{dream_id}', [APIBoardController::class, 'rmdreamer'])->name('api.rmdreamer');
    Route::post('/dreamposition', [APIBoardController::class, 'dreamposition'])->name('api.dreamposition');
});

Route::prefix('/board')->middleware(['auth'])->group(function () {
    Route::get('/{username}/{board_id}', [BoardController::class, 'board'])->name('board');
    Route::post('/dream/{board_id}', [DreamController::class, 'store'])->name('board.dream.store');
    Route::post('/openaccess', [DreamController::class, 'openaccess'])->name('board.dream.openaccess');
});

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});
