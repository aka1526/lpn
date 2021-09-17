<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CourseFnController;

use App\Http\Controllers\Admins\AdminHomeController;
use App\Http\Controllers\Admins\AdminUserController;
use App\Http\Controllers\Admins\AdminmenuController;
use App\Http\Controllers\Admins\CourseController;
use App\Http\Controllers\Admins\CourseItemController;
use App\Http\Controllers\Admins\CKEditorController;
use App\Http\Controllers\Admins\SlidepageController;
use App\Http\Controllers\Admins\NewsController;
use App\Http\Controllers\Admins\SysinfoController;
use App\Http\Controllers\Admins\AboutusController;

###### frontend ###################
Route::fallback(function () {
  return view('/frontend/pages/404');
});
Route::get('/', [HomeController::class, 'index'])->name('fn.index');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('fn.aboutus');
Route::get('/aboutus/{url}', [HomeController::class, 'aboutus_page'])->name('fn.aboutus_page');

Route::get('/news', [HomeController::class, 'news'])->name('fn.news');
 


// Route::get('/aboutus/about', [HomeController::class, 'aboutus_about'])->name('fn.aboutus_about');
// Route::get('/aboutus/history', [HomeController::class, 'aboutus_history'])->name('fn.aboutus_history');
// Route::get('/aboutus/committees', [HomeController::class, 'aboutus_committees'])->name('fn.aboutus_committees');
// Route::get('/aboutus/constitution', [HomeController::class, 'aboutus_constitution'])->name('fn.aboutus_constitution');
// Route::get('/aboutus/contact', [HomeController::class, 'aboutus_contact'])->name('fn.aboutus_contact');



// Route::get('/aboutus/About', function () {
//   return view('frontend/pages/aboutus_About');
// });
// Route::get('/aboutus/Page-History', function () {
//   return view('frontend/pages/aboutus_Page-History');
// });
// Route::get('/aboutus/Committees', function () {
//   return view('frontend/pages/aboutus_Committees');
// });
// Route::get('/aboutus/Constitution', function () {
//   return view('frontend/pages/aboutus_Constitution');
// });

// Route::get('/aboutus/Contact', function () {
//   return view('frontend/pages/aboutus_Contact');
// });




Route::get('/contact', [HomeController::class, 'contact'])->name('fn.contact');

Route::get('/course/{course_link}', [CourseFnController::class, 'index'])->name('fn.course_index');
Route::get('/course/{course_link}/{detail}', [CourseFnController::class, 'detail'])->name('fn.course_detail');
  




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
 Route::get('/pageadmin/course/home', [CourseController::class, 'home'])->name('course.home');
 Route::get('/pageadmin/course/slide', [CourseController::class, 'slide'])->name('course.slide');
 
 Route::get('/pageadmin/course/get', [CourseController::class, 'get'])->name('course.get');
 Route::get('/pageadmin/course/items/{courseuid}', [CourseController::class, 'items'])->name('course.items');


 Route::post('/pageadmin/course/add', [CourseController::class, 'add'])->name('course.add'); 
 Route::post('/pageadmin/course/update', [CourseController::class, 'update'])->name('course.update'); 
 Route::post('/pageadmin/course/delete', [CourseController::class, 'delete'])->name('course.delete'); 
 Route::post('/pageadmin/course/updatestatus', [CourseController::class, 'updatestatus'])->name('course.updatestatus'); 
 Route::post('/pageadmin/course/header', [CourseController::class, 'header'])->name('course.header'); 
 Route::post('/pageadmin/course/courses_slide', [CourseController::class, 'courses_slide'])->name('course.courses_slide');
 
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


 Route::get('/pageadmin/sysinfo', [SysinfoController::class, 'index'])->name('sysinfo.index');
 Route::post('/pageadmin/sysinfo/add', [SysinfoController::class, 'add'])->name('sysinfo.add'); 

 Route::get('/pageadmin/aboutus', [AboutusController::class, 'index'])->name('aboutus.index');
 Route::get('/pageadmin/aboutus/new', [AboutusController::class, 'new'])->name('aboutus.new');
 Route::get('/pageadmin/aboutus/edit/{uid}', [AboutusController::class, 'edit'])->name('aboutus.edit');
 Route::post('/pageadmin/aboutus/add', [AboutusController::class, 'add'])->name('aboutus.add');
 Route::post('/pageadmin/aboutus/update', [AboutusController::class, 'update'])->name('aboutus.update');
 Route::post('/pageadmin/aboutus/delete', [AboutusController::class, 'delete'])->name('aboutus.delete');
 Route::post('/pageadmin/aboutus/upload', [AboutusController::class, 'uploadimg'])->name('aboutus.uploadimg');
 

 
 Route::get('/pageadmin/news/home', [NewsController::class, 'home'])->name('news.home');
 Route::get('/pageadmin/news/index', [NewsController::class, 'index'])->name('news.index');
 Route::get('/pageadmin/news/new', [NewsController::class, 'new'])->name('news.new');
 Route::get('/pageadmin/news/edit/{uid}', [NewsController::class, 'edit'])->name('news.edit');
 Route::post('/pageadmin/news/add', [NewsController::class, 'add'])->name('news.add');
 Route::post('/pageadmin/news/update', [NewsController::class, 'update'])->name('news.update');
 Route::post('/pageadmin/news/updatestatus', [NewsController::class, 'updatestatus'])->name('news.updatestatus');
 

 Route::post('/pageadmin/news/delete', [NewsController::class, 'delete'])->name('news.delete');
 Route::post('/pageadmin/news/header', [NewsController::class, 'header'])->name('news.header'); 
