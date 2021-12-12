<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\categories;
use App\Http\Models\Comments;
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
        $comments= Comments::join('user_login','user_login.id','=','comments.user_id')->
        where('comments.product_id',$request->id)->get(['comments.id','user_login.username','comments.comment','comments.rating']);
        $data=[
            "The comments"=>$comments
        ];
        if(!$alldata){
            return  $this->returnError('4004', 'This product not exists');
        }else{
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'msg' => "success",
                'The Product'=>$alldata,
                "the comments"=>$comments
            ]);
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

    public function GetPopularProducts(){
        $NewestProducts= Comments::
        join('products','products.id','=','comments.product_id')->
        join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('comments.rating','>=',2)->
        groupBy('comments.product_id')->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path','comments.rating']);
        return $this->returnData("done", $NewestProducts);
    }

    public function GetOldestProduct(){
        $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        orderBy('products.created_at','asc')->take(8)->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path']);
        return $this->returnData("Oldest Products", $NewestProducts);
    }
    public function GetHighestPrices(){

        $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        orderBy('products.price','desc')->take(8)->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path']);
        return $this->returnData("Highest Prices", $NewestProducts);
    }

    public function GetLowestPrices(){
        $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        orderBy('products.price','asc')->take(8)->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path']);
        return $this->returnData("Lowest Prices", $NewestProducts);
    }

    public function GetResultSearch(Request $request){
        $ResultSearch= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('products.title','LIKE','%'.$request->search.'%')->
        get(['products.id','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path']);

        return $this->returnData("Search Result", $ResultSearch);
    }

    public function getmoetcatgeory(){
        $PopularCategories= products::join('categories','categories.id','=','products.category_id')->
        select(['products.category_id','categories.category','categories.category_image'])->distinct()->get();
        $PopularCategories= products::join('categories','categories.id','=','products.category_id')->
        select(['products.category_id','categories.category','categories.category_image'])->distinct()->get();
        return $this->returnData('done', $PopularCategories);
    }

    public function GetCategoriesandSub()
    {
        $category = categories::all();
        foreach ($category as $cate) {
            $subcategory = sub_categories::join('categories', 'categories.id', '=', 'sub-category.category_id')->
            get();

            return $this->returnData('data', $subcategory);
        }
    }

}
