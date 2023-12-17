<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\LogController;

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

Route::get('/', [AuthController::class, 'loginForm' ])->name('login');
Route::get('/register', [AuthController::class, 'registerForm' ]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


     Route::get('/motors', [MotorController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('motors.index');
     Route::get('/motors/create', [MotorController::class, 'create'])->middleware(['auth', 'role:admin'])->name('motors.create');
     Route::post('/motors', [MotorController::class, 'store'])->name('motors.store');
     Route::get('/motors/{motor}', [MotorController::class, 'show'])->name('motors.show');
     Route::get('/motors/{motor}/edit', [MotorController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('motors.edit');
     Route::put('/motors/{motor}', [MotorController::class, 'update'])->name('motors.update');
     Route::delete('/motors/{motor}', [MotorController::class, 'destroy'])->name('motors.destroy');
     Route::get('/motors/purchase/{motor}', [MotorController::class, 'purchaseForm'])->name('motors.purchaseForm');
     Route::post('/motors/{motor}/purchase', [MotorController::class, 'purchase'])->name('motors.purchase');
     Route::get('/motor-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('motor-logs');
     // routes/web.php

Route::get('/motors/{motor}/purchased/{purchase}', [MotorController::class, 'purchaseShow'])->name('motors.purchase.show');
Route::get('/purchased-motors', [MotorController::class, 'purchasedMotors'])->name('purchased-motors.index');




Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);






