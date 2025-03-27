<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AttanController;
use App\Http\Controllers\ApplyLeaveController;
use App\Http\Controllers\ApplyClaimController;
use App\Http\Controllers\ApplyAttanController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\MusicController;

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
// Login
Route::get('/', [LoginController::class, 'showlogin'])->name('showlogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'showdash'])->name('showdash');

// Leave
Route::get('/leave', [LeaveController::class, 'showleave'])->name('showleave');
Route::get('applyleave', [ApplyLeaveController::class, 'showapplyleave'])->name('showapplyleave');
Route::post('/applyleave', [ApplyLeaveController::class, 'applyleave'])->name('applyleave');

// Claim
Route::get('/claim', [ClaimController::class, 'showclaim'])->name('showclaim');
Route::get('/claims', [ClaimController::class, 'getClaims'])->name('getclaims');
Route::get('/applyclaim', [ApplyClaimController::class, 'showapplyclaim'])->name('showapplyclaim');
Route::post('/applyclaims', [ApplyClaimController::class, 'applyclaims'])->name('applyclaims');

// Attandance
Route::get('/attandance', [AttanController::class, 'showattan'])->name('showattan');
Route::get('/attandances', [AttanController::class, 'getattans'])->name('getattan');
Route::get('/show-apply-attan', [ApplyAttanController::class, 'showapplyattan'])->name('showapplyattan');
Route::post('/apply-attan', [ApplyAttanController::class, 'applyattan'])->name('applyattan');

// Music
Route::get('/music', [MusicController::class, 'listmusic'])->name('listmusic');
Route::get('/download-music', [MusicController::class, 'downloadmusic'])->name('downmusic');
Route::post('/download-mp3', [MusicController::class, 'downloadMP3'])->name('download-mp3');
Route::get('/play-audio', function () {
    return view('playmusic');
})->name('playmusic');
