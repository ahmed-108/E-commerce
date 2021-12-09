<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\Cart;
use App\Http\Models\Comments;
use App\Http\Models\products;
use App\Http\Models\user_login;
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
use Tymon\JWTAuth\Facades\JWTAuth;

class Website extends BaseController
{
use General_Traits;
    public function viewlogin(){
        return view('Website.UserLogin');
    }
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (auth('user')->attempt($credentials)) {
            return redirect('/')
                ->with('success','Signed in');
        }
        return redirect("userLogin")->with('error','Login details are not valid');

    }
//    public function afterlogin(){
//        return view('Website.index');
//    }
    public function logout(Request $request) {
      auth('user')->logout();
        return redirect('/userLogin');
    }
    public function customRegistration(Request $request)
    {
        $rules=[
            'username' => 'required',
            'email' => 'required|email|unique:user_login',
            'password' => 'required|confirmed'
        ];
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        user_login::create([
            'username'=>$request-> username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect("userLogin")->withSuccess('You have signed-in');
    }
    public function viewregister(){
        return view('Website.RegisterUser');
    }
    #############################################################################################
    public function Index(){
        $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        orderBy('products.created_at','desc')->take(8)->
        get(['products.id','products.old_price','products.discount','categories.category','sub-category.sub_category_name','products.title','products.price',
            'products.short_description','product_images.path']);
        $PopularCategories= products::join('categories','categories.id','=','products.category_id')->
        select(['products.category_id','categories.category','categories.category_image'])->distinct()->get();
        return view('Website.index',compact(['NewestProducts','PopularCategories']) ) ;
    }


}
