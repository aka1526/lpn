<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CourseFnController;
use App\Http\Controllers\Frontend\NewsletterController;

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
use App\Http\Controllers\Admins\MembersController;
use App\Http\Controllers\Admins\KhansController;
use App\Http\Controllers\Admins\CountryController;
use App\Http\Controllers\Admins\CertificatesController;
use App\Http\Controllers\Admins\MemberkhansController;
use App\Http\Controllers\Admins\RankingsController;
use App\Http\Controllers\Admins\HalloffameController;
use App\Http\Controllers\Admins\OrganizationsController;
use App\Http\Controllers\Admins\SubscribeController;



###### frontend ###################
Route::fallback(function () {
  return view('/frontend/pages/404');
});
Route::get('/', [HomeController::class, 'index'])->name('fn.index');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('fn.aboutus');
Route::get('/aboutus/{url}', [HomeController::class, 'aboutus_page'])->name('fn.aboutus_page');

Route::get('/news', [HomeController::class, 'news'])->name('fn.news');
Route::get('/news/detail/{detail}', [HomeController::class, 'news_detail'])->name('fn.news.detail');


Route::get('/members', [HomeController::class, 'members'])->name('fn.members');
Route::get('/members/teachers', [HomeController::class, 'members_teachers'])->name('fn.members.teachers');
Route::get('/members/students', [HomeController::class, 'members_students'])->name('fn.members.students');

Route::get('/rankings', [HomeController::class, 'rankings_index'])->name('fn.rankings_index');
Route::get('/rankings/male', [HomeController::class, 'rankings_m'])->name('fn.rankings_m');
Route::get('/rankings/female', [HomeController::class, 'rankings_f'])->name('fn.rankings_f');

Route::get('/champions/world/male', [HomeController::class, 'world_m'])->name('fn.champions_m');
Route::get('/champions/world/female', [HomeController::class, 'world_f'])->name('fn.champions_f');

Route::get('/champions/international/male', [HomeController::class, 'inter_m'])->name('fn.inter_m');
Route::get('/champions/international/female', [HomeController::class, 'inter_f'])->name('fn.inter_f');

Route::get('/champions/hall-of-fame', [HomeController::class, 'hall_of_fame'])->name('fn.hall_of_fame');
Route::get('/champions/hall-of-fame/{uid}', [HomeController::class, 'hall_of_fameView'])->name('fn.hall_of_fameView');

