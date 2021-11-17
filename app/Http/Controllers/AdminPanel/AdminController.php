<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Models\categories;
use App\Http\Models\images;
use App\Http\Models\products;
use App\Http\Models\sub_categories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('AdminPanel.Dashboard');
    }
    ##########################################  Main Categories ########################################################
    public function MainCategory(){
        $All_Categories= categories::all();
        return view('AdminPanel.MainCategories',compact('All_Categories'));
    }
    public function Add_MainCategory(Request $request){
       $rules=[
           'category'=>'max:255','required'
       ];
       $validator= Validator::make($request->all(),$rules);
       if($validator->fails()){
           return redirect()->back()->with(['error'=>'something error']);
       }
       categories::create([
           'category'=>$request-> main_category
       ]);
       return redirect()->back()->with(['success'=>'The Category has been added successfully']);
    }
    public function GetCategoryById($category){
        $categories= categories::find($category);
    }
    public function UpdateCategory(Request $request,$category){

        $update=categories::find($category);
        $update->category = $request->main_category;
        $update->save();
        return redirect()->back()->with(['success'=>'Changes Saved']);
    }
    public function DeleteCategory($id){
        categories::destroy($id);
        return redirect()->back()->with(['success'=>'The Category has been deleted successfully']);
    }
    ##########################################  Sub Categories ########################################################

    public function SubCategory(){
        $All_Categories= categories::all();
        $All_Sub_category=sub_categories::all();
        return view('AdminPanel.SubCategories',compact(['All_Categories','All_Sub_category']));
    }
    public function Add_SubCategory(Request $request){
        $rules=[
            'sub_category_name'=>'max:255','required'
        ];
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->with(['error'=>'something error']);
        }
        sub_categories::create([
            'category_id'=>$request-> main_category,
            'sub_category_name'=>$request->subcategory
        ]);
        return redirect()->back()->with(['success'=>'The Category has been added successfully']);
    }
    public function GetSubCategoryById($id){
        $Subcategories= sub_categories::find($id);
    }
    public function UpdateSubCategory(Request $request,$id){

        $update=sub_categories::find($id);
        $update->category_id = $request->main_category;
        $update->sub_category_name = $request->subcategory;
        $update->save();
        return redirect()->back()->with(['success'=>'Changes Saved']);
    }
    public function DeleteSubCategory($id){
        sub_categories::destroy($id);
        return redirect()->back()->with(['success'=>'The Category has been deleted successfully']);
    }
    ##########################################  Manage Products ########################################################
    public function ManageProducts(){
        $All_Categories=categories::all();
        $all_subcategories= sub_categories::all();
        $all_products= products::all();
        return view('AdminPanel.ManageProducts',compact(['All_Categories','all_subcategories','all_products']));
    }
    public function Add_Product(Request $request){
        $rules=[
            'title'=>'max:255',
            'short_description'=>'max:255',
            'long_description'=>'max:255',
            'price'=>'max:255',
            'sub_category_id'=>'max:255',
            'category_id'=> 'max:255'
        ];
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->with(['error'=>'something error']);
        }
        products::create([
            'title'=>$request->product_title,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'price'=>$request->product_price,
            'category_id'=>$request->main_category,
            'sub_category_id'=>$request->sub_category,
        ]);
        if($request->hasFile('product_images')) {
            $images = $request->file('product_images');

                    $file_extension = $request->product_images->getClientOriginalExtension();
                    $img_name = time() . '.' . $file_extension;
                    $path = 'public/images/Products';
                    $request->product_images->move($path, $img_name);
                    $file ='/'.$path . '/' . $img_name;
                    images::create([
                        'product_id' => products::all()->max('id'),
                        'path' => $file
                    ]);
        }
            $update_createdproduct=products::find(products::all()->max('id'));
            $update_createdproduct->product_imagesID= images::all()->max('id');
            $update_createdproduct->save();
             return redirect()->back()->with(['success'=>'The Product has been added successfully']);
        }
    public function GetProductById($id){
        $Subcategories= products::find($id);
    }
    public function UpdateProduct(Request $request,$id){

        $update=products::find($id);
        $update->category_id = $request->main_category;
        $update->sub_category_name = $request->subcategory;
        $update->save();
        return redirect()->back()->with(['success'=>'Changes Saved']);
    }
    public function DeleteProduct($id){
        products::destroy($id);
        return redirect()->back()->with(['success'=>'The product has been deleted successfully']);
    }








}
