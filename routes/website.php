<?php

use Illuminate\Support\Facades\Auth;
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

//Route::group(['namespace'=>'Website','middleware' => ['auth.']],function() {
//    #######################################  The Routes of Views #######################################################
//
//});
Route::get('/userLogin','Website\Website@viewlogin')->name('user.login');
Route::get('/RegisterUser','Website\Website@viewregister')->name('user.signup');
//Route::get('/user','Website\Website@afterlogin')->middleware('user','auth:user')->name('afterlogin');
Route::post('/userLogin/login','Website\Website@customLogin')->name('save.login.user');
Route::post('/RegisterUser/Register','Website\Website@customRegistration')->name('save.register.user');
Route::get('/logout','Website\Website@logout')->name('logout');
Route::get('/','Website\Website@Index');
Route::get('/Shop','Website\Website@Shop_View');
Route::get('/Shop/Category/{id}','Website\Website@SingleCategory_View')->name('single.category');
Route::get('/Shop/Sub_Category/{id}','Website\Website@Single_SubCategory_View')->name('single.category');
Route::get('/Product/{id}/{product_name}','Website\Website@Single_Product');
Route::post('/Product/comment','Website\Website@postcomments')->name('post.comment');
Route::get('/Cart','Website\Website@CartIndex');
Route::get('/ChangeQuantity/{id}/{qty}','Website\Website@ChangeQuantity');
Route::get('/delete/{id}','Website\Website@deleteitemcart')->name('delete.item');
Route::get('/TruncateCart','Website\Website@TruncateCart')->name('delete.allitems');
Route::get('/addcart/{product_id}/{user_id?}/{price}','Website\Website@AddItemToCard')->name('Add.To.Cart');
##############################
Route::get('/checkout','Website\Website@checkout_view');
Route::post('/Send_order','Website\Website@update_billing_details')->name('confirm.order');

########################
Route::get('/Profile','Website\Website@view_account');


Route::post('/update_info','Website\Website@update_info')->name('update_info');

Route::get('/aboutus','Website\Website@about_view');
Route::get('/contactus','Website\Website@contact_view');
Route::post('/send_mail','Website\Website@send_mail')->name('send.email');