Route::get('/continent', [HomeController::class, 'continent'])->name('fn.continent');
Route::get('/countries', [HomeController::class, 'countries'])->name('fn.countries');
Route::get('/area-member', [HomeController::class, 'area_member'])->name('fn.area_member');
Route::get('/club-member', [HomeController::class, 'club_member'])->name('fn.club_member');


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
  
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('fn.subscribe');
Route::post('/contact/message', [NewsletterController::class, 'contact'])->name('fn.message.contact');



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
 
 Route::get('/pageadmin/subscribe', [SubscribeController::class, 'index'])->name('subscribe.index');

 Route::post('/pageadmin/subscribe/delete', [SubscribeController::class, 'delete'])->name('subscribe.delete');
 
 

 
 Route::get('/pageadmin/news/home', [NewsController::class, 'home'])->name('news.home');
 Route::get('/pageadmin/news/index', [NewsController::class, 'index'])->name('news.index');
 Route::get('/pageadmin/news/new', [NewsController::class, 'new'])->name('news.new');
 Route::get('/pageadmin/news/edit/{uid}', [NewsController::class, 'edit'])->name('news.edit');
 Route::post('/pageadmin/news/add', [NewsController::class, 'add'])->name('news.add');
 Route::post('/pageadmin/news/update', [NewsController::class, 'update'])->name('news.update');
 Route::post('/pageadmin/news/updatestatus', [NewsController::class, 'updatestatus'])->name('news.updatestatus');
 Route::post('/pageadmin/news/delete', [NewsController::class, 'delete'])->name('news.delete');
 Route::post('/pageadmin/news/header', [NewsController::class, 'header'])->name('news.header'); 

 Route::get('/pageadmin/news/catalog', [NewsController::class, 'catalog'])->name('news.catalog');
 Route::get('/pageadmin/news/catalog/new', [NewsController::class, 'catalogNew'])->name('news.catalogNew');
 Route::get('/pageadmin/news/catalog/edit/', [NewsController::class, 'catalogEdit'])->name('news.catalogEdit');

 Route::post('/pageadmin/news/catalog/add', [NewsController::class, 'catalogAdd'])->name('news.catalogAdd');
 Route::post('/pageadmin/news/catalog/delete', [NewsController::class, 'catalogDelete'])->name('news.catalogDelete');
 Route::post('/pageadmin/news/catalog/updatestatus', [NewsController::class, 'catalogStatus'])->name('news.catalogStatus');
 Route::post('/pageadmin/news/catalog/updates', [NewsController::class, 'catalogUpdate'])->name('news.catalogUpdate');


 Route::get('/pageadmin/members/prosonal', [MembersController::class, 'index'])->name('members.index');
 Route::get('/pageadmin/members/prosonal/edit/{uid}', [MembersController::class, 'edit'])->name('members.edit');
 
 Route::get('/pageadmin/members/prosonal/register', [MembersController::class, 'register'])->name('members.register');
 Route::post('/pageadmin/members/prosonal/register/add', [MembersController::class, 'add'])->name('members.register.add');
 Route::post('/pageadmin/members/prosonal/register/update', [MembersController::class, 'update'])->name('members.register.update');
 Route::post('/pageadmin/members/profileimg', [MembersController::class, 'profileimg'])->name('members.profileimg');
 Route::post('/pageadmin/members/idcardimg', [MembersController::class, 'idcardimg'])->name('members.idcardimg');
 Route::post('/pageadmin/members/prosonal/delete', [MembersController::class, 'prosonal_del'])->name('members.prosonal.del');
 Route::post('/pageadmin/members/prosonal/status', [MembersController::class, 'prosonal_status'])->name('members.prosonal.status');

 Route::get('/pageadmin/members/prosonal/renew', [MembersController::class, 'prosonal_renew'])->name('members.prosonal.renew');
 Route::get('/pageadmin/members/prosonal/renew/edit', [MembersController::class, 'prosonal_renew_edit'])->name('members.prosonal.renew.edit');
 Route::get('/pageadmin/members/memberrenew/get', [MembersController::class, 'prosonal_renew_get'])->name('members.prosonal.renew.get');

 Route::post('/pageadmin/members/prosonal/renew/update', [MembersController::class, 'prosonal_renew_update'])->name('members.prosonal.renew.update');


 Route::get('/pageadmin/members/organizations', [OrganizationsController::class, 'index'])->name('org.index');
 Route::get('/pageadmin/members/organizations/new', [OrganizationsController::class, 'new'])->name('org.new');
 Route::get('/pageadmin/members/organizations/edit/{uid}', [OrganizationsController::class, 'edit'])->name('org.edit');
 Route::get('/pageadmin/members/organizations/get', [OrganizationsController::class, 'get'])->name('org.get');
 Route::get('/pageadmin/members/organizations/getorganization', [OrganizationsController::class, 'getorganization'])->name('org.getorganization');

 

 Route::post('/pageadmin/members/organizations/add', [OrganizationsController::class, 'add'])->name('org.add');
 Route::post('/pageadmin/members/organizations/update', [OrganizationsController::class, 'update'])->name('org.update');
 Route::post('/pageadmin/members/organizations/updatestatus', [OrganizationsController::class, 'updatestatus'])->name('org.updatestatus');
 Route::post('/pageadmin/members/organizations/delete', [OrganizationsController::class, 'delete'])->name('org.delete');
