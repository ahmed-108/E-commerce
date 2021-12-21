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
        $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
        join('products','products.id','=','cart.product_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('user_login.id','=',auth('user')->id())->count();
        return view('Website.index',compact(['NewestProducts','PopularCategories','Count_cart']) ) ;
    }

    public function Shop_View(Request $request){

        if($request->get('sort')=="price_asc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','asc')->
            paginate(15);
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            $count=products::all()->count();
            return view('Website.Shop',compact(['NewestProducts','count','Count_cart']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.Shop',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.Shop',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.Shop', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.Shop', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            $count=products::all()->count();
            return view('Website.Shop', compact(['NewestProducts','count','Count_cart']));
        }
        else {
            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count = products::all()->count();
            $categories = categories::all();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            $categories = categories::select('id','category')->get();
            foreach ($categories as $singlecat) {
                $sub[$singlecat->category] = sub_categories::where('category_id', $singlecat->id)->get();
            }
            return view('Website.Shop',compact(['NewestProducts','Count_cart', 'count','categories','sub']));
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
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
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
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','categories','Count_cart']));
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
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));

        }elseif ($request->get('sort')=="price_desc"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.price','desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_oldest"){

            $NewestProducts= products::join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            orderBy('products.created_at','asc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory',compact(['NewestProducts','count','Count_cart']));
        }elseif ($request->get('sort')=="product_newest") {

            $NewestProducts = products::join('categories', 'categories.id', '=', 'products.category_id')->
            join('sub-category', 'sub-category.id', '=', 'products.sub_category_id')->
            join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
            orderBy('products.created_at', 'desc')->
            paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="lowest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','<=',2)->groupBy('comments.product_id')->paginate(15);
        $count=products::all()->count();
        $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
        }
        elseif ($request->get('sort')=="highest_rating") {

            $NewestProducts= Comments::
            join('products','products.id','=','comments.product_id')->
            join('categories','categories.id','=','products.category_id')->
            join('sub-category','sub-category.id','=','products.sub_category_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('comments.rating','>=',2)->groupBy('comments.product_id')->paginate(15);
            $count=products::all()->count();
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleCategory', compact(['NewestProducts','count','Count_cart']));
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
            $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
            join('products','products.id','=','cart.product_id')->
            join('product_images','product_images.id','=','products.product_imagesID')->
            where('user_login.id','=',auth('user')->id())->count();
            return view('Website.SingleSubCategory',compact(['NewestProducts','count','categories','Count_cart']));
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
        $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
        join('products','products.id','=','cart.product_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('user_login.id','=',auth('user')->id())->count();
        return view('Website.SingleProduct',compact(['NewestProducts','comments','RelatedProducts','Count_cart']));
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

    public function CartIndex(){
      $Products_Cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
      join('products','products.id','=','cart.product_id')->
      join('product_images','product_images.id','=','products.product_imagesID')->
      get(['cart.id','cart.product_id','cart.quantity','cart.Sub_total','products.title',
          'products.price','product_images.path']);
      $Count_cart=Cart::join('user_login','user_login.id','=','cart.user_id')->
        join('products','products.id','=','cart.product_id')->
        join('product_images','product_images.id','=','products.product_imagesID')->
        where('user_login.id','=',auth('user')->id())->count();
      $total_price=Cart::join('user_login','user_login.id','=','cart.user_id')->
      select('cart.Sub_total')->where('user_login.id','=',auth('user')->id())->sum('cart.Sub_total');
      return view('Website.Cart',compact(['Products_Cart','Count_cart','total_price']));
    }
    public function TruncateCart(){
        Cart::truncate()->where('user_login.id','=',auth('user')->id());
        return back()->with('success' ,'Now, The cart is empty');
    }
    public function ChangeQuantity($id,$qty)
    {
        $IncreaseQuantity = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
        join('products', 'products.id', '=', 'cart.product_id')->
        join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
        where('cart.id', '=', $id)->get(['cart.id', 'cart.product_id', 'cart.quantity', 'cart.Sub_total', 'products.title',
            'products.price', 'product_images.path']);
        foreach ($IncreaseQuantity as $product) {
            $sub_total = $qty * $product->price;
            $cart = Cart::find($id);
            $cart->quantity = $qty;
            $cart->Sub_total = $sub_total;
            $cart->save();
        }
    }

    public function AddItemToCard($product_id,$user_id=null,$total=null,$quantity=1){
        try {
            if($user_id==null){
                return back()->with('error' ,'Please Login');
            }else{
                    $rules=[
                        $product_id=> 'unique:cart,product_id',
                    ];
                $validator= Validator::make(array($product_id),$rules);
                if($validator->fails()){
                    return back()->with('error' ,'this product is already in cart');
                }else {
                    Cart::create([
                        'product_id' => $product_id,
                        'user_id' => $user_id,
                        'quantity' => $quantity,
                        'Sub_total'=>$total
                    ]);
                    return back()->with('success', "Added");
                }
            }
        }catch (\Exception $ex){
            return back()->with('error', $ex->getMessage());
        }

    }
    public function deleteitemcart($id){
        Cart::destroy($id);
        return back()->with('success', "The item has been deleted");
    }
}
