<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\categories;
use App\Http\Models\products;
use App\Http\Models\sub_categories;
use App\Traits\General_Traits;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class API extends BaseController
{
use General_Traits;

   public function GetCategory(){
    $allcategory=categories::all();
    return $this->returnData("All_Categories", $allcategory);
   }
    public function GetCategoryById(Request $request){

        $alldata=categories::find($request->id);
        if(!$alldata){
            return  $this->returnError('4004', 'This category not exists');
        }else{
            return $this->returnData('CategoryById', $alldata,'success');
        }
    }
    public function GetSubCategory(){
    $All_Subcategories=sub_categories::join('categories','categories.id','=','sub-category.category_id')->
    get(['sub-category.id','categories.category','sub-category.sub_category_name']);
    return $this->returnData('SubCategories',$All_Subcategories ,'success ');
    }
    public function GetSubCategoryById(Request $request){

        $alldata=sub_categories::join('categories','categories.id','=','sub-category.category_id')->where('sub-category.id',$request->id)->
        get(['sub-category.id','categories.category','sub-category.sub_category_name']);
        if(!$alldata){
            return  $this->returnError('4004', 'This Sub Category not exists');
        }else{
            return $this->returnData('SubCategoryById', $alldata,'success');
        }
    }

    public function GetNewestProduct(){
     $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
     join('sub-category','sub-category.id','=','products.sub_category_id')->
     join('product_images','product_images.id','=','products.product_imagesID')->
     orderBy('products.created_at','desc')->take(8)->
     get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
         'products.short_description','product_images.path']);
         return $this->returnData("Newest Products", $NewestProducts);
    }

    public function GetProductById(Request $request){

        $alldata=products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('products.id',$request->id)->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.short_description','products.long_description',
            'products.price','product_images.path']);

        if(!$alldata){
            return  $this->returnError('4004', 'This product not exists');
        }else{
            return $this->returnData('The Product', $alldata,'success');
        }
    }

    public function GetProductBySubcategory(Request $request){
       $alldata=products::join('categories','categories.id','=','products.category_id')->
       join('sub-category','sub-category.id','=','products.sub_category_id')->
       join('product_images','product_images.id','=','products.product_imagesID')->
       where('sub_category_id',$request->id)->
       get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.short_description','products.long_description',
           'products.price','product_images.path']);
       if(!$request->id) {
           return $this->returnError("5005", "Please Enter The category ID");
       }else {
           if (!$alldata) {
               return $this->returnError('4004', 'This subcategory not exists');
           }else {
               return $this->returnData('The Product', $alldata, 'success');
           }
       }
    }

    public function GetProductByCategory(Request $request){
        $alldata=products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('products.category_id',$request->id)->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.short_description','products.long_description',
            'products.price','product_images.path']);
        if(!$request->id) {
            return $this->returnError("5005", "Please Enter The category ID");
        }else {
            if (!$alldata) {
                return $this->returnError('4004', 'This category not exists');
            }else {
                return $this->returnData('The Product', $alldata, 'success');
            }
        }
    }
}
