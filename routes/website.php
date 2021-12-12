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
Route::get('/category{category}','Website\Website@SingleCtageory')->name('single.category');




