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
Auth::routes();

Route::get('/admin/login',function (){
    return view('AdminPanel.login');
})->middleware('guest')->name('login');
Route::post('/admin/login','Auth\LoginController@login');
Route::get('admin/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

#######################################################################
Route::group(['prefix'=>'admin','namespace'=>'AdminPanel','middleware' => ['web']],function(){
    #######################################  The Routes of Views #######################################################
    Route::get("/Dashboard","AdminController@dashboard")->name('dashboard');
    Route::get("/MainCategory","AdminController@MainCategory")->name('MainCategory');
    Route::post("/MainCategory/add","AdminController@Add_MainCategory")->name('add.maincategory');
    Route::post('/MainCategory/Edit/{id}','AdminController@UpdateCategory')->name('update.maincategory');

    Route::get('MainCategory/edit/{category}','AdminController@GetCategoryById')->name('GetId');
    Route::get('/MainCategory/delete/{id}','AdminController@DeleteCategory')->name('delete.category');

    #######################################  The Routes of Views #######################################################

    Route::get("/SubCategory","AdminController@SubCategory")->name('SubCategory');
    Route::post("/SubCategory/add","AdminController@Add_SubCategory")->name('add.subncategory');

    Route::post('/SubCategory/Edit/{id}','AdminController@UpdateSubCategory')->name('update.subcategory');

    Route::get('/SubCategory/edit/{id}','AdminController@GetSubCategoryById')->name('GetId');
    Route::get('/SubCategory/delete/{id}','AdminController@DeleteSubCategory')->name('delete.subcategory');
    #######################################  The Routes of Views #######################################################
    Route::get("/ManageProducts","AdminController@ManageProducts")->name('ManageProducts');
    Route::post("/ManageProducts/add","AdminController@Add_Product")->name('add.products');
    Route::get('/ManageProducts/delete/{id}','AdminController@DeleteProduct')->name('delete.product');

    Route::post('/ManageProducts/Edit/{id}','AdminController@UpdateSubCategory')->name('update.subcategory');
    Route::get('/ManageProducts/edit/{id}','AdminController@GetSubCategoryById')->name('GetId');
    ############################## manage orders ##############################################
    Route::get("/ManageOrders","AdminController@ManageOrders")->name('manage.orders');

    Route::get('/ManageOrders/edit/{id}','AdminController@GetOrderById')->name('GetOrderId');
    Route::get('/ManageOrders/delete/{id}','AdminController@Deleteorder')->name('delete.order');
    Route::post('/ManageOrders/Edit/{id}','AdminController@UpdateOrder')->name('update.order');
    ################################### manage mails #######################################
    Route::get("/ManageMails","AdminController@ManageMails")->name('manage.mails');
    Route::get('/ManageMails/edit/{id}','AdminController@GetMailById')->name('GetMailId');
    Route::get('/ManageMails/delete/{id}','AdminController@Deletemail')->name('delete.mail');
    ################################# settings website ##################################
    Route::get("/settings","AdminController@settings_view")->name('settings.view');
    Route::post('/settings/edit','AdminController@update_settings_website')->name('update_settings_website');
    ################################# manage users ##################
    Route::get("/ManageUsers","AdminController@ManageUsers")->name('manage.users');
    Route::post("/ManageUsers/add","AdminController@Add_user")->name('add.user');
    Route::post('/ManageUsers/Edit/{id}','AdminController@UpdateUser')->name('update.user');

    Route::get('ManageUsers/edit/{id}','AdminController@GetUserById')->name('GetUserId');
    Route::get('/ManageUsers/delete/{id}','AdminController@Deleteuser')->name('delete.user');

});
