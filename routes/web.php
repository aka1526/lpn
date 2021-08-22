<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\admins\AdminHomeController;

Route::get('/', [HomeController::class, 'home']);



Route::get('/pageadmin', [AdminHomeController::class, 'admin']);

Route::get('/pageadmin/dashboard', [AdminHomeController::class, 'admin'])->name('admin_dashboard');
 