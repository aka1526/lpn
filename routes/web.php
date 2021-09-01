<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\admins\AdminHomeController;
use App\Http\Controllers\Admins\AdminUserController;
use App\Http\Controllers\Admins\AdminmenuController;
use App\Http\Controllers\Admins\CourseController;
use App\Http\Controllers\Admins\CourseItemController;
use App\Http\Controllers\Admins\CKEditorController;
use App\Http\Controllers\Admins\SlidepageController;

###### frontend ###################
Route::get('/', [HomeController::class, 'home'])->name('fn.home');

###### Backend ###################

Route::get('/pageadmin/dashboard', [AdminHomeController::class, 'admin'])->name('admin_dashboard');

Route::get('/pageadmin', [AdminUserController::class, 'index'])->name('admin.index');

Route::get('/pageadmin/adminlogin', [AdminUserController::class, 'pagelogin'])->name('admin.pagelogin');
Route::post('/pageadmin/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::get('/pageadmin/logout', [AdminUserController::class, 'adminlogout'])->name('admin.logout');

Route::get('/pageadmin/user', [AdminUserController::class, 'user'])->name('admin.user');
Route::post('/pageadmin/user', [AdminUserController::class, 'register'])->name('admin.register');
 
Route::get('/pageadmin/getuser', [AdminUserController::class, 'getuser'])->name('admin.getuser');
Route::post('/pageadmin/user/update', [AdminUserController::class, 'updateuser'])->name('admin.update');
Route::post('/pageadmin/user/updatepwd', [AdminUserController::class, 'updatepwd'])->name('admin.updatepwd');
Route::post('/pageadmin/user/updatestatus', [AdminUserController::class, 'updatestatus'])->name('admin.updatestatus');
Route::post('/pageadmin/user/delete', [AdminUserController::class, 'userdelete'])->name('admin.userdelete');


//Route::get('/pageadmin/menu', [AminmenuController::class, 'index'])->name('admin.menu.index');

// Route::resources([
//     '/pageadmin/menu' => AdminmenuController::class,
  
// ]);

 Route::get('/pageadmin/menu', [AdminmenuController::class, 'index'])->name('menu.index');
 Route::get('/pageadmin/menu/{menu}/get', [AdminmenuController::class, 'get'])->name('menu.get');
 Route::post('/pageadmin/menu/store', [AdminmenuController::class, 'store'])->name('menu.store');
 Route::post('/pageadmin/menu/update', [AdminmenuController::class, 'update'])->name('menu.update');

 Route::get('/pageadmin/course', [CourseController::class, 'index'])->name('course.index');
 Route::get('/pageadmin/course/get', [CourseController::class, 'get'])->name('course.get');
 Route::get('/pageadmin/course/items/{courseuid}', [CourseController::class, 'items'])->name('course.items');


 Route::post('/pageadmin/course/add', [CourseController::class, 'add'])->name('course.add'); 
 Route::post('/pageadmin/course/update', [CourseController::class, 'update'])->name('course.update'); 
 Route::post('/pageadmin/course/delete', [CourseController::class, 'delete'])->name('course.delete'); 
 Route::post('/pageadmin/course/updatestatus', [CourseController::class, 'updatestatus'])->name('course.updatestatus'); 


 Route::post('/ckeditor_upload/uploadfunc', [CKEditorController::class, 'upload'] )->name('ckeditor.upload');

 Route::get('/pageadmin/course/items/add/{courseuid}', [CourseItemController::class, 'index'])->name('course.itemsindex');
 Route::get('/pageadmin/course/items/edit/{courseitemuid}', [CourseItemController::class, 'edit'])->name('course.itemsedit');
 
 Route::post('/pageadmin/course/items/new', [CourseItemController::class, 'addnew'])->name('course.itemsaddnew');
 Route::post('/pageadmin/course/items/update', [CourseItemController::class, 'update'])->name('course.itemsupdate');
 Route::post('/pageadmin/course/items/delete', [CourseItemController::class, 'delete'])->name('course.itemsdelete');
 Route::post('/pageadmin/course/items/status', [CourseItemController::class, 'updatestatus'])->name('course.itemsstatus');

 Route::get('/pageadmin/slidepage', [SlidepageController::class, 'index'])->name('slidepage.index');
 Route::get('/pageadmin/slidepage/new', [SlidepageController::class, 'new'])->name('slidepage.new'); 
 Route::get('/pageadmin/slidepage/edit/{uid}', [SlidepageController::class, 'edit'])->name('slidepage.edit'); 

 Route::post('/pageadmin/slidepage/add', [SlidepageController::class, 'add'])->name('slidepage.add');
 Route::post('/pageadmin/slidepage/update', [SlidepageController::class, 'update'])->name('slidepage.update');
 Route::post('/pageadmin/slidepage/status', [SlidepageController::class, 'status'])->name('slidepage.status');
 Route::post('/pageadmin/slidepage/delete', [SlidepageController::class, 'delete'])->name('slidepage.delete');