<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\Cart;
use App\Http\Models\categories;
use App\Http\Models\Comments;
use App\Http\Models\products;
use App\Http\Models\sub_categories;
use App\Http\Models\user_login;
use App\Traits\General_Traits;
use Carbon\Carbon;
use http\Env\Url;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\Paginator;
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

    public function Shop_View(Request $request){

        if($request->get('sort')=="price_asc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.Shop',compact(['NewestProducts','count']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.Shop',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.Shop',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.Shop', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.Shop', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.Shop', compact(['NewestProducts','count']));
        }
        else {
            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count = products::all()->count();
            $categories = categories::all();


            $categories = categories::select('id','category')->get();
            foreach ($categories as $singlecat) {
                $sub[$singlecat->category] = sub_categories::where('category_id', $singlecat->id)->get();
//                $testfinal=$sub[$singlecat->category];
//                foreach ($testfinal as $final){
//                    return ($final);
//                }
            }


            return view('Website.Shop',compact(['NewestProducts','count','categories','sub']));
        }
    }
    public function SingleCategory_View(Request $request, $category){

        if($request->get('sort')=="price_asc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        else {
            $count = products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('categories.category',$category)->count();
            $categories = categories::all();
            $NewestProducts=products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('categories.category',$category)->orderBy('products.created_at','desc')->
            paginate(15);
            return view('Website.SingleCategory',compact(['NewestProducts','count','categories']));
        }
    }
    public function Single_SubCategory_View(Request $request, $sub_category_name){

        if($request->get('sort')=="price_asc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count']));
        }
        else {
            $count = products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('sub-category.sub_category_name',$sub_category_name)->count();
            $categories = categories::all();
            $NewestProducts=products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('sub-category.sub_category_name',$sub_category_name)->orderBy('products.created_at','desc')->
            paginate(15);
            return view('Website.SingleSubCategory',compact(['NewestProducts','count','categories']));
        }
    }

    public function Single_Product($id,$product_name){
        $NewestProducts=products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('products.title',$product_name)->get();
        $comments= Comments::join('user_login','user_login.id','=','comments.user_id')->
        where('comments.product_id',$id)->get();
        $RelatedProducts= products::join('categories','categories.id','=','products.category_id')->
        join('sub-category','sub-category.id','=','products.sub_category_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        orderBy('products.price','asc')->
        get();
        return view('Website.SingleProduct',compact(['NewestProducts','comments','RelatedProducts']));
    }
    public function postcomments(Request $request){
        try {
            $token= auth('user')->id();
            if($token){
                $rules=[
                    'comment'=> 'required',
                    "user_id"=>"required",
                    "product_id"=>"required"
                ];
                $validator= Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
                }
                Comments::create([
                    'comment'=>$request-> comment,
                    'rating'=>$request->rating,
                    'user_id'=>$request-> user_id,
                    'product_id'=>$request->product_id
                ]);
                return back()->with('error',"The comment has been added");

            }else{
                return back()->with('error' ,'Please Login');
            }
        }catch (\Exception $ex){
            return back()->with('error', $ex->getMessage());
        }

    }


}
