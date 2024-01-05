<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware;

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

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/karyawan', [KaryawanController::class, 'showCreateForm'])->name('karyawan');
Route::get('/showkaryawan', [KaryawanController::class, 'showkaryawan']);
Route::get('/editkaryawan/{karyawan}', [KaryawanController::class, 'edit']);

Route::get('/cuti', [CutiController::class, 'showCreateForm'])->name('cuti');
Route::get('/showcuti', [CutiController::class, 'showcuti']);
Route::get('/editcuti/{cuti}', [CutiController::class, 'edit']);

Route::get('/', function () {
    return view('welcome');
});
