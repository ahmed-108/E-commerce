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
Route::get('/userLogin','Website\AuthLogin@viewlogin');
Route::get('/user','Website\Authlogin@afterlogin')->middleware('user','auth:user')->name('afterlogin');
Route::post('/userLogin/login','Website\AuthLogin@validlogin')->name('save.login.user');
Route::get('/logout','Website\AuthLogin@logout');




