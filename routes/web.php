<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dishes', 'dashboardController@welcome')->name('welcome');
Route::get('/', 'RestaurantController@register')->name('Registerform');
Route::get('/Registerform/validation', 'RestaurantController@validation')->name('Registerform.validation');
Route::post('/Registerform/save', 'RestaurantController@registerSave')->name('Registerform.save'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','admin']], function () {	
// Route::get('/dashboard', function () {
//     return view('admin.Dashboard');
// });
Route::get('/categorylist', 'MenuController@getcategory')->middleware('can:isAdmin')->name('menu.categorylist');
Route::get('/menu/lists', 'MenuController@index')->middleware('can:isAdmin')->name('menu.lists');
Route::get('/restaurant/menu/add', 'MenuController@add')->middleware('can:isAdmin')->name('menu.add');
Route::post('/restaurant/AddMenu', 'MenuController@AddMenu')->middleware('can:isAdmin')->name('restraunt.AddMenu');
Route::post('/restaurant/GetMenu', 'MenuController@GetMenu')->middleware('can:isAdmin')->name('restraunt.GetMenu');
Route::post('/restaurant/updateMenu', 'MenuController@UpdateMenu')->middleware('can:isAdmin')->name('restraunt.updateMenu');
Route::get('/restaurant/editMenu/{id}', 'MenuController@EditMenu')->middleware('can:isAdmin')->name('restraunt.edit.id');
Route::get('/restaurant/delete/Menu/{id}', 'MenuController@delete')->middleware('can:isAdmin')->name('restraunt.menu.delete');
Route::post('/restaurant/delete/Menuoption', 'MenuController@deleteMenu')->middleware('can:isAdmin')->name('restraunt.menuoption.delete');
Route::post('/restaurant/delete/productoption', 'ProductsController@deleteOption')->middleware('can:isAdmin')->name('restraunt.productoption.delete');

Route::get('/restaurant/lists', 'RestaurantController@index')->middleware('can:isAdmin')->name('restraunt.lists');
Route::get('/restaurant/add', 'RestaurantController@add')->middleware('can:isAdmin')->name('restraunt.add');
Route::post('/restaurant/AddRestraunt', 'RestaurantController@addRestraunt')->middleware('can:isAdmin')->name('restraunt.AddRestraunt');
Route::post('/restaurant/update', 'RestaurantController@updaterestraunt')->middleware('can:isAdmin')->name('restraunt.update');

// Route::get('/restraunt/{slug}', 'dashboardController@RestrauntWelcome')->middleware('can:isAdmin')->name('restraunt.id'); //this is for see for everyone

Route::get('/restaurant/edit/{id}', 'RestaurantController@editrestraunt')->middleware('can:isAdmin')->name('restraunt.edit.id');
Route::get('/restaurant/delete/{id}', 'RestaurantController@delete')->middleware('can:isAdmin')->name('restraunt.delete');
Route::post('/restaurant/status', 'RestaurantController@status')->middleware('can:isAdmin')->name('restraunt.status');
Route::get('/restaurant/profile/edit/{id}', 'RestaurantController@editrestrauntProfile')->name('restraunt.profile.edit');
Route::post('/restaurant/updateProfile', 'RestaurantController@updaterestrauntProfile')->name('restraunt.update.profile');

Route::get('/user/roles', 'dashboardController@registered')->middleware('can:isAdmin')->name('user.roles');
Route::get('/user/add', 'dashboardController@add')->middleware('can:isAdmin')->name('user.add');
Route::post('/user/addRoles', 'dashboardController@addRole')->middleware('can:isAdmin')->name('user.addRole');
Route::post('/user/update', 'dashboardController@updateRole')->middleware('can:isAdmin')->name('user.update');
Route::get('/user/edit/{id}', 'dashboardController@editRole')->middleware('can:isAdmin')->name('user.edit.id');
Route::get('/user/delete/{id}', 'dashboardController@delete')->middleware('can:isAdmin')->name('user.delete');

Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/add', 'CategoryController@add')->name('category.add');
Route::post('/category/addCategory', 'CategoryController@addCategory')->name('category.addCategory');
Route::post('/category/update', 'CategoryController@updateCategory')->name('category.update');
Route::get('/category/edit/{id}', 'CategoryController@editCategory')->name('category.edit.id');
Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

Route::get('/product', 'ProductsController@index')->name('product');
Route::get('/product/add', 'ProductsController@add')->name('product.add');
Route::post('/product/addProduct', 'ProductsController@addProduct')->name('product.addProduct');
Route::post('/product/update', 'ProductsController@updateProduct')->name('product.update');
Route::get('/product/edit/{id}', 'ProductsController@editProduct')->name('product.edit.id');
Route::get('/product/delete/{id}', 'ProductsController@delete')->name('product.delete');
Route::get('/product/getCategoryByRestrauntId', 'ProductsController@getCategoryByRestrauntId')->name('product.getCategoryByRestrauntId');
});
Route::get('/restaurant/{slug}', 'dashboardController@RestrauntWelcome')->name('restraunt.id');

