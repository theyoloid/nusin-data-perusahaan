<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabaController;
use App\Http\Controllers\KjnLabaController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JatimLabaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DanielLabaController;
use App\Http\Controllers\KjnPiutangController;
use App\Http\Controllers\JatimPiutangController;
use App\Http\Controllers\KjnPenjualanController;
use App\Http\Controllers\DanielPiutangController;
use App\Http\Controllers\JatimPenjualanController;
use App\Http\Controllers\DanielPenjualanController;
use App\Http\Controllers\LoginController;

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



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/', [DashboardController::class, 'index']);


    Route::get('/penjualan', [PenjualanController::class, 'index']);

    Route::get('/export/penjualan/', [PenjualanController::class, 'exportPdf']);

    Route::get('/laba',[LabaController::class, 'index'] );
    Route::get('/export/laba/', [LabaController::class, 'exportPdf']);

    Route::get('/piutang', [PiutangController::class, 'index']);
    Route::get('/export/piutang/', [PiutangController::class, 'exportPdf']);

    // JATIM
    Route::get('/jatim/penjualan', [JatimPenjualanController::class, 'index']);

    Route::get('jatim/export/jatim/penjualan/', [JatimPenjualanController::class, 'exportPdf']);

    Route::get('/jatim/laba',[JatimLabaController::class, 'index'] );
    Route::get('jatim/export/jatim/laba/', [JatimLabaController::class, 'exportPdf']);

    Route::get('/jatim/piutang', [JatimPiutangController::class, 'index']);
    Route::get('jatim/export/jatim/piutang/', [JatimPiutangController::class, 'exportPdf']);

    // DANIEL
    Route::get('/daniel/penjualan', [DanielPenjualanController::class, 'index']);
    Route::get('daniel/export/daniel/penjualan/', [DanielPenjualanController::class, 'exportPdf']);

    Route::get('/daniel/laba',[DanielLabaController::class, 'index'] );
    Route::get('daniel/export/daniel/laba/', [DanielLabaController::class, 'exportPdf']);

    Route::get('/daniel/piutang', [DanielPiutangController::class, 'index']);
    Route::get('daniel/export/daniel/piutang/', [DanielPiutangController::class, 'exportPdf']);

    // KJN
    Route::get('/kjn/penjualan', [KjnPenjualanController::class, 'index']);
    Route::get('kjn/export/kjn/penjualan/', [KjnPenjualanController::class, 'exportPdf']);

    Route::get('/kjn/laba',[KjnLabaController::class, 'index'] );
    Route::get('kjn/export/kjn/laba/', [KjnLabaController::class, 'exportPdf']);

    Route::get('/kjn/piutang', [KjnPiutangController::class, 'index']);
    Route::get('kjn/export/kjn/piutang/', [KjnPiutangController::class, 'exportPdf']);

});
// 