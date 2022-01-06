<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace'=>'Website'],function(){

    Route::post("GetCategories","API@GetCategory")->name("get_category");
    Route::post("GetCategoryByID","API@GetCategoryById")->name("get_categoryByID");
    Route::post("GetSubCategories","API@GetSubCategory")->name("get_subcategory");
    Route::post("GetSubCategoryByID","API@GetSubCategoryById")->name("get_subcategoryByID");
    Route::post("GetNewestProduct","API@GetNewestProduct")->name("GetNewestProduct");
    Route::post("GetProduct","API@GetProductById")->name("get_subcategoryByID");
    Route::post("GetProductBySubCategory","API@GetProductBySubcategory")->name("get_subcategoryByID");
    Route::post("GetProductByCategory","API@GetProductByCategory")->name("get_subcategoryByID");
    Route::post("GetPopularProducts","API@GetPopularProducts")->name("get_subcategoryByID");
    Route::post("GetOldestProduct","API@GetOldestProduct")->name("get_subcategoryByID");
    Route::post("GetLowestPrices","API@GetLowestPrices")->name("get_subcategoryByID");
    Route::post("GetHighestPrices","API@GetHighestPrices")->name("get_subcategoryByID");
    Route::post("GetResultSearch","API@GetResultSearch")->name("get_subcategoryByID");
    Route::post("getmoetcatgeory","API@getmoetcatgeory")->name("getmoetcatgeory");
    Route::post("GetCategoriesandSub","API@GetCategoriesandSub")->name("getmoetcatgeory");
    Route::post("GtSubcategoriesById","API@GtSubcategoriesByCategoryID")->name("getmoetcatgeory");


});

Route::group(['namespace'=>'Website','middleware'=>['auth.guard:user_api']], function (){
    Route::post('/user_login','AuthLogin@Login');
    Route::post('/logout','AuthLogin@Logout');
    Route::post('/register_user','AuthLogin@register');
    Route::post('/postcomment','AuthLogin@postcomments');
    Route::post('/AddItemToCard','AuthLogin@AddItemToCard');
    Route::post('/GetCart','AuthLogin@GetCart');
    Route::post('/DeleteAccount','AuthLogin@DeleteAccount');
    Route::post('/Get_Billing_details','AuthLogin@Get_Billing_details');
    Route::post('/create_billing_details','AuthLogin@create_billing_details');
    Route::post('/update_billing_details','AuthLogin@update_billing_details');
    Route::post('/Create_order','AuthLogin@Create_order');
    Route::post('/Delete_item','AuthLogin@Delete_item');
    Route::post('/update_account','AuthLogin@update_account');


});
