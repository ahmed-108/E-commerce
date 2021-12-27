<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\billing_details;
use App\Http\Models\Cart;
use App\Http\Models\Comments;
use App\Http\Models\orders;
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


class AuthLogin extends BaseController
{
    use General_Traits;

    public function Login(Request $request)
    {
        ## validation ##
        try {

            $rules = [
                'email' => "required| exists:user_login,email",
                'password' => "required"
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            /// login
            $credentials = $request->only(['email', 'password']);
            $token = auth('user_api')->attempt($credentials);
            if (!$token) {
                return $this->returnError('E1001', 'error in the password');
            } else {
                //return
                $admin = Auth::guard('user_api')->user();
                $admin->Token = $token;
                return $this->returnData('User', $admin, 'login success');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function logout(Request $request)
    {

        try {
            $token = $request->header('auth-token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('Logout successfully');
            } else {
                return $this->returnError('E500', 'Token invalid');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => "required",
            'email' => "required| unique:user_login,email",
            'password' => "required"
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = user_login::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return $this->returnData('User', $user, 'Register done');
    }

    public function postcomments(Request $request)
    {
        try {
            $token = $request->header('auth-token');
            if ($token) {
                $rules = [
                    'comment' => 'required',
                    "user_id" => "required",
                    "product_id" => "required"
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->returnError("4003", "Please ensure enter the data");
                }
                Comments::create([
                    'comment' => $request->comment,
                    'rating' => $request->rating,
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id
                ]);
                return $this->returnSuccessMessage("The comment has been added");

            } else {
                return $this->returnError('E500', 'Please Enter Token');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function AddItemToCard(Request $request)
    {
        try {

            if (auth('user_api')->id() != null) {
                $rules = [
                    'product_id' => 'unique:cart,product_id',
                    'price'=>'required',
                    'quantity'=>'required',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->returnError("4003", "Please ensure enter the data");
                }
                Cart::create([
                    'product_id' => $request->product_id,
                    'user_id' => auth('user_api')->id(),
                    'quantity'=>$request->quantity,
                    'Sub_total'=>$request->price
                ]);
                return $this->returnSuccessMessage("The product has been added in the cart");

            } else {
                return $this->returnError('E3232', 'Please login to your account');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
    public function GetCart()
    {
        $data = Cart::join('products', 'products.id', '=', 'cart.product_id')->
        join('user_login', 'user_login.id', '=', 'cart.user_id')->get();
        return $this->returnData("the cart", $data);

    }
    public function DeleteAccount()
    {
        try {
            if (auth('user_api')->id() != null) {
                user_login::destroy(auth('user_api')->id());
                return $this->returnSuccessMessage('The account has been deleted');
            } else {
                return $this->returnError('E3232', 'Please login to your account');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function update_billing_details(Request $request)
    {
        try {
            $find_id = billing_details::join('user_login', 'user_login.id', '=', 'billing_details.user_id')->
            where('billing_details.user_id', '=', auth('user_api')->id())->exists();
            if ($find_id == 1) {
                $update_billing_details = billing_details::join('user_login', 'user_login.id', '=', 'billing_details.user_id')->
                where('billing_details.user_id', '=', auth('user_api')->id())->first(['billing_details.id']);
                $update_billing_details->full_name = $request->full_name;
                $update_billing_details->phone1 = $request->phone1;
                $update_billing_details->phone2 = $request->phone2;
                $update_billing_details->country = $request->country;
                $update_billing_details->city = $request->city;
                $update_billing_details->zip_code = $request->zip_code;
                $update_billing_details->full_address = $request->full_address;
                $update_billing_details->notes = $request->notes;
                $update_billing_details->payment_method = $request->payment_method;
                $update_billing_details->save();
                //handle the order

                $order = Cart::join('billing_details', 'billing_details.user_id', '=', 'cart.user_id')->distinct()->
                get(['billing_details.id']);
                $total_invoice = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                select('cart.Sub_total')->where('user_login.id', '=', auth('user')->id())->sum('cart.Sub_total');
                $Count_cart = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                join('products', 'products.id', '=', 'cart.product_id')->
                join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
                where('user_login.id', '=', auth('user')->id())->count();
                foreach ($order as $orders) {
                    orders::create([
                        'user_id' => auth('user')->id(),
                        'total_invoice' => $total_invoice,
                        'billing_details_ID' => $orders->id,
                        'items' => $Count_cart,
                        'status' => 0
                    ]);
                }
                Cart::truncate()->where('user_login.id', '=', auth('user')->id());

                return redirect('/Cart')->with('success', "Your order has been Sent");

            } else {
                $rules = [
                    'user_id' => 'required',
                    'full_name' => 'required',
                    'phone1' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'zip_code' => 'required',
                    'full_address' => 'required',
                    'payment_method' => 'required',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                } else {
                    if ($request->payment_method == 'cash') {
                        $cash = $request->payment_method = 'cash';
                        billing_details::create([
                            'user_id' => $request->user_id,
                            'full_name' => $request->full_name,
                            'phone1' => $request->phone1,
                            'phone2' => $request->phone2,
                            'country' => $request->country,
                            'city' => $request->city,
                            'zip_code' => $request->zip_code,
                            'full_address' => $request->full_address,
                            'notes' => $request->notes,
                            'payment_method' => $cash,
                        ]);
                        //handle the order

                        $order = Cart::join('billing_details', 'billing_details.user_id', '=', 'cart.user_id')->distinct()->
                        get(['billing_details.id']);
                        $total_invoice = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                        select('cart.Sub_total')->where('user_login.id', '=', auth('user')->id())->sum('cart.Sub_total');
                        $Count_cart = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                        join('products', 'products.id', '=', 'cart.product_id')->
                        join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
                        where('user_login.id', '=', auth('user')->id())->count();
                        foreach ($order as $orders) {
                            orders::create([
                                'user_id' => auth('user')->id(),
                                'total_invoice' => $total_invoice,
                                'billing_details_ID' => $orders->id,
                                'items' => $Count_cart,
                                'status' => 0
                            ]);
                        }
                        Cart::truncate()->where('user_login.id', '=', auth('user')->id());

                        return redirect('/Cart')->with('success', "Your order has been Sent");

                    } else {
                        $paypal = $request->payment_method = 'paypal';
                        billing_details::create([
                            'user_id' => $request->user_id,
                            'full_name' => $request->full_name,
                            'phone1' => $request->phone1,
                            'phone2' => $request->phone2,
                            'country' => $request->country,
                            'city' => $request->city,
                            'zip_code' => $request->zip_code,
                            'full_address' => $request->full_address,
                            'notes' => $request->notes,
                            'payment_method' => $paypal,
                        ]);
                        ///handle the order
                        ///
                        $order = Cart::join('billing_details', 'billing_details.user_id', '=', 'cart.user_id')->distinct()->
                        get(['billing_details.id']);
                        $total_invoice = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                        select('cart.Sub_total')->where('user_login.id', '=', auth('user')->id())->sum('cart.Sub_total');
                        $Count_cart = Cart::join('user_login', 'user_login.id', '=', 'cart.user_id')->
                        join('products', 'products.id', '=', 'cart.product_id')->
                        join('product_images', 'product_images.id', '=', 'products.product_imagesID')->
                        where('user_login.id', '=', auth('user')->id())->count();
                        foreach ($order as $orders) {
                            orders::create([
                                'user_id' => auth('user')->id(),
                                'total_invoice' => $total_invoice,
                                'billing_details_ID' => $orders->id,
                                'items' => $Count_cart,
                                'status' => 0
                            ]);
                        }
                        Cart::truncate()->where('user_login.id', '=', auth('user')->id());

                        return redirect('/Cart')->with('success', "Your order has been Sent");
                    }
                }
            }
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }


    }


}
