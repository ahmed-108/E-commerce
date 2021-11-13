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
Route::group(['namespace'=>'Website','middleware' => ['CheckAPIPassword']],function(){

    Route::post("GetCategories","API@GetCategory")->name("get_category");
    Route::post("GetCategoryByID","API@GetCategoryById")->name("get_categoryByID");
    Route::post("GetSubCategories","API@GetSubCategory")->name("get_subcategory");
    Route::post("GetSubCategoryByID","API@GetSubCategoryById")->name("get_subcategoryByID");
    Route::post("GetNewestProduct","API@GetNewestProduct")->name("GetNewestProduct");
    Route::post("GetProduct","API@GetProductById")->name("get_subcategoryByID");
    Route::post("GetProductBySubCategory","API@GetProductBySubcategory")->name("get_subcategoryByID");
    Route::post("GetProductByCategory","API@GetProductByCategory")->name("get_subcategoryByID");


});
