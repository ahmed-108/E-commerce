<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\categories;
use App\Models\contact_us;
use App\Models\images;
use App\Models\orders;
use App\Models\products;
use App\Models\settings_website;
use App\Models\sub_categories;
use App\Models\user_login;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $count_users=user_login::all()->count();

        $count_products= products::all()->count();

        $count_orders= orders::all()->count();

        $count_pending_orders= orders::all()->where('status','=',0)->count();
        return view('AdminPanel.Dashboard',compact(['count_orders','count_users','count_pending_orders','count_products']));
    }
    
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
        $new_price=($request->product_price * $request->product_discount)/100;
        $old_price= ($request->product_price - $new_price);
        products::create([
            'title'=>$request->product_title,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'price'=>$old_price,
            'category_id'=>$request->main_category,
            'sub_category_id'=>$request->sub_category,
            'old_price'=>$request->product_price,
            'discount'=>$request->product_discount
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
        $new_price=($request->product_price * $request->product_discount)/100;
        $old_price= ($request->product_price - $new_price);
        $update->title=$request->title;
        $update->short_description=$request->short_description;
        $update->long_description=$request->long_description;
        $update->price=$old_price;
        $update->old_price=$new_price;
        $update->discount=$request->product_discount;
        $update->category_id = $request->main_category;
        $update->sub_category_name = $request->subcategory;
        $update->save();
        return redirect()->back()->with(['success'=>'Changes Saved']);
    }
    public function DeleteProduct($id){
        products::destroy($id);
        return redirect()->back()->with(['success'=>'The product has been deleted successfully']);
    }
    ########################################### Manage orders ##########################################################
    public function ManageOrders(){
        $orders = orders::join('user_login', 'user_login.id', '=', 'orders.user_id')
            ->get(['orders.created_at', 'orders.id', 'orders.status', 'orders.total_invoice', 'orders.items','user_login.username']);
        return view('AdminPanel.Manage_orders',compact(['orders']));
    }
    public function GetOrderById($id){
       $order=orders::find($id);
    }
    public function UpdateOrder(Request $request,$id){

        $update=orders::find($id);
        $update->status=$request->order_status;
        $update->total_invoice=$request->order_total;
        $update->items=$request->order_items;
        $update->save();
        return redirect()->back()->with(['success'=>'Changes Saved']);
    }
    public function Deleteorder($id){
        orders::destroy($id);
        return redirect()->back()->with(['success'=>'The order has been deleted successfully']);
    }
    ######################################### manage mails ##################################################

    public function ManageMails(){
        $emails = contact_us::all();
        return view('AdminPanel.Manage_mails',compact(['emails']));
    }
    public function GetMailById($id){
        $order=contact_us::find($id);
    }
    public function Deletemail($id){
        contact_us::destroy($id);
        return redirect()->back()->with(['success'=>'The mail has been deleted successfully']);
    }
    ############################## settings website ##############################################################

    public function settings_view(){
        $settings = settings_website::all();
        return view('AdminPanel.Settings',compact(['settings']));
    }
    public function update_settings_website(Request $request){
        $update_settings = settings_website::find(1);
        $update_settings->phone= $request->phone;
        $update_settings->hotline= $request->hotline;
        $update_settings->address= $request->address;
        $update_settings->hours= $request->hours;
        $update_settings->facebook= $request->facebook;
        $update_settings->insta= $request->insta;
        $update_settings->pinterest= $request->pinterest;
        $update_settings->twitter= $request->twitter;
        $update_settings->youtube= $request->youtube;
        $update_settings->save();
        return back()->with('success','The settings has been updated');
    }
######################################## manage users #####################################
    public function ManageUsers(){
        $allusers= user_login::all();
        return view('AdminPanel.Manage_users',compact('allusers'));
    }
    public function Add_user(Request $request){
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:user_login',
            'password' => 'required'
        ];
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        user_login::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
            return 'The user has been added successfully';
        }

    public function GetUserById($id){
        $allusers= user_login::find($id);
    }
    public function UpdateUser(Request $request,$id){


            $update=user_login::find($id);
            $update->username = $request->username;
        $update->email = $request->email;
        $update->password = $request->password;

        $update->save();
            return redirect()->back()->with('success','The user has been updated successfully');
    }
    public function Deleteuser($id){
        user_login::destroy($id);
        return redirect()->back()->with(['success'=>'The user has been deleted successfully']);
    }

}