Route::post('/pageadmin/members/organizations/renew', [OrganizationsController::class, 'RenewMember'])->name('org.renew');
          



 Route::get('/pageadmin/khans', [KhansController::class, 'index'])->name('khans.index');
 Route::get('/pageadmin/khans/new', [KhansController::class, 'new'])->name('khans.new');
 Route::get('/pageadmin/khans/edit/{uid}', [KhansController::class, 'edit'])->name('khans.edit');
 
 Route::post('/pageadmin/khans/add', [KhansController::class, 'add'])->name('khans.add');
 Route::post('/pageadmin/khans/update', [KhansController::class, 'update'])->name('khans.update');
 Route::post('/pageadmin/khans/updatestatus', [KhansController::class, 'updatestatus'])->name('khans.updatestatus');
 Route::post('/pageadmin/khans/delete', [KhansController::class, 'delete'])->name('khans.delete');


 
 Route::get('/pageadmin/country', [CountryController::class, 'index'])->name('country.index');
 Route::get('/pageadmin/country/new', [CountryController::class, 'new'])->name('country.new');
 Route::get('/pageadmin/country/edit/{uid}', [CountryController::class, 'edit'])->name('country.edit');


 Route::post('/pageadmin/country/add', [CountryController::class, 'add'])->name('country.add');
 Route::post('/pageadmin/country/update', [CountryController::class, 'update'])->name('country.update');
 Route::post('/pageadmin/country/updatestatus', [CountryController::class, 'updatestatus'])->name('country.updatestatus');
 Route::post('/pageadmin/country/delete', [CountryController::class, 'delete'])->name('country.delete');


 Route::get('/pageadmin/certificates', [CertificatesController::class, 'index'])->name('certificates.index');
 Route::get('/pageadmin/certificates/new', [CertificatesController::class, 'new'])->name('certificates.new');
 Route::get('/pageadmin/certificates/get', [CertificatesController::class, 'get'])->name('certificates.get');

 Route::post('/pageadmin/certificates/add', [CertificatesController::class, 'add'])->name('certificates.add');


 Route::get('/pageadmin/memberkhans', [MemberkhansController::class, 'index'])->name('memberkhans.index');
 Route::get('/pageadmin/memberkhans/new', [MemberkhansController::class, 'new'])->name('memberkhans.new');
 Route::get('/pageadmin/memberkhans/get', [MemberkhansController::class, 'get'])->name('memberkhans.get');

 Route::post('/pageadmin/memberkhans/add', [MemberkhansController::class, 'add'])->name('memberkhans.add');


 Route::get('/pageadmin/rankings', [RankingsController::class, 'index'])->name('rankings.index');
 Route::get('/pageadmin/rankings/new', [RankingsController::class, 'new'])->name('rankings.new');
 Route::get('/pageadmin/rankings/edit/{uid}', [RankingsController::class, 'edit'])->name('rankings.edit');
  Route::get('/pageadmin/rankings/list/{uid}', [RankingsController::class, 'list'])->name('rankings.list');
 

 Route::post('/pageadmin/rankings/add', [RankingsController::class, 'add'])->name('rankings.add');
 Route::post('/pageadmin/rankings/update', [RankingsController::class, 'update'])->name('rankings.update');
 Route::post('/pageadmin/rankings/updatestatus', [RankingsController::class, 'updatestatus'])->name('rankings.updatestatus');
 Route::post('/pageadmin/rankings/delete', [RankingsController::class, 'delete'])->name('rankings.delete');
 Route::post('/pageadmin/rankings/addlist', [RankingsController::class, 'add_list'])->name('rankings.add.list');
 

 Route::get('/pageadmin/halloffame', [HalloffameController::class, 'index'])->name('halloffame.index');
 Route::get('/pageadmin/halloffame/new', [HalloffameController::class, 'new'])->name('halloffame.new');
 Route::get('/pageadmin/halloffame/edit/{uid}', [HalloffameController::class, 'edit'])->name('halloffame.edit');
  Route::get('/pageadmin/halloffame/list/{uid}', [HalloffameController::class, 'list'])->name('halloffame.list');
 

 Route::post('/pageadmin/halloffame/add', [HalloffameController::class, 'add'])->name('halloffame.add');
 Route::post('/pageadmin/halloffame/update', [HalloffameController::class, 'update'])->name('halloffame.update');
 Route::post('/pageadmin/halloffame/updatestatus', [HalloffameController::class, 'updatestatus'])->name('halloffame.updatestatus');
 Route::post('/pageadmin/halloffame/delete', [HalloffameController::class, 'delete'])->name('halloffame.delete');
 Route::post('/pageadmin/halloffame/addlist', [HalloffameController::class, 'add_list'])->name('halloffame.add.list');
 