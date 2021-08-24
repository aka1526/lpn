<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\admins\AdminHomeController;
use App\Http\Controllers\Admins\AdminUserController;


Route::get('/', [HomeController::class, 'home']);



Route::get('/pageadmin', [AdminHomeController::class, 'admin']);

Route::get('/pageadmin/dashboard', [AdminHomeController::class, 'admin'])->name('admin_dashboard');
 
Route::get('/pageadmin/user', [AdminUserController::class, 'index'])->name('admin.user');
Route::post('/pageadmin/user', [AdminUserController::class, 'register'])->name('admin.register');
Route::post('/pageadmin/user/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::post('/pageadmin/user/me', [AdminUserController::class, 'me'])->middleware('auth:sanctum');

// Route::resources([
//     '/pageadmin/user' => AdminUserController::class,
    
// ]);     