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

});
