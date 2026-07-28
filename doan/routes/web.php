<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilesController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Admin\BlogController as AdminBlogcontroller;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\RateController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ProfilesMembersController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('admin.dashboard.dashboard');
// });
Route::get('/admin/profile',[ProfilesController::class, 'Getupdate'])->name('profile.index');
Route::post('/admin/profile/update',[ProfilesController::class, 'Postupdate'])->name('profile.update');
// Route::get('/listcountry', function () {
//     return view('admin.country.listcountry');
// });
Route::get('/listcountry',[CountryController::class, 'show'])->name('country.list');
Route::get('/addcountry',[CountryController::class, 'Getcreate'])->name('addcountry.get');
Route::post('/addcountry',[CountryController::class, 'Postcreate'])->name('addcountry.create');
Route::post('/deletecountry/{id}',[CountryController::class, 'destroy'])->name('country.delete');
Route::get('/deletecountry/{id}', [CountryController::class, 'Getdelete'])->name('country.getdelete');

Route::get('/listbrand',[BrandController::class, 'show'])->name('brand.list');
Route::get('/addbrand',[BrandController::class, 'Getcreate'])->name('addbrand.get');
Route::post('/addbrand',[BrandController::class, 'Postcreate'])->name('addbrand.create');
Route::post('/deletebrand/{id}',[BrandController::class, 'destroy'])->name('brand.delete');
Route::get('/deletebrand/{id}', [BrandController::class, 'Getdelete'])->name('brand.getdelete');

Route::get('/listcategory',[CategoryController::class, 'show'])->name('category.list');
Route::get('/addcategory',[CategoryController::class, 'Getcreate'])->name('addcategory.get');
Route::post('/addcategory',[CategoryController::class, 'Postcreate'])->name('addcategory.create');
Route::post('/deletecategory/{id}',[CategoryController::class, 'destroy'])->name('category.delete');
Route::get('/deletecategory/{id}', [CategoryController::class, 'Getdelete'])->name('category.getdelete');
// Route::get('/addcountry', function () {
//     return view('admin.country.addcountry');
// })->name('addcountry');

Route::get('/listblog',[AdminBlogcontroller::class, 'index'])->name('blog.list');
Route::get('/addblog',[AdminBlogcontroller::class, 'Getcreate'])->name('addblog.get');
Route::post('/addblog',[AdminBlogcontroller::class, 'Postcreate'])->name('addblog.create');
Route::get('/editblog/{id}',[AdminBlogcontroller::class, 'edit'])->name('blog.edit');
Route::post('/editblog/{id}',[AdminBlogcontroller::class, 'update'])->name('blog.update');
Route::post('/deleteblog/{id}',[AdminBlogcontroller::class, 'Postdestroy'])->name('blog.delete');
Route::get('/deleteblog/{id}', [AdminBlogcontroller::class, 'Getdestroy'])->name('blog.getdelete');

Route::get('/admin/dashboard',[DashboardController::class, 'index'])->name('dashboard.index');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/test', function () {
//     dd(Auth::user());
// });
// Route::get('/emailautho',[ProfilesController::class, 'index']); //test get auth

//Frontend
Route::get('/appfe',[MemberController::class, 'index'])->name('appfe');
Route::get('/login',[MemberController::class, 'login'])->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::post('/login',[MemberController::class, 'Postlogin'])->name('login.post');
Route::get('/register',[MemberController::class, 'create'])->name('register');
Route::post('/register',[MemberController::class, 'Postcreate'])->name('register.post');

Route::get('/bloglist',[FrontendBlogController::class, 'index'])->name('bloglist');
Route::get('/blogdetail/{id}',[FrontendBlogController::class, 'show'])->name('blogdetail');

Route::post('/blog/rate/ajax', [RateController::class, 'rateAjax'])->name('ajaxrate');
Route::post('/blog/comment/ajax',[CommentController::class, 'ajaxcomment'])->name('ajaxcomment');

// Route::get('/account', function(){
//     return view('frontend.member.account');
// })->name('account');
Route::get('/frontend/account/update',[ProfilesMembersController::class, 'Getupdate'])->name('account.update');
Route::post('/frontend/account/update',[ProfilesMembersController::class, 'Postupdate']);

Route::get('/frontend/account/myproduct',[ProductController::class, 'index'])->name('account.myproduct');

Route::get('/frontend/account/addproduct',[ProductController::class, 'Getadd'])->name('account.addproduct');
Route::post('/frontend/account/addproduct',[ProductController::class, 'Postadd']);

Route::get('/frontend/account/editproduct/{id}',[ProductController::class, 'Getedit'])->name('account.editproduct');
Route::post('/frontend/account/editproduct/{id}',[ProductController::class, 'Postedit']);

Route::get('/frontend/account/deleteproduct/{id}',[ProductController::class, 'Getdestroy'])->name('account.deleteproduct');
Route::post('/frontend/account/deleteproduct/{id}',[ProductController::class, 'Postdestroy']);

Route::get('/frontend/account/detailproduct/{id}',[ProductController::class, 'show_productdetail'])->name('productdetail');
// Route::get('/frontend/account/addproduct',[ProfilesMembersController::class, 'Getadd'])->name('product.add');
// Route::post('/frontend/account/addproduct',[ProfilesMembersController::class, 'Postadd'])->name('product.add');
// Route::post('/frontend/account/addproduct',[ProfilesMembersController::class, '']);
Route::get('/frontend/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/frontend/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
// Route::get('/test-asset', function () {
//     return asset('frontend/css/bootstrap.min.css');
// });
Route::post('/cart/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkoutpage', function () {
    return view('frontend.sendMail.checkout');
})->name('checkoutpage');