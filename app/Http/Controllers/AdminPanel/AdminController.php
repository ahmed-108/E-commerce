<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Models\categories;
use App\Http\Models\Sercices;
use App\Http\Models\sub_categories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{

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
    ##########################################  Main Categories ########################################################

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

}
